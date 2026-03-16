<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_methods')->insert([
            [
                'payment_method_id' => 1,
                'method_name' => 'Cash (ငွေသား)',
                'status' => config('constants.payment_method_status_key.active'),
                'created_by' => 1,
                'created_at' => now(),
            ],
        ]);
    }
}
