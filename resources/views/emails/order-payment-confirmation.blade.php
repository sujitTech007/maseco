@extends('emails.layout')

@section('title', 'Payment received | Maseco')
@section('preheader', 'We received your order payment.')
@section('eyebrow', 'PAYMENT CONFIRMED')
@section('heading', 'Thank you for your payment')
@section('action', 'View my orders')
@section('action-url', route('user.orders'))

@section('content')
    <p style="margin:0 0 16px;">Hello {{ $order->user->name }}, your payment has been received and your order is confirmed.</p>
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:20px;background:#f7faf9;border:1px solid #e2ece8;border-radius:8px;">
        <tr><td style="padding:16px 18px;color:#71847f;">Order number</td><td align="right" style="padding:16px 18px;color:#073b35;font-weight:700;">#{{ $order->id }}</td></tr>
        <tr><td style="padding:0 18px 16px;color:#71847f;">Amount paid</td><td align="right" style="padding:0 18px 16px;color:#073b35;font-size:18px;font-weight:700;">${{ number_format((float) $order->amount, 2) }}</td></tr>
    </table>
    <p style="margin:18px 0 0;">You can review your order details from your Maseco account.</p>
@endsection
