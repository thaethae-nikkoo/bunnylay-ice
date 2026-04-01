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
    'machine_product_type' => [
        'ice_block' => 1,
        'ice_tube' => 2,
        'ice_cube' => 3,
        'flake_ice' => 4,
    ],
    'machine_product_type_label' => [
        1 => 'ရေခဲတုံးအကြီး',
        2 => 'ရေခဲ tube ',
        3 => 'ရေခဲတုံးအသေး',
        4=> 'ရေခဲမွှ',
    ],
    'machine_status' => [
        'active' => 1,
        'inactive' => 2,
    ],
    'machine_status_label' => [
        1 => 'Active',
        2 => 'Inactive',
    ],
    'machine_capacity_mode' => [
        'hour' => 'hour',
        'shift' => 'shift',
        'day' => 'day',
        'night' => 'night',
        'whole_day' => 'whole_day',
    ],
    'machine_capacity_mode_label' => [
        'hour' => 'Hour',
        'shift' => 'Shift',
        'day' => 'Day',
        'night' => 'Night',
        'whole_day' => 'Whole Day',
    ],
    'description_type_key' => [
        'income' => 1,
        'expense' => 2,
        'both' => 3
    ],
];
