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
    'service_other' => 'Something else',
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
        'subject' => 'Confirmation: we received your message | addWrap',
        'header' => 'Your message has reached us',
        'greeting' => 'Hi :name,',
        'intro' => 'Thank you for your interest in addWrap. Your message has been received and will be reviewed by a member of our team shortly.',
        'reply_eta' => 'You can expect a personalized reply within 24 business hours.',
        'recap_label' => 'For your records, here are the details of the message you sent:',
        'recap_service' => 'Service of interest',
        'recap_message' => 'Your message',
        'next_steps_title' => 'What happens next',
        'next_steps' => [
            'We review your business context and the goals you mentioned.',
            'We reach out for a short discovery conversation, by email or phone.',
            'You receive a personalized proposal: scope, milestones and ballpark budget.',
        ],
        'meanwhile' => 'In the meantime, feel free to explore',
        'link_portfolio' => 'our portfolio',
        'link_services' => 'our service packages',
        'link_separator' => 'or',
        'signature_lead' => 'With appreciation,',
        'signature_team' => 'The addWrap team',
        'signature_tagline' => 'Strategy, creative and performance, under one roof.',
        'reply_note' => 'This is an automated confirmation message. For additional details, reply directly to this email or write to us at :email.',
        'footer_business' => ':name · Digital marketing agency',
        'footer_contact' => ':phone · :email',
        'footer_follow' => 'Find us also on',
    ],

];
