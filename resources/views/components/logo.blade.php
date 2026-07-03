@props(['markOnly' => false])

{{--
    Marca addWrap (brandbook 2026), în portocaliul de brand.
    Prop-ul `markOnly` e păstrat pentru compatibilitate cu apelurile existente;
    componenta randează marca (spațiu negativ = „AW"). Pentru lockup-ul complet
    cu wordmark folosește imaginea addwrap-lockup.png.
--}}
<span {{ $attributes->merge(['class' => 'inline-flex items-center text-orange']) }} role="img" aria-label="{{ config('site.company.name') }}">
    <x-brand-mark class="h-8 w-auto" />
</span>
