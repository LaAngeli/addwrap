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

];
