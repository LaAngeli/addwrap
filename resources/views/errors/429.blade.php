@php
    use App\Support\Seo;

    app(Seo::class)
        ->title(__('errors.429.meta_title'))
        ->description(__('errors.429.subtitle'))
        ->noindex();
@endphp

@extends('layouts.app')

@section('content')

    <x-error-layout
        code="429"
        :eyebrow="__('errors.429.eyebrow')"
        :title="__('errors.429.title')"
        :subtitle="__('errors.429.subtitle')"
        :cta-home="__('errors.429.cta_home')"
        :cta-contact="__('errors.429.cta_contact')"
    >
        {{-- Cod fără „0" central → variantă stivuită; emblem = vitezometru (prea multe cereri) --}}
        <x-slot:visual>
            <x-error-glyph stacked digits="429">
                <x-error-emblem icon="gauge" />
            </x-error-glyph>
        </x-slot:visual>
    </x-error-layout>

@endsection
