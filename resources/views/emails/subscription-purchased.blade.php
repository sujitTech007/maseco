@extends('emails.layout')

@section('title', 'Subscription confirmed | Maseco')
@section('preheader', 'Your Maseco subscription is active.')
@section('eyebrow', 'SUBSCRIPTION CONFIRMED')
@section('heading', 'Your plan is active')
@section('action', 'View my subscriptions')
@section('action-url', route('user.subscriptions'))

@section('content')
    <p style="margin:0 0 16px;">Hello {{ $purchase->user->name }}, your subscription purchase is confirmed.</p>
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:20px;border:1px solid #e2ece8;border-radius:8px;">
        <tr><td style="padding:16px 18px;border-bottom:1px solid #e2ece8;color:#71847f;font-size:12px;line-height:18px;text-transform:uppercase;letter-spacing:.7px;">Plan</td><td align="right" style="padding:16px 18px;border-bottom:1px solid #e2ece8;color:#073b35;font-size:15px;line-height:20px;font-weight:700;">{{ $purchase->plan_name }}</td></tr>
        <tr><td style="padding:14px 18px;border-bottom:1px solid #e2ece8;color:#71847f;">Amount</td><td align="right" style="padding:14px 18px;border-bottom:1px solid #e2ece8;color:#073b35;font-weight:700;">${{ number_format((float) $purchase->total_amount, 2) }}</td></tr>
        <tr><td style="padding:14px 18px;border-bottom:1px solid #e2ece8;color:#71847f;">Starts</td><td align="right" style="padding:14px 18px;border-bottom:1px solid #e2ece8;color:#28413d;">{{ $purchase->start_date->format('d M Y') }}</td></tr>
        <tr><td style="padding:14px 18px;color:#71847f;">Ends</td><td align="right" style="padding:14px 18px;color:#28413d;">{{ $purchase->end_date->format('d M Y') }}</td></tr>
    </table>
@endsection
