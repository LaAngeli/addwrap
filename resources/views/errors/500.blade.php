@php
    use App\Support\Seo;

    app(Seo::class)
        ->title(__('errors.500.meta_title'))
        ->description(__('errors.500.subtitle'))
        ->noindex();
@endphp

@extends('layouts.app')

@section('content')

    <x-error-layout
        code="500"
        :eyebrow="__('errors.500.eyebrow')"
        :title="__('errors.500.title')"
        :subtitle="__('errors.500.subtitle')"
        :cta-home="__('errors.500.cta_home')"
        :cta-contact="__('errors.500.cta_contact')"
    >
        {{-- „0"-ul central = triunghi de avertizare (eroare server) --}}
        <x-slot:visual>
            <x-error-glyph left="5" right="0">
                <x-error-emblem icon="warning" />
            </x-error-glyph>
        </x-slot:visual>
    </x-error-layout>

@endsection
