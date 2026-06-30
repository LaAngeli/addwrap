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

];
