{{-- Fișierul demo Laravel a fost înlocuit. Ruta "/" folosește pagina pages.home. --}}
{{-- Acest fișier este păstrat doar pentru compatibilitate și nu este utilizat. --}}
@php redirect()->to(\App\Support\Localization::route('home'))->send(); @endphp
