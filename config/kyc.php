<?php

return [
    'countries' => [
        'Australia', 'Bangladesh', 'Brazil', 'Canada', 'China', 'France', 'Germany', 'India',
        'Indonesia', 'Italy', 'Japan', 'Mexico', 'Netherlands', 'New Zealand', 'Pakistan',
        'Singapore', 'South Africa', 'United Arab Emirates', 'United Kingdom', 'United States',
    ],
    'document_types' => [
        'default' => [
            'user' => ['Passport', 'National ID', 'Driver Licence', 'Residence Permit', 'Other'],
            'business' => ['Passport', 'National ID', 'Driver Licence', 'Residence Permit', 'Other'],
        ],
        'India' => [
            'user' => ['Aadhaar Card', 'Passport', 'Driving Licence', 'Voter ID', 'Other'],
            'business' => ['Aadhaar Card', 'Passport', 'Driving Licence', 'PAN Card', 'Other'],
        ],
        'United States' => [
            'user' => ['Passport', 'Driver Licence', 'State ID', 'Other'],
            'business' => ['Passport', 'Driver Licence', 'State ID', 'Other'],
        ],
        'Canada' => [
            'user' => ['Passport', 'Provincial ID', 'Driver Licence', 'Permanent Resident Card', 'Other'],
            'business' => ['Passport', 'Provincial ID', 'Driver Licence', 'Permanent Resident Card', 'Other'],
        ],
    ],
];
