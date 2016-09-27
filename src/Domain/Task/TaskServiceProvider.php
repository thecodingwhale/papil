<?php

namespace Papil\Domain\Task;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

use Papil\Infrastructure\Repositories\TaskRepository;
use Papil\Domain\Task\Contracts\TaskContract;
use Papil\Domain\Task\Models\Task;

class TaskServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = '\Papil\Domain\Task\Controller';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //
        parent::boot();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('TaskContract', function()
        {
            return new TaskRepository(new Task);
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        Route::group([
            'middleware' => 'api',
            'namespace' => $this->namespace
        ], function ($router) {
            require base_path('src/Domain/Task/routes.php');
        });
    }
}
