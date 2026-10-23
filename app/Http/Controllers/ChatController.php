<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function show(Request $request, Enquiry $enquiry)
    {
        [$role, $participant] = $this->authorizeParticipant($request, $enquiry);
        $enquiry->chatMessages()
            ->whereNull('read_at')
            ->where('sender_type', '!=', $role)
            ->update(['read_at' => now()]);
        $enquiry->load(['user', 'material', 'supplier', 'manufacturer']);
        $messages = $enquiry->chatMessages()->orderBy('id')->get();

        $otherParty = match ($role) {
            'user' => $enquiry->supplier ?: $enquiry->manufacturer,
            'supplier' => $enquiry->user,
            'manufacturer' => $enquiry->user,
        };
        $otherPartyName = $otherParty
            ? ($otherParty->company_name ?: ($otherParty->business_name ?: $otherParty->name))
            : 'Marketplace participant';

        if ($messages->isEmpty() && filled($enquiry->message)) {
            $messages = collect([(object) [
                'id' => 0,
                'sender_type' => 'user',
                'sender_id' => $enquiry->user_id,
                'body' => $enquiry->message,
                'created_at' => $enquiry->created_at,
            ]]);
        }

        $sentByMe = $messages->filter(fn ($message) => $message->sender_type === $role && (int) $message->sender_id === (int) $participant->id)->pluck('id')->all();
        $lastMessageId = (int) $messages->max('id');

        return view('chat.show', compact('enquiry', 'role', 'participant', 'otherPartyName', 'messages', 'sentByMe', 'lastMessageId'));
    }

    public function messages(Request $request, Enquiry $enquiry)
    {
        [$role] = $this->authorizeParticipant($request, $enquiry);
        $validated = $request->validate(['after' => ['nullable', 'integer', 'min:0']]);

        $messages = $enquiry->chatMessages()
            ->when(isset($validated['after']), fn ($query) => $query->where('id', '>', $validated['after']))
            ->orderBy('id')
            ->limit(100)
            ->get(['id', 'sender_type', 'sender_id', 'body', 'created_at']);

        $receivedIds = $messages->where('sender_type', '!=', $role)->pluck('id');
        if ($receivedIds->isNotEmpty()) {
            ChatMessage::whereIn('id', $receivedIds)->whereNull('read_at')->update(['read_at' => now()]);
        }

        return response()->json(['messages' => $messages]);
    }

    public function unread(Request $request)
    {
        [$role, $participant] = $this->authenticatedParticipant();
        $ownerColumn = match ($role) {
            'user' => 'user_id',
            'supplier' => 'supplier_id',
            'manufacturer' => 'manufacturer_id',
        };
        $enquiryIds = Enquiry::where($ownerColumn, $participant->id)->select('id');

        $unreadQuery = ChatMessage::whereIn('enquiry_id', $enquiryIds)
            ->whereNull('read_at')
            ->where('sender_type', '!=', $role);
        $unreadCount = (clone $unreadQuery)->count();
        $messages = $unreadQuery->with(['enquiry.user', 'enquiry.supplier', 'enquiry.manufacturer'])
            ->orderByDesc('id')->limit(100)->get();

        $conversations = $messages->groupBy('enquiry_id')->map(function ($items) use ($role) {
            $latest = $items->first();
            $enquiry = $latest->enquiry;
            $sender = match ($latest->sender_type) {
                'user' => $enquiry->user,
                'supplier' => $enquiry->supplier,
                'manufacturer' => $enquiry->manufacturer,
                default => null,
            };

            return [
                'enquiry_id' => $enquiry->id,
                'sender_name' => $sender
                    ? ($sender->company_name ?: ($sender->business_name ?: ($sender->name ?? 'Marketplace participant')))
                    : 'Marketplace participant',
                'unread_count' => $items->count(),
            ];
        })->take(10)->values();

        return response()->json([
            'unread_count' => $unreadCount,
            'conversations' => $conversations,
        ]);
    }

    public function send(Request $request, Enquiry $enquiry)
    {
        [$role, $participant] = $this->authorizeParticipant($request, $enquiry);
        $validated = $request->validate(['body' => ['required', 'string', 'max:5000', 'regex:/\S/']]);

        $message = $enquiry->chatMessages()->create([
            'sender_type' => $role,
            'sender_id' => $participant->id,
            'body' => trim($validated['body']),
        ]);

        return response()->json([
            'message' => [
                'id' => $message->id,
                'sender_type' => $message->sender_type,
                'sender_id' => $message->sender_id,
                'body' => $message->body,
                'created_at' => $message->created_at->toIso8601String(),
            ],
        ], 201);
    }

    private function authorizeParticipant(Request $request, Enquiry $enquiry): array
    {
        [$role, $participant] = $this->authenticatedParticipant();

        $allowed = match ($role) {
            'user' => (int) $enquiry->user_id === (int) $participant->id,
            'supplier' => (int) $enquiry->supplier_id === (int) $participant->id,
            'manufacturer' => (int) $enquiry->manufacturer_id === (int) $participant->id,
        };
        abort_unless($allowed, 403, 'You are not a participant in this conversation.');

        return [$role, $participant];
    }

    private function authenticatedParticipant(): array
    {
        $guards = [
            'user' => 'web',
            'supplier' => 'supplier',
            'manufacturer' => 'manufacturer',
        ];

        foreach ($guards as $role => $guard) {
            $participant = Auth::guard($guard)->user();
            if (!$participant) {
                continue;
            }

            return [$role, $participant];
        }

        throw new HttpResponseException(redirect()->guest(route('login')));
    }
}
