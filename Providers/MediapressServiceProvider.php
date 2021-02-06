<?php

namespace Modules\Mediapress\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Traits\CanGetSidebarClassForModule;
use Modules\Mediapress\Events\Handlers\RegisterMediapressSidebar;
use GuzzleHttp\Client;

class MediapressServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration, CanGetSidebarClassForModule;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();

        $this->app['events']->listen(
            BuildingSidebar::class,
            $this->getSidebarClassForModule('Mediapress', RegisterMediapressSidebar::class)
        );

        $this->app->extend('asgard.ModulesList', function($app) {
            array_push($app, 'mediapress');
            return $app;
        });

//        \Validator::extend('check_domain', function ($attributes, $value, $parameters, $validator) {
//            if(!is_null($value)) {
//                try {
//                    $client = new Client();
//                    $client->request('GET', $value);
//                    return true;
//                }
//                catch (\Exception $exception) {
//                    return false;
//                }
//            }
//            return true;
//        });

        \Widget::register('mediapressLatest', '\Modules\Mediapress\Widgets\MediaPressWidget@latest');
        \Widget::register('mediapressCategories', '\Modules\Mediapress\Widgets\MediaPressWidget@categories');
        \Widget::register('mediapressYears', '\Modules\Mediapress\Widgets\MediaPressWidget@years');
        \Widget::register('mediapressYearsByCategory', '\Modules\Mediapress\Widgets\MediaPressWidget@yearsByCategory');
    }

    public function boot()
    {
        $this->publishConfig('mediapress', 'permissions');
        $this->publishConfig('mediapress', 'config');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Mediapress\Repositories\MediaRepository',
            function () {
                $repository = new \Modules\Mediapress\Repositories\Eloquent\EloquentMediaRepository(new \Modules\Mediapress\Entities\Media());

                if (!config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Mediapress\Repositories\Cache\CacheMediaDecorator($repository);
            }
        );

        $this->app->bind(
            'Modules\Mediapress\Repositories\CategoryRepository',
            function () {
                $repository = new \Modules\Mediapress\Repositories\Eloquent\EloquentCategoryRepository(new \Modules\Mediapress\Entities\Category());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Mediapress\Repositories\Cache\CacheCategoryDecorator($repository);
            }
        );
    }
}
