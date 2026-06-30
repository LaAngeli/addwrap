@props(['markOnly' => false])

{{--
    Logo AddWrap — marca „flag AW" în portocaliu brand (#EA7117) + wordmark text
    „AddWrap" (moștenește culoarea textului părintelui: ink pe fundal deschis).
    Variantele raster oficiale: public/images/logo/addwrap-{orange,dark,white}.png
--}}
<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-2 text-ink']) }} role="img" aria-label="{{ config('site.company.name') }}">
    {{-- Marca „AW" (portocaliu brand, fără cerc) --}}
    <span class="inline-flex h-8 shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 157 127" fill="#EA7117" class="block h-full w-auto" aria-hidden="true" focusable="false">
            <path d="M0,0 L6,0 L11,4 L12,7 L12,49 L-2,50 L-6,58 L-14,78 L-16,77 L-20,69 L-43,69 L-48,78 L-50,76 L-59,52 L-59,50 L-83,50 L-86,55 L-107,108 L-111,104 L-128,68 L-129,63 L-126,56 L-121,53 L-92,40 L-53,23 L-14,6 Z" transform="translate(137,8)" />
            <path d="M0,0 L1,0 L1,27 L-2,32 L-5,34 L-13,34 L-7,18 Z" transform="translate(148,84)" />
            <path d="M0,0 L2,2 L12,27 L12,29 L-11,29 L-1,2 Z" transform="translate(64,89)" />
            <path d="M0,0 L3,4 L5,10 L-4,10 Z" transform="translate(105,108)" />
        </svg>
    </span>

    @unless ($markOnly)
        {{-- Wordmark text „AddWrap" --}}
        <span class="text-2xl font-extrabold leading-none tracking-tight">AddWrap</span>
    @endunless
</span>
