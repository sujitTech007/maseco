<?php

namespace App\Http\Controllers;

use App\Models\{Enquiry, EnquiryMeeting, Manufacturer, Supplier, User};
use App\Notifications\SampleWorkflowNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnquiryMeetingController extends Controller
{
    private function participant(): array
    {
        foreach (['web' => 'user', 'supplier' => 'supplier', 'manufacturer' => 'manufacturer'] as $guard => $role) {
            if (Auth::guard($guard)->check()) return [Auth::guard($guard)->user(), $role];
        }
        abort(401);
    }

    private function authorizeEnquiry(Enquiry $enquiry): array
    {
        [$person, $role] = $this->participant();
        $ownerColumn = $role === 'user' ? 'user_id' : $role.'_id';
        abort_unless((int)$enquiry->{$ownerColumn} === (int)$person->id, 403, 'You are not a participant in this enquiry.');
        return [$person, $role];
    }

    public function index(Enquiry $enquiry)
    {
        [$person, $role] = $this->authorizeEnquiry($enquiry);
        $enquiry->load(['user', 'material', 'supplier', 'manufacturer']);
        $meetings = $enquiry->meetings()->orderByDesc('starts_at')->get();
        $otherParty = $role === 'user' ? ($enquiry->supplier ?: $enquiry->manufacturer) : $enquiry->user;
        $otherPartyName = $otherParty ? ($otherParty->company_name ?: ($otherParty->business_name ?: $otherParty->name)) : 'RFQ participant';
        return view('meetings.enquiry', compact('enquiry', 'meetings', 'person', 'role', 'otherPartyName'));
    }

    public function store(Request $request, Enquiry $enquiry)
    {
        [$person, $role] = $this->authorizeEnquiry($enquiry);
        $data = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'starts_at' => ['required', 'date', 'after:now'],
            'meeting_url' => ['nullable', 'url', 'max:1000'],
        ]);
        $meeting = $enquiry->meetings()->create($data + ['created_by_id' => $person->id, 'created_by_type' => $role]);

        try {
            $recipients = [
                'user' => $enquiry->user,
                'supplier' => $enquiry->supplier,
                'manufacturer' => $enquiry->manufacturer,
            ];
            foreach ($recipients as $recipientRole => $recipient) {
                if (!$recipient || ($recipientRole === $role && (int)$recipient->id === (int)$person->id)) continue;
                $recipient->notify(new SampleWorkflowNotification(
                    'enquiry_meeting_scheduled',
                    'A meeting was scheduled for RFQ #'.$enquiry->id.': '.$meeting->title,
                    route('enquiry.meetings.index', $enquiry)
                ));
            }
        } catch (\Throwable $exception) {
            report($exception);
        }

        return redirect()->route('enquiry.meetings.index', $enquiry)->with('success', 'Meeting scheduled and shared with the RFQ participants.');
    }
}
