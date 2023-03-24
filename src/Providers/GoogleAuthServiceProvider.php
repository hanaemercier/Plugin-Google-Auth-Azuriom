<?php

namespace Azuriom\Plugin\GoogleAuth\Providers;

use Azuriom\Extensions\Plugin\BasePluginServiceProvider;
use Azuriom\Models\Permission;
use Azuriom\Plugin\GoogleAuth\Models\Google;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Azuriom\Plugin\GoogleAuth\Http\Middleware\CheckForMaintenance;

class GoogleAuthServiceProvider extends BasePluginServiceProvider
{
    /**
     * The plugin's global HTTP middleware stack.
     *
     * @var array
     */
    protected array $middleware = [
        // \Azuriom\Plugin\GoogleAuth\Middleware\ExampleMiddleware::class,
    ];

    /**
     * The plugin's route middleware groups.
     *
     * @var array
     */
    protected array $middlewareGroups = [];

    /**
     * The plugin's route middleware.
     *
     * @var array
     */
    protected array $routeMiddleware = [
        // 'example' => \Azuriom\Plugin\GoogleAuth\Middleware\ExampleRouteMiddleware::class,
    ];

    /**
     * The policy mappings for this plugin.
     *
     * @var array
     */
    protected array $policies = [
        // User::class => UserPolicy::class,
    ];

    /**
     * Register any plugin services.
     *
     * @return void
     */
    public function register()
    {
        // $this->registerMiddleware();
    }

    /**
     * Bootstrap any plugin services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViews();

        $this->loadTranslations();

        $this->loadMigrations();

        $this->registerRouteDescriptions();

        $this->registerAdminNavigation();

        $this->registerUserNavigation();

        Permission::registerPermissions([
            'google-auth.admin' => 'google-auth::admin.permission',
        ]);

    }
    
    /**
     * Returns the routes that should be able to be added to the navbar.
     *
     * @return array
     */
    protected function routeDescriptions()
    {
        return [
            'google-auth.login' => trans('Google Auth'),
        ];
    }

    /**
     * Return the admin navigations routes to register in the dashboard.
     *
     * @return array
     */
    protected function adminNavigation()
    {
        return [
            'google-auth' => [
                'name' => trans('Google Auth'),
                'icon' => 'bi bi-google',
                'route' => 'google-auth.admin.settings',
                'permission' => 'google-auth.admin'
            ],
        ];
    }
    /**
     * Return the user navigations routes to register in the user menu.
     *
     * @return array
     */
    protected function userNavigation()
    {
        return [
            //
        ];
    }
}
