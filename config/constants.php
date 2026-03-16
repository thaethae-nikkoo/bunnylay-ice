<?php

return [
    'domain' => env('DOMAIN', 'Localhost'),
    'pagination_length' => env('PAGINATION_LENGTH', 25),
    'auth' => [
        'super_admin' => 1,
        'admin' => 2,
    ],
    'role' => [
        1 => 'Super Admin',
        2 => 'Admin'
    ],
    'role.index' => [
        'super_admin' => 1,
        'admin' => 2
    ],
     'payment_method_status_key' => [
        'active' => 1,
        'inactive' => 2,
    ],
    'cash_payment_method_name' => 'Cash (ငွေသား)',
];
