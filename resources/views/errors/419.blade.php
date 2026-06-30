@php
    use App\Support\Seo;

    app(Seo::class)
        ->title(__('errors.419.meta_title'))
        ->description(__('errors.419.subtitle'))
        ->noindex();
@endphp

@extends('layouts.app')

@section('content')

    <x-error-layout
        code="419"
        :eyebrow="__('errors.419.eyebrow')"
        :title="__('errors.419.title')"
        :subtitle="__('errors.419.subtitle')"
        :cta-home="__('errors.419.cta_home')"
        :cta-contact="__('errors.419.cta_contact')"
    >
        {{-- Cod fără „0" central → variantă stivuită; emblem = ceas (sesiune expirată) --}}
        <x-slot:visual>
            <x-error-glyph stacked digits="419">
                <x-error-emblem icon="clock" />
            </x-error-glyph>
        </x-slot:visual>
    </x-error-layout>

@endsection
