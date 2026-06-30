@php
    use App\Support\Localization;
    $company = config('site.company');
    $social = $company['social'] ?? [];
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
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:580px;background:#ffffff;border-radius:16px;overflow:hidden;border:1px solid #e4e4e7;">

                    {{-- Header — logo embedat inline via CID (Content-ID), nu remote:
                         majoritatea clienților de email blochează imaginile remote implicit,
                         dar un atașament inline cu Content-Disposition: inline se afișează
                         întotdeauna, indiferent de setarea de blocare. --}}
                    <tr>
                        <td style="background:#18181b;padding:24px 32px;color:#ffffff;">
                            <img src="{{ $message->embed(public_path('images/logo/addwrap-white.png')) }}" width="130" height="61" alt="{{ $company['name'] }}" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;">
                            <p style="margin:16px 0 0;font-size:18px;font-weight:bold;line-height:1.3;">{{ __('contact.confirmation.header') }}</p>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding:32px;">
                            <p style="margin:0 0 16px;font-size:17px;font-weight:bold;color:#18181b;">
                                {{ __('contact.confirmation.greeting', ['name' => $firstName !== '' ? $firstName : $name]) }}
                            </p>

                            <p style="margin:0 0 14px;font-size:15px;line-height:1.65;color:#3f3f46;">
                                {{ __('contact.confirmation.intro') }}
                            </p>

                            <p style="margin:0 0 24px;font-size:15px;line-height:1.65;color:#18181b;font-weight:bold;">
                                {{ __('contact.confirmation.reply_eta') }}
                            </p>

                            {{-- Recap --}}
                            <p style="margin:28px 0 10px;color:#71717a;font-size:11px;text-transform:uppercase;letter-spacing:0.1em;font-weight:bold;">
                                {{ __('contact.confirmation.recap_label') }}
                            </p>

                            @if (! empty($data['service']))
                                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="font-size:14px;margin-bottom:12px;">
                                    <tr>
                                        <td style="padding:6px 0;color:#71717a;width:160px;">{{ __('contact.confirmation.recap_service') }}</td>
                                        <td style="padding:6px 0;font-weight:bold;color:#18181b;">{{ Localization::serviceName($data['service']) }}</td>
                                    </tr>
                                </table>
                            @endif

                            <p style="margin:10px 0 8px;color:#71717a;font-size:12px;text-transform:uppercase;letter-spacing:0.05em;font-weight:bold;">{{ __('contact.confirmation.recap_message') }}</p>
                            <div style="background:#fafafa;border:1px solid #e4e4e7;border-radius:10px;padding:18px;font-size:14px;line-height:1.65;white-space:pre-wrap;color:#27272a;">{{ $data['message'] ?? '' }}</div>

                            {{-- Next steps --}}
                            <p style="margin:32px 0 12px;color:#71717a;font-size:11px;text-transform:uppercase;letter-spacing:0.1em;font-weight:bold;">
                                {{ __('contact.confirmation.next_steps_title') }}
                            </p>
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="font-size:14px;line-height:1.7;color:#3f3f46;">
                                @foreach ((array) __('contact.confirmation.next_steps') as $i => $step)
                                    <tr>
                                        <td valign="top" style="padding:4px 12px 4px 0;color:#18181b;font-weight:bold;width:24px;">{{ $i + 1 }}.</td>
                                        <td valign="top" style="padding:4px 0;">{{ $step }}</td>
                                    </tr>
                                @endforeach
                            </table>

                            {{-- Meanwhile --}}
                            <p style="margin:28px 0 0;font-size:14px;line-height:1.65;color:#3f3f46;">
                                {{ __('contact.confirmation.meanwhile') }}
                                <a href="{{ Localization::route('portfolio') }}" style="color:#18181b;font-weight:bold;text-decoration:underline;">{{ __('contact.confirmation.link_portfolio') }}</a>
                                {{ __('contact.confirmation.link_separator') }}
                                <a href="{{ Localization::route('services.index') }}" style="color:#18181b;font-weight:bold;text-decoration:underline;">{{ __('contact.confirmation.link_services') }}</a>.
                            </p>

                            {{-- Signature --}}
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-top:36px;border-top:1px solid #e4e4e7;">
                                <tr>
                                    <td style="padding-top:24px;">
                                        <p style="margin:0 0 6px;font-size:14px;color:#3f3f46;">{{ __('contact.confirmation.signature_lead') }}</p>
                                        <p style="margin:0;font-size:16px;font-weight:bold;color:#18181b;">{{ __('contact.confirmation.signature_team') }}</p>
                                        <p style="margin:6px 0 0;font-size:13px;color:#71717a;font-style:italic;">{{ __('contact.confirmation.signature_tagline') }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Footer business card --}}
                    <tr>
                        <td style="padding:20px 32px;background:#fafafa;border-top:1px solid #e4e4e7;">
                            <p style="margin:0 0 4px;font-size:13px;font-weight:bold;color:#18181b;">
                                {{ __('contact.confirmation.footer_business', ['name' => $company['name']]) }}
                            </p>
                            <p style="margin:0 0 12px;font-size:13px;color:#52525b;">
                                <a href="tel:{{ str_replace(' ', '', $company['phone']) }}" style="color:#52525b;text-decoration:none;">{{ $company['phone'] }}</a>
                                &nbsp;·&nbsp;
                                <a href="mailto:{{ $company['email'] }}" style="color:#52525b;text-decoration:none;">{{ $company['email'] }}</a>
                            </p>

                            @if (! empty($social['facebook']) || ! empty($social['instagram']))
                                <p style="margin:0 0 4px;font-size:12px;color:#71717a;">{{ __('contact.confirmation.footer_follow') }}</p>
                                <p style="margin:0;font-size:13px;">
                                    @if (! empty($social['facebook']))
                                        <a href="{{ $social['facebook'] }}" style="color:#18181b;text-decoration:none;font-weight:bold;">Facebook</a>
                                    @endif
                                    @if (! empty($social['facebook']) && ! empty($social['instagram']))
                                        &nbsp;·&nbsp;
                                    @endif
                                    @if (! empty($social['instagram']))
                                        <a href="{{ $social['instagram'] }}" style="color:#18181b;text-decoration:none;font-weight:bold;">Instagram</a>
                                    @endif
                                </p>
                            @endif

                            <p style="margin:16px 0 0;padding-top:14px;border-top:1px solid #e4e4e7;font-size:11px;line-height:1.5;color:#a1a1aa;">
                                {{ __('contact.confirmation.reply_note', ['email' => $company['email']]) }}
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
