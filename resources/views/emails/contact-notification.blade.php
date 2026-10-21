@extends('emails.layout')

@section('title', 'New contact message | Maseco')
@section('preheader', 'A visitor submitted the Maseco contact form.')
@section('eyebrow', 'CONTACT FORM')
@section('heading', 'New message from ' . $contact->name)
@section('action', 'Reply to ' . $contact->name)
@section('action-url', 'mailto:' . $contact->email)

@section('content')
    <p style="margin:0 0 20px;">A visitor submitted the contact form. Their details are below.</p>
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="border:1px solid #e2ece8;border-radius:8px;">
        <tr><td width="35%" style="padding:13px 16px;border-bottom:1px solid #e2ece8;color:#71847f;">Name</td><td style="padding:13px 16px;border-bottom:1px solid #e2ece8;color:#28413d;font-weight:700;">{{ $contact->name }}</td></tr>
        <tr><td style="padding:13px 16px;border-bottom:1px solid #e2ece8;color:#71847f;">Email</td><td style="padding:13px 16px;border-bottom:1px solid #e2ece8;"><a href="mailto:{{ $contact->email }}" style="color:#087f5b;">{{ $contact->email }}</a></td></tr>
        <tr><td style="padding:13px 16px;border-bottom:1px solid #e2ece8;color:#71847f;">Phone</td><td style="padding:13px 16px;border-bottom:1px solid #e2ece8;color:#28413d;">{{ $contact->phone }}</td></tr>
        <tr><td style="padding:13px 16px;color:#71847f;">Found Maseco via</td><td style="padding:13px 16px;color:#28413d;">{{ $contact->find_us ?: 'Not provided' }}</td></tr>
    </table>
@endsection
