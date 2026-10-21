<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title>@yield('title', 'Maseco')</title>
</head>
<body style="margin:0;padding:0;background-color:#f2f7f5;font-family:Arial,Helvetica,sans-serif;color:#28413d;-webkit-text-size-adjust:100%;">
    <div style="display:none;max-height:0;overflow:hidden;opacity:0;color:transparent;">
        @yield('preheader', 'Updates from Maseco')
    </div>
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#f2f7f5;">
        <tr>
            <td align="center" style="padding:32px 14px;">
                <table role="presentation" width="600" cellspacing="0" cellpadding="0" border="0" style="width:100%;max-width:600px;background:#ffffff;border:1px solid #e2ece8;border-radius:12px;overflow:hidden;">
                    <tr>
                        <td style="padding:22px 32px;background:#073b35;border-bottom:4px solid #06b18b;">
                            <a href="{{ route('home') }}" style="color:#ffffff;text-decoration:none;font-size:22px;line-height:28px;font-weight:700;letter-spacing:1.5px;">MASECO</a>
                            <div style="padding-top:3px;color:#c7e6dc;font-size:11px;line-height:16px;letter-spacing:.7px;">TEXTILE SOURCING &amp; SUSTAINABILITY</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:34px 32px 12px;">
                            <div style="color:#087f5b;font-size:11px;line-height:16px;font-weight:700;letter-spacing:1.3px;text-transform:uppercase;">@yield('eyebrow', 'MASECO UPDATE')</div>
                            <h1 style="margin:8px 0 0;color:#073b35;font-size:26px;line-height:34px;font-weight:700;">@yield('heading')</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:8px 32px 32px;color:#405b55;font-size:15px;line-height:25px;">
                            @yield('content')
                            @hasSection('action')
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin-top:26px;">
                                    <tr><td align="center" bgcolor="#06b18b" style="border-radius:6px;">
                                        <a href="@yield('action-url')" style="display:inline-block;padding:12px 20px;color:#ffffff;font-size:14px;line-height:20px;font-weight:700;text-decoration:none;">@yield('action')</a>
                                    </td></tr>
                                </table>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:18px 32px;background:#f7faf9;border-top:1px solid #e5eeeb;color:#71847f;font-size:12px;line-height:19px;">
                            <strong style="color:#31534b;">Maseco</strong><br>
                            Canada's Textile Sourcing &amp; Sustainability Platform<br>
                            <a href="{{ route('home') }}" style="color:#087f5b;text-decoration:underline;">Visit maseco.ca</a>
                        </td>
                    </tr>
                </table>
                <div style="padding:14px 10px 0;color:#91a39e;font-size:11px;line-height:17px;">You are receiving this email because of activity on Maseco.</div>
            </td>
        </tr>
    </table>
</body>
</html>
