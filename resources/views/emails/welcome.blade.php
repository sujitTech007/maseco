@extends('emails.layout')

@section('title', 'Welcome to Maseco')
@section('preheader', 'Your Maseco account is ready.')
@section('eyebrow', 'WELCOME')
@section('heading', 'Welcome to Maseco, ' . $account->name)
@section('action', 'Sign in to your account')
@section('action-url', route('login'))

@section('content')
    <p style="margin:0 0 16px;">Your {{ $accountType }} account has been created successfully. We’re glad you’re here.</p>
    <p style="margin:0;">Sign in to explore textile materials, connect with suppliers, and manage your activity on Maseco.</p>
@endsection
