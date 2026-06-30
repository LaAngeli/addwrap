<?php

declare(strict_types=1);

return [

    'fields' => [
        'name' => 'Name',
        'email' => 'Email',
        'phone' => 'Phone',
        'service' => 'Service of interest',
        'message' => 'Message',
        'consent' => 'data processing consent',
    ],

    'placeholders' => [
        'name' => 'Your name',
        'email' => 'name@example.com',
        'phone' => 'e.g. +40 7XX XXX XXX',
        'message' => 'Tell us a few details about your project...',
    ],

    'service_default' => 'Choose a service',
    'submit' => 'Send message',
    'sending' => 'Sending...',
    'consent_label' => 'I agree with the :privacy.',
    'consent_link' => 'privacy policy',
    'success' => 'Your message has been sent successfully. Thank you!',
    'rate_limited' => 'You have sent too many messages. Please try again in a few minutes.',
    'spam_detected' => 'We could not process the form. Please reload the page and try again.',
    'prefill_intro' => 'I am interested in the following services:',
    'prefill_duration' => 'Contract length',

    'errors' => [
        'name_invalid' => 'The name may only contain letters, spaces, hyphen and dot.',
        'phone_invalid' => 'Enter a valid phone number (digits, spaces, optionally a leading +).',
        'service_invalid' => 'The selected service is not valid.',
    ],

    'confirmation' => [
        'subject' => 'We received your message — AddWrap',
        'header' => 'Your message just landed with us',
        'greeting' => 'Hi :name,',
        'intro' => 'Thanks for reaching out. We received your message through the AddWrap contact form and will get back to you with a personalized reply within 24 business hours.',
        'recap_label' => 'For your records, here is what you sent:',
        'recap_service' => 'Service of interest',
        'recap_message' => 'Your message',
        'next_steps_title' => 'What happens next',
        'next_steps' => [
            'An AddWrap specialist reviews your context and goals.',
            'We reach out by email or phone for a short discovery call.',
            'You receive a clear proposal: scope, milestones and ballpark budget.',
        ],
        'meanwhile' => 'In the meantime, feel free to browse',
        'link_portfolio' => 'our portfolio',
        'link_services' => 'our services',
        'link_separator' => 'or',
        'signature_lead' => 'Warm regards,',
        'signature_team' => 'The AddWrap team',
        'reply_note' => 'This is an automated confirmation. If you want to add anything, just reply to this email or write to :email.',
        'footer_company' => ':name · :phone · :email',
    ],

];
