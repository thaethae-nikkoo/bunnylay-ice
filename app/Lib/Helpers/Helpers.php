<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Exceptions\HttpResponseException;

if (!function_exists('add_script')) {

    /**
     * add script file to view
     *
     * @param string $script
     * @return string
     */
    function add_script(string $script)
    {
        if (strpos($script, '/') !== 0) {
            $script = '/scripts/' . str_replace('.', '/', $script) . '.js';
        }
        return (config('app.debug') ? PHP_EOL : '') . '<script src="' . $script . '" ></script>';
    }
}

if (!function_exists('add_script_if')) {

    /**
     * add script if script file exist
     *
     * @param [type] $script
     * @return string
     */
    function add_script_if($script): string
    {
        if (strpos($script, '/') !== 0) {
            $script = '/scripts/' . str_replace('.', '/', $script) . '.js';
        }
        if (\file_exists($_SERVER['DOCUMENT_ROOT'] . $script)) {
            return add_script($script);
        }
        return '';
    }
}

if (!function_exists('add_scope')) {
    /**
     * scope php variable to script as json data
     *
     * @param array $vars
     * @param string $scope
     * @return string
     */
    function add_scope($vars, $scope = 'vars')
    {
        return '<script class="_scope hidden" hidden data-scope="' . $scope . '" type="text/json" >'
            . json_encode($vars, JSON_HEX_TAG | (config('app.debug') ? JSON_PRETTY_PRINT : 0))
            . '</script>'
            . add_script('/js/scope.js');
    }
}

if (!function_exists('route_input')) {

    /**
     * get route intput
     *
     * @param string $key
     * @return void
     */
    function route_input($key = null)
    {
        return $key ? Route::input($key) : Route::current()->parameters();
    }
}

if (!function_exists('carbon')) {
    /**
     * carbon
     *
     * @param string $datetime
     * @return Carbon
     */
    function carbon($datetime = 'now')
    {
        return Carbon::parse($datetime);
    }
}

if (!function_exists('is_active_route')) {
    /**
     * check active route for menu active
     *
     * @param string|array $path
     * @return boolean
     */
    function is_active_route(string|array $path): bool
    {
        if (!is_array($path)) {
            return Str::is($path, request()->route()->getName() ?? '');
        }

        foreach ($path as $value) {
            if (Str::is($value, request()->route()->getName()) ?? '') {
                return true;
            }
        }
        return false;
    }
}

if (!function_exists('check_session_or_fail')) {
    /**
     * check session value
     * return redirect failback route or abort 404 if session has no required field
     * @param string $key
     * @param string $failback
     * @return boolean
     */
    function check_session_or_fail(string $key, string $failback): bool
    {
        if (Session::has($key) && !empty(Session::get($key))) {
            return true;
        }
        throw new HttpResponseException(redirect($failback ?: abort(404)));
    }
}


if (!function_exists('url_params')) {
    /**
     * get url parameters
     *
     * @return array
     */
    function url_params(): array
    {
        return Route::current()->parameters();
    }
}

if (!function_exists('add_css')) {

    /**
     * add css file to view
     *
     * @param string $css
     * @return string
     */
    function add_css(string $css)
    {
        if (strpos($css, DIRECTORY_SEPARATOR) !== 0) {
            $css = DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . str_replace('.', DIRECTORY_SEPARATOR, $css) . '.css';
        }
        return (config('app.debug') ? PHP_EOL : '') . '<link rel="stylesheet" href="' . $css . '">';
    }
}

if (!function_exists('add_css_if')) {

    /**
     * add css if css file exist
     *
     * @param [type] $css
     * @return string
     */
    function add_css_if($css): string
    {
        if (strpos($css, DIRECTORY_SEPARATOR) !== 0) {
            $css = DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . str_replace('.', DIRECTORY_SEPARATOR, $css) . '.css';
        }
        if (\file_exists($_SERVER['DOCUMENT_ROOT'] . $css)) {
            return add_css($css);
        }
        return '';
    }
}

if (!function_exists('format_date')) {
    /**
     * format date into d/m/Y format
     *
     * @param string|null $date
     * @return string
     */
    function format_date(string|null $date): string
    {
        return empty($date) ? $date : date('d/m/Y', strtotime($date));
    }
}

if (!function_exists('dmy_to_ymd')) {
    /**
     * Parse DD/MM/YYYY -> Carbon (or return null if invalid)
     *
     * @param string|null $date
     * @return Carbon|null
     */
      function dmy_to_ymd(?string $input): ?Carbon
    {
        if (!$input) return null;

        try {
            // Accept both "DD/MM/YYYY" and "YYYY-MM-DD"
            if (preg_match('#^\d{2}/\d{2}/\d{4}$#', $input)) {
                return Carbon::createFromFormat('d/m/Y', $input)->startOfDay();
            }
            if (preg_match('#^\d{4}-\d{2}-\d{2}$#', $input)) {
                return Carbon::createFromFormat('Y-m-d', $input)->startOfDay();
            }
        } catch (\Throwable $e) {
            return null;
        }
        return null;
    }
}

if (!function_exists('format_date_time')) {
    /**
     * format date into d/m/Y h:i A format
     *
     * @param string|null $date
     * @return string|null
     */
    function format_date_time(string|null $date)
    {
        return empty($date) ? $date : date('d/m/Y h:i A', strtotime($date));
    }

    if (!function_exists('formatViss')) {
        /**
         * e.g. 10      -> "10 ပိဿာ"
         *      10.25   -> "10 ပိဿာ 25 ကျပ်သား"
         *      10.05   -> "10 ပိဿာ 5 ကျပ်သား"   // leading zero မပြ
         */
        function formatViss($viss, bool $withUnit = true): string
        {
            if ($viss === null || $viss === '') return '';

            $normalized = str_replace([',', ' '], '', (string)$viss);
            if (!is_numeric($normalized)) return (string)$viss;

            $neg = ((float)$normalized) < 0;
            $abs = abs((float)$normalized);

            $totalKyattha = (int) round($abs * 100);
            $vissInt      = intdiv($totalKyattha, 100);
            $kyattha      = $totalKyattha % 100;

            if (!$withUnit) {
                // units မထည့်ချင်တဲ့ edit page အတွက်: 10.00 → 10, 10.50 → 10.5
                $s = number_format($vissInt + $kyattha / 100, 2, '.', '');
                return rtrim(rtrim($s, '0'), '.');
            }

            $out = ($neg ? '-' : '') . $vissInt . ' ပိဿာ';
            if ($kyattha > 0) {
                $out .= ' ' . (int)$kyattha . ' ကျပ်သား';
            }
            return $out;
        }
    }


    if (!function_exists('clean_number')) {
        function clean_number($value, $decimals = 4)
        {
            $float = (float) $value;
            // Format number with thousands separator and fixed decimal places
            $formatted = number_format($float, $decimals, '.', ',');

            // Remove trailing zeros and optional dot
            return rtrim(rtrim($formatted, '0'), '.');
        }
    }

    if (!function_exists('remove_unvaluable_zero')) {
        function remove_unvaluable_zero($value, $decimals = 4)
        {
            // Format as string with fixed decimals
            $formatted = number_format((float) $value, $decimals, '.', '');
            // Remove trailing zeros only after decimal point
            $formatted = rtrim(rtrim($formatted, '0'), '.');
            return $formatted;
        }
    }
}
