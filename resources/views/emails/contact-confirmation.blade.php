@php
    use App\Support\Localization;
    $company = config('site.company');
    $name = trim((string) ($data['name'] ?? ''));
    $firstName = $name !== '' ? \Illuminate\Support\Str::of($name)->explode(' ')->first() : '';
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
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

                    {{-- Header --}}
                    <tr>
                        <td style="background:#18181b;padding:20px 28px;color:#ffffff;font-size:18px;font-weight:bold;">
                            {{ $company['name'] }} — {{ __('contact.confirmation.header') }}
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding:28px;">
                            <p style="margin:0 0 16px;font-size:16px;font-weight:bold;">
                                {{ __('contact.confirmation.greeting', ['name' => $firstName !== '' ? $firstName : $name]) }}
                            </p>

                            <p style="margin:0 0 20px;font-size:14px;line-height:1.6;color:#3f3f46;">
                                {{ __('contact.confirmation.intro') }}
                            </p>

                            {{-- Recap --}}
                            <p style="margin:24px 0 8px;color:#71717a;font-size:13px;text-transform:uppercase;letter-spacing:0.05em;font-weight:bold;">
                                {{ __('contact.confirmation.recap_label') }}
                            </p>

                            @if (! empty($data['service']))
                                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="font-size:14px;margin-bottom:12px;">
                                    <tr>
                                        <td style="padding:6px 0;color:#71717a;width:140px;">{{ __('contact.confirmation.recap_service') }}</td>
                                        <td style="padding:6px 0;font-weight:bold;">{{ __('services.items.'.$data['service'].'.name') }}</td>
                                    </tr>
                                </table>
                            @endif

                            <p style="margin:8px 0 6px;color:#71717a;font-size:13px;">{{ __('contact.confirmation.recap_message') }}</p>
                            <div style="background:#fafafa;border:1px solid #e4e4e7;border-radius:10px;padding:16px;font-size:14px;line-height:1.6;white-space:pre-wrap;color:#27272a;">{{ $data['message'] ?? '' }}</div>

                            {{-- Next steps --}}
                            <p style="margin:28px 0 8px;color:#71717a;font-size:13px;text-transform:uppercase;letter-spacing:0.05em;font-weight:bold;">
                                {{ __('contact.confirmation.next_steps_title') }}
                            </p>
                            <ol style="margin:0;padding-left:20px;font-size:14px;line-height:1.7;color:#3f3f46;">
                                @foreach ((array) __('contact.confirmation.next_steps') as $step)
                                    <li style="padding:2px 0;">{{ $step }}</li>
                                @endforeach
                            </ol>

                            {{-- Meanwhile --}}
                            <p style="margin:24px 0 0;font-size:14px;line-height:1.6;color:#3f3f46;">
                                {{ __('contact.confirmation.meanwhile') }}
                                <a href="{{ Localization::route('portfolio') }}" style="color:#18181b;font-weight:bold;text-decoration:underline;">{{ __('contact.confirmation.link_portfolio') }}</a>
                                {{ __('contact.confirmation.link_separator') }}
                                <a href="{{ Localization::route('services.index') }}" style="color:#18181b;font-weight:bold;text-decoration:underline;">{{ __('contact.confirmation.link_services') }}</a>.
                            </p>

                            {{-- Signature --}}
                            <p style="margin:28px 0 4px;font-size:14px;color:#3f3f46;">{{ __('contact.confirmation.signature_lead') }}</p>
                            <p style="margin:0;font-size:14px;font-weight:bold;color:#18181b;">{{ __('contact.confirmation.signature_team') }}</p>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="padding:18px 28px;background:#fafafa;border-top:1px solid #e4e4e7;">
                            <p style="margin:0 0 6px;font-size:12px;color:#71717a;line-height:1.5;">
                                {{ __('contact.confirmation.reply_note', ['email' => $company['email']]) }}
                            </p>
                            <p style="margin:0;font-size:12px;color:#71717a;">
                                {{ __('contact.confirmation.footer_company', [
                                    'name' => $company['name'],
                                    'phone' => $company['phone'],
                                    'email' => $company['email'],
                                ]) }}
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
