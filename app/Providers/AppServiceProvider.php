<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use App\Observers\GlobalObserver;
use Illuminate\Support\Facades\Event;
use App\Models\Account;
use Illuminate\Database\Events\ModelsShouldDiscover;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Account::observe(GlobalObserver::class);
        // Attach the GlobalObserver to all models
        foreach (glob(app_path('Models') . '/*.php') as $file) {
            $model = 'App\\Models\\' . basename($file, '.php');
            if (class_exists($model) && is_subclass_of($model, Model::class) && $model !== 'App\\Models\\Workflow') {
                $model::observe(GlobalObserver::class);
            }
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

