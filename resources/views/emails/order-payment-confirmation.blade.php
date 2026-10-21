<!doctype html>
<html lang="en"><body>
    <h1>Payment received</h1>
    <p>Hello {{ $order->user->name }},</p>
    <p>We received your payment for order #{{ $order->id }}.</p>
    <p>Amount paid: ${{ number_format((float) $order->amount, 2) }}</p>
    <p>Thanks,<br>The Maseco team</p>
</body></html>
