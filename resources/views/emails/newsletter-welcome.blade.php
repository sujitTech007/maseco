@extends('emails.layout')

@section('title', 'Newsletter subscription | Maseco')
@section('preheader', 'You are now subscribed to Maseco updates.')
@section('eyebrow', 'NEWSLETTER')
@section('heading', 'Thanks for subscribing')
@section('action', 'Explore Maseco')
@section('action-url', route('listing'))

@section('content')
    <p style="margin:0 0 16px;">You’re on the list. We’ll send news and updates about textile sourcing, materials, and sustainability to:</p>
    <p style="margin:0;padding:14px 16px;background:#f2f7f5;border-left:3px solid #06b18b;border-radius:4px;color:#073b35;font-weight:700;">{{ $newsletter->email }}</p>
    <p style="margin:18px 0 0;">Thanks for being part of the Maseco community.</p>
@endsection
