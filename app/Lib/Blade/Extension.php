<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Lib\Blade;

use Illuminate\Support\Facades\Blade;

/**
 * Description of Extension
 *
 */
class Extension
{
    /**
     * add blade directive
     *
     * @return void
     */
    public static function extendBlade()
    {
        static::registerDebugDirectives();

        Blade::directive('let', function ($expression) {
            return "<?php ($expression); ?>";
        });
        Blade::directive('php', function ($expression) {
            return "<?php $expression; ?>";
        });
        Blade::directive('token', function ($expression) {
            return "<?php echo csrf_field(); ?>";
        });
        Blade::directive('method', function ($expression) {
            return "<?php echo method_field($expression); ?>";
        });
        Blade::directive('errorIf', function ($expression) {
            return '<div class="error-box">'."<?php echo (\$errors->first($expression)); ?>".'</div>';
        });
        Blade::directive('scope', function ($expression) {
            return "<?php echo add_scope($expression); ?>";
        });
        Blade::directive('script', function ($expression) {
            return "<?php echo add_script($expression); ?>";
        });
        Blade::directive('scriptIf', function ($expression) {
            return "<?php echo add_script_if($expression); ?>";
        });
        Blade::directive('css', function ($expression) {
            return "<?php echo add_css($expression); ?>";
        });
        Blade::directive('cssIf', function ($expression) {
            return "<?php echo add_css_if($expression); ?>";
        });
    }

    /**
     * add driective for debuggin purpose
     *
     * @return void
     */
    protected static function registerDebugDirectives()
    {
        Blade::directive('dd', function ($expression) {
            if (config('app.debug')) {
                return "<?php dd($expression); ?>";
            }
        });
        Blade::directive('log', function ($expression) {
            if (config('app.debug')) {
                return "<?php \Log::info($expression); ?>";
            }
        });
        Blade::directive('debug', function ($expression) {
            if (!config('app.debug')) {
                return "<?php if(false): ?>";
            }
        });
        Blade::directive('enddebug', function ($expression) {
            if (!config('app.debug')) {
                return '<?php endif; ?>';
            }
        });
        Blade::directive('dump', function($param) {
            if (config('app.debug')) {
                return "<?php echo (new \App\Lib\CpsBlade\Dumper)->dump($param); ?>";
            }
        });
    }
}
