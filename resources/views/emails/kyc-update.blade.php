@extends('emails.layout')

@section('title', $title . ' | Maseco')
@section('preheader', $message)
@section('eyebrow', 'KYC VERIFICATION')
@section('heading', $title)
@section('action', $actionLabel)
@section('action-url', $actionUrl)

@section('content')
    <p style="margin:0 0 16px;">Hello {{ $account->name }},</p>
    <p style="margin:0 0 16px;">{{ $message }}</p>

    @if($adminNote)
        <div style="margin:18px 0;padding:14px 16px;border-left:4px solid #e6a700;background:#fff8e5;color:#624b12;">
            <strong>Review note</strong><br>
            {{ $adminNote }}
        </div>
    @endif

    <p style="margin:0;">Account type: {{ ucfirst($accountType) }}</p>
@endsection
