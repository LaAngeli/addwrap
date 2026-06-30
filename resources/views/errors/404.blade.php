@php
    use App\Support\Seo;

    app(Seo::class)
        ->title(__('errors.404.meta_title'))
        ->description(__('errors.404.subtitle'))
        ->noindex();
@endphp

@extends('layouts.app')

@section('content')

    <x-error-layout
        code="404"
        :eyebrow="__('errors.404.eyebrow')"
        :title="__('errors.404.title')"
        :subtitle="__('errors.404.subtitle')"
        :cta-home="__('errors.404.cta_home')"
        :cta-contact="__('errors.404.cta_contact')"
        :shortcuts="true"
        :help-eyebrow="__('errors.404.help_eyebrow')"
        :help-title="__('errors.404.help_title')"
    >
        {{-- „0"-ul central = radar care scanează după pagina pierdută --}}
        <x-slot:visual>
            <x-error-glyph left="4" right="4">
                <x-error-emblem icon="aw" />
            </x-error-glyph>
        </x-slot:visual>
    </x-error-layout>

@endsection
