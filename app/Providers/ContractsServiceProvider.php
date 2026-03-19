<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ContractsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->bindContracts('dao', [
            'AdminDao',
            'AuthDao',
            'PaymentMethodDao',
            'MachineDao',
        ]);

        $this->bindContracts('services', [
            'AdminService',
            'AuthService',
            'PaymentMethodService',
            'MachineService',
        ]);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    /**
     *Bind Contracts of Dao or Services
     *@param string $type
     *@param array $classes
     */
    private function bindContracts(string $type, array $classes)
    {
        $type = ucfirst($type);
        foreach ($classes as $class) {
            $contract = "App\\Contracts\\{$type}\\{$class}Interface";
            $className = "App\\{$type}\\{$class}";
            $this->app->bind($contract, $className);
        }
    }
}
