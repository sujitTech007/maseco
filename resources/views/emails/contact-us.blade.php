@extends('emails.layout')

@section('title', 'We received your message | Maseco')
@section('preheader', 'Your message has reached the Maseco team.')
@section('eyebrow', 'MESSAGE RECEIVED')
@section('heading', 'Thanks for reaching out, ' . $contact->name)
@section('action', 'Visit Maseco')
@section('action-url', route('home'))

@section('content')
    <p style="margin:0 0 16px;">We’ve received your message and a member of our team will get back to you soon.</p>
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:20px;background:#f7faf9;border:1px solid #e2ece8;border-radius:8px;">
        <tr><td style="padding:15px 18px;border-bottom:1px solid #e2ece8;color:#71847f;">Name</td><td align="right" style="padding:15px 18px;border-bottom:1px solid #e2ece8;color:#28413d;font-weight:700;">{{ $contact->name }}</td></tr>
        <tr><td style="padding:15px 18px;color:#71847f;">Phone</td><td align="right" style="padding:15px 18px;color:#28413d;">{{ $contact->phone }}</td></tr>
    </table>
@endsection
