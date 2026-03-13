<?php

return [
    'domain' => env('DOMAIN', 'Localhost'),
    'pagination_length' => env('PAGINATION_LENGTH', 25),
    'auth' => [
        'admin' => 1,
        'staff' => 2,
    ],
    'role' => [
        1 => 'အက်ထ်မင်',
        2 => 'ဝန်ထမ်း'
    ],
    'role.index' => [
        'အက်ထ်မင်' => 1,
        'ဝန်ထမ်း' => 2
    ],
];
