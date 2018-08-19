<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AccessServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\User\UserRepositoryContract::class,
            \App\Repositories\User\UserRepository::class
        );
        $this->app->bind(
            \App\Repositories\Role\RoleRepositoryContract::class,
            \App\Repositories\Role\RoleRepository::class
        );
        $this->app->bind(
            \App\Repositories\Department\DepartmentRepositoryContract::class,
            \App\Repositories\Department\DepartmentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Location\LocationRepositoryContract::class,
            \App\Repositories\Location\LocationRepository::class
        );
        $this->app->bind(
            \App\Repositories\SampleCode\SampleCodeRepositoryContract::class,
            \App\Repositories\SampleCode\SampleCodeRepository::class
        );
         $this->app->bind(
            \App\Repositories\Source\SourceRepositoryContract::class,
            \App\Repositories\Source\SourceRepository::class
        );
        $this->app->bind(
            \App\Repositories\Setting\SettingRepositoryContract::class,
            \App\Repositories\Setting\SettingRepository::class
        );
        $this->app->bind(
            \App\Repositories\Task\TaskRepositoryContract::class,
            \App\Repositories\Task\TaskRepository::class
        );
        $this->app->bind(
            \App\Repositories\Client\ClientRepositoryContract::class,
            \App\Repositories\Client\ClientRepository::class
        );
        $this->app->bind(
            \App\Repositories\Lead\LeadRepositoryContract::class,
            \App\Repositories\Lead\LeadRepository::class
        );
        $this->app->bind(
            \App\Repositories\Invoice\InvoiceRepositoryContract::class,
            \App\Repositories\Invoice\InvoiceRepository::class
        );
        $this->app->bind(
            \App\Repositories\Quotation\QuotationRepositoryContract::class,
            \App\Repositories\Quotation\QuotationRepository::class
        );
        $this->app->bind(
            \App\Repositories\Product\ProductRepositoryContract::class,
            \App\Repositories\Product\ProductRepository::class
        );
        $this->app->bind(
            \App\Repositories\Activities\ActivitiesRepositoryContract::class,
            \App\Repositories\Activities\ActivitiesRepository::class
        );
        $this->app->bind(
            \App\Repositories\Taxs\TaxsRepositoryContract::class,
            \App\Repositories\Taxs\TaxsRepository::class
        );
    }
}
