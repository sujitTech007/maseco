<!doctype html>
<html lang="en"><body>
    <h1>Your subscription is active</h1>
    <p>Hello {{ $purchase->user->name }},</p>
    <p>Your purchase of the <strong>{{ $purchase->plan_name }}</strong> plan is confirmed.</p>
    <p>Amount paid: ${{ number_format((float) $purchase->total_amount, 2) }}<br>
       Start date: {{ $purchase->start_date->format('d M Y') }}<br>
       End date: {{ $purchase->end_date->format('d M Y') }}</p>
    <p>Thanks,<br>The Maseco team</p>
</body></html>
