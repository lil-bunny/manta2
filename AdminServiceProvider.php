
function: php
docstring: This function is used to open and start a PHP script.
purpose: In software development, the php function is a crucial tool for executing PHP code. It allows developers to open and run PHP scripts, which are used to create dynamic and interactive web pages. This function is essential for building websites and web applications that require server-side scripting. It also enables the integration of PHP with HTML, CSS, and other web development languages, making it a versatile and powerful tool for creating dynamic web content.<?php

function: register
docstring: Registers the service provider for the admin module.
purpose: This function is used to register the service provider for the admin module, allowing it to be loaded and utilized within the software. This is important for seamless integration and functionality of the admin module within the larger software system. namespace Modules\Admin\Providers;
 function:register
  docstring:Registers the service provider into the Laravel application.
  purpose:This functionality allows developers to easily add and integrate custom service providers into their Laravel application, providing a clean and organized way to extend the functionality of the framework. This helps improve the maintainability and modularity of the codebase, making it easier to add new features and make changes without affecting the core framework. use Illuminate\Support\ServiceProvider;

function:make
docstring:Creates a new instance of a model and persists it to the database.
purpose:This functionality is used to easily generate and save new model instances in a database. It is particularly useful for seeding databases and creating test data.use Illuminate\Database\Eloquent\Factory;
 function: boot()
  docstring: Boots the application events for the Admin module, including registering translations, config, views, and migrations.
  purpose: This function is used to initialize and set up the Admin module for use in the application. It ensures that all necessary components, such as translations and configurations, are properly loaded and available for use.
class AdminServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Admin';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'admin';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
