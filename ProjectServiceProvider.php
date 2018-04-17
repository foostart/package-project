<?php

namespace Foostart\Project;

use Illuminate\Support\ServiceProvider;
use LaravelAcl\Authentication\Classes\Menu\SentryMenuFactory;

use URL, Route;
use Illuminate\Http\Request;


class ProjectServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Request $request) {
        /**
         * Publish
         */
         $this->publishes([
            __DIR__.'/config/project_admin.php' => config_path('project_admin.php'),
        ],'config');

        $this->loadViewsFrom(__DIR__ . '/views', 'project');


        /**
         * Translations
         */
         $this->loadTranslationsFrom(__DIR__.'/lang', 'project');


        /**
         * Load view composer
         */
        $this->projectViewComposer($request);

         $this->publishes([
                __DIR__.'/../database/migrations/' => database_path('migrations')
            ], 'migrations');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        include __DIR__ . '/routes.php';

        /**
         * Load controllers
         */
        $this->app->make('Foostart\Project\Controllers\Admin\ProjectAdminController');

         /**
         * Load Views
         */
        $this->loadViewsFrom(__DIR__ . '/views', 'project');
    }

    /**
     *
     */
    public function projectViewComposer(Request $request) {

        view()->composer('project::project*', function ($view) {
            global $request;
            $project_id = $request->get('id');
            $is_action = empty($project_id)?'page_add':'page_edit';

            $view->with('sidebar_items', [

                /**
                 * Projects
                 */
                //list
                trans('project::project_admin.page_list') => [
                    'url' => URL::route('admin_project'),
                    "icon" => '<i class="fa fa-users"></i>'
                ],
                //add
                trans('project::project_admin.'.$is_action) => [
                    'url' => URL::route('admin_project.edit'),
                    "icon" => '<i class="fa fa-users"></i>'
                ],

                /**
                 * Categories
                 */
                //list
                trans('project::project_admin.page_category_list') => [
                    'url' => URL::route('admin_project_category'),
                    "icon" => '<i class="fa fa-users"></i>'
                ],
            ]);
            //
        });
    }

}
