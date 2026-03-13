<?php

namespace App\Providers;

use App\Models\Good;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Validator;

class ValidatorServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Validator::extend('mm_tel', function ($attribute, $value, $parameters, $validator) {
            // new MyanmarPhone;
        });

        /** input date must be before current date */
        Validator::extend('before_today', function ($attribute, $value, $parameters, $validator) {
            $inputDate = Carbon::createFromFormat('Y-m-d', $value);
            $currentDate = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));

            return $currentDate->gte($inputDate);
        });
    }
}
