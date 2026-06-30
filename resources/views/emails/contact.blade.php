@php($company = config('site.company'))
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $company['name'] }}</title>
</head>
<body style="margin:0;background:#f4f4f5;font-family:Arial,Helvetica,sans-serif;color:#18181b;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="padding:24px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:560px;background:#ffffff;border-radius:16px;overflow:hidden;border:1px solid #e4e4e7;">
                    {{-- Logo embedat inline via CID, nu remote — vezi nota din
                         emails/contact-confirmation.blade.php. --}}
                    <tr>
                        <td style="background:#18181b;padding:20px 28px;color:#ffffff;">
                            <img src="{{ $message->embed(public_path('images/logo/addwrap-white.png')) }}" width="120" height="56" alt="{{ $company['name'] }}" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;">
                            <p style="margin:12px 0 0;font-size:18px;font-weight:bold;">Mesaj nou din formularul de contact</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:28px;">
                            <p style="margin:0 0 16px;color:#71717a;font-size:14px;">Detaliile mesajului:</p>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="font-size:14px;">
                                <tr><td style="padding:8px 0;color:#71717a;width:120px;">Nume</td><td style="padding:8px 0;font-weight:bold;">{{ $data['name'] }}</td></tr>
                                <tr><td style="padding:8px 0;color:#71717a;">Email</td><td style="padding:8px 0;">{{ $data['email'] }}</td></tr>
                                @if (! empty($data['phone']))
                                    <tr><td style="padding:8px 0;color:#71717a;">Telefon</td><td style="padding:8px 0;">{{ $data['phone'] }}</td></tr>
                                @endif
                                @if (! empty($data['service']))
                                    <tr><td style="padding:8px 0;color:#71717a;">Serviciu</td><td style="padding:8px 0;">{{ __('services.items.'.$data['service'].'.name') }}</td></tr>
                                @endif
                            </table>

                            <p style="margin:20px 0 8px;color:#71717a;font-size:14px;">Mesaj</p>
                            <div style="background:#fafafa;border:1px solid #e4e4e7;border-radius:10px;padding:16px;font-size:14px;line-height:1.6;white-space:pre-wrap;">{{ $data['message'] }}</div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
