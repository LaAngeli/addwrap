<?php

declare(strict_types=1);

return [

    'fields' => [
        'name' => 'Nume',
        'email' => 'Email',
        'phone' => 'Telefon',
        'service' => 'Serviciu de interes',
        'message' => 'Mesaj',
        'consent' => 'acordul de prelucrare a datelor',
    ],

    'placeholders' => [
        'name' => 'Numele tău',
        'email' => 'adresa@exemplu.ro',
        'phone' => 'Ex: 07XX XXX XXX',
        'message' => 'Spune-ne câteva detalii despre proiect...',
    ],

    'service_default' => 'Alege un serviciu',
    'submit' => 'Trimite mesajul',
    'sending' => 'Se trimite...',
    'consent_label' => 'Sunt de acord cu :privacy.',
    'consent_link' => 'politica de confidențialitate',
    'success' => 'Mesajul a fost trimis cu succes. Mulțumim!',
    'rate_limited' => 'Ai trimis prea multe mesaje. Te rugăm să încerci din nou peste câteva minute.',
    'spam_detected' => 'Nu am putut procesa formularul. Reîncarcă pagina și încearcă din nou.',
    'prefill_intro' => 'Sunt interesat(ă) de următoarele servicii:',
    'prefill_duration' => 'Durata contractului',

    'errors' => [
        'name_invalid' => 'Numele poate conține doar litere, spații, cratimă și punct.',
        'phone_invalid' => 'Introdu un număr de telefon valid (cifre, spații, eventual prefixul +).',
        'service_invalid' => 'Serviciul selectat nu este valid.',
    ],

    'confirmation' => [
        'subject' => 'Am primit mesajul tău — AddWrap',
        'header' => 'Mesajul tău a ajuns la noi',
        'greeting' => 'Salut, :name!',
        'intro' => 'Îți mulțumim că ne-ai scris. Ți-am primit mesajul prin formularul de contact AddWrap și revenim cu un răspuns personalizat în maximum 24 de ore lucrătoare.',
        'recap_label' => 'Pentru evidența ta, iată ce ne-ai trimis:',
        'recap_service' => 'Serviciu de interes',
        'recap_message' => 'Mesajul tău',
        'next_steps_title' => 'Ce urmează',
        'next_steps' => [
            'Un specialist AddWrap analizează contextul și obiectivele tale.',
            'Te contactăm pe email sau telefon pentru o conversație scurtă de descoperire.',
            'Primești o propunere clară: scope, etape și buget orientativ.',
        ],
        'meanwhile' => 'Între timp, poți arunca o privire pe',
        'link_portfolio' => 'portofoliu',
        'link_services' => 'serviciile noastre',
        'link_separator' => 'sau pe',
        'signature_lead' => 'Cu drag,',
        'signature_team' => 'Echipa AddWrap',
        'reply_note' => 'Acesta este un mesaj automat. Dacă ai un detaliu de adăugat, răspunde direct la acest email sau scrie la :email.',
        'footer_company' => ':name · :phone · :email',
    ],

];
