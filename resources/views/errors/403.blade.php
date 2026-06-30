@php
    use App\Support\Seo;

    app(Seo::class)
        ->title(__('errors.403.meta_title'))
        ->description(__('errors.403.subtitle'))
        ->noindex();
@endphp

@extends('layouts.app')

@section('content')

    <x-error-layout
        code="403"
        :eyebrow="__('errors.403.eyebrow')"
        :title="__('errors.403.title')"
        :subtitle="__('errors.403.subtitle')"
        :cta-home="__('errors.403.cta_home')"
        :cta-contact="__('errors.403.cta_contact')"
        :shortcuts="true"
        :help-eyebrow="__('errors.403.help_eyebrow')"
        :help-title="__('errors.403.help_title')"
    >
        {{-- „0"-ul central = lacăt (acces interzis) --}}
        <x-slot:visual>
            <x-error-glyph left="4" right="3">
                <x-error-emblem icon="lock" />
            </x-error-glyph>
        </x-slot:visual>
    </x-error-layout>

@endsection
