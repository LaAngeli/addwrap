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
    'service_other' => 'Altceva',
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
        'turnstile' => 'Verificarea anti-spam a eșuat. Te rugăm reîncearcă.',
    ],

    'confirmation' => [
        'subject' => 'Confirmare: am primit mesajul tău | addWrap',
        'header' => 'Mesajul tău a ajuns la noi',
        'greeting' => 'Bună, :name,',
        'intro' => 'Îți mulțumim pentru interesul față de serviciile addWrap. Mesajul tău a fost preluat și va fi analizat de un membru al echipei noastre în cel mai scurt timp.',
        'reply_eta' => 'Revenim cu un răspuns personalizat în maximum 24 de ore lucrătoare.',
        'recap_label' => 'Pentru evidența ta, iată detaliile mesajului trimis:',
        'recap_service' => 'Serviciu de interes',
        'recap_message' => 'Mesajul tău',
        'next_steps_title' => 'Ce urmează',
        'next_steps' => [
            'Analizăm contextul afacerii tale și obiectivele menționate.',
            'Te contactăm pentru o discuție scurtă de descoperire, pe email sau telefon.',
            'Primești o propunere personalizată: scope, etape și buget orientativ.',
        ],
        'meanwhile' => 'Între timp, te invităm să explorezi',
        'link_portfolio' => 'portofoliul nostru',
        'link_services' => 'pachetele de servicii',
        'link_separator' => 'sau',
        'signature_lead' => 'Cu apreciere,',
        'signature_team' => 'Echipa addWrap',
        'signature_tagline' => 'Strategie, creație și performanță, sub același acoperiș.',
        'reply_note' => 'Acesta este un mesaj automat de confirmare. Pentru detalii suplimentare, răspunde direct la acest email sau scrie-ne la :email.',
        'footer_business' => ':name · Agenție de marketing digital',
        'footer_contact' => ':phone · :email',
        'footer_follow' => 'Ne găsești și pe',
    ],

];
