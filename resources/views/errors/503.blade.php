@php
    use App\Support\Seo;

    app(Seo::class)
        ->title(__('errors.503.meta_title'))
        ->description(__('errors.503.subtitle'))
        ->noindex();
@endphp

@extends('layouts.app')

@section('content')

    <x-error-layout
        code="503"
        :eyebrow="__('errors.503.eyebrow')"
        :title="__('errors.503.title')"
        :subtitle="__('errors.503.subtitle')"
        :cta-home="__('errors.503.cta_home')"
    >
        {{-- „0"-ul central = roată dințată rotativă (mentenanță) — fără fascicul --}}
        <x-slot:visual>
            <x-error-glyph left="5" right="3">
                <x-error-emblem icon="gear" :beam="false" spin />
            </x-error-glyph>
        </x-slot:visual>
    </x-error-layout>

@endsection
