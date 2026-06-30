@php use App\Support\Localization; @endphp

@extends('layouts.app')

@section('content')

    <section class="flex items-center justify-center bg-white py-28 lg:py-36">
        <div class="mx-auto max-w-xl px-4 text-center sm:px-6">
            <span class="mx-auto inline-flex h-16 w-16 items-center justify-center rounded-full bg-brand-100 text-brand-700">
                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
            </span>
            <h1 class="mt-6 text-3xl font-bold tracking-tight text-ink sm:text-4xl">{{ __('pages.thank_you.title') }}</h1>
            <p class="mt-4 text-lg text-muted">{{ __('pages.thank_you.text') }}</p>
            <div class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row">
                <a href="{{ Localization::route('home') }}" class="rounded-lg bg-brand-600 px-6 py-3 text-base font-semibold text-white transition hover:bg-brand-700">{{ __('messages.cta.back_home') }}</a>
                <a href="{{ Localization::route('services.index') }}" class="rounded-lg border border-slate-300 px-6 py-3 text-base font-semibold text-ink transition hover:bg-slate-50">{{ __('messages.cta.all_services') }}</a>
            </div>
        </div>
    </section>

@endsection
