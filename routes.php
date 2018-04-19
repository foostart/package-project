<?php

use Illuminate\Session\TokenMismatchException;

/**
 * FRONT
 */
Route::get('project', [
    'as' => 'project',
    'uses' => 'Foostart\Project\Controllers\Front\ProjectFrontController@index'
]);


/**
 * ADMINISTRATOR
 */
Route::group(['middleware' => ['web']], function () {

    Route::group(['middleware' => ['admin_logged', 'can_see', 'in_context'],
                  'namespace' => 'Foostart\Project\Controllers\Admin',
        ], function () {

        /*
          |-----------------------------------------------------------------------
          | Manage project
          |-----------------------------------------------------------------------
          | 1. List of projects
          | 2. Edit project
          | 3. Delete project
          | 4. Add new project
          | 5. Manage configurations
          | 6. Manage languages
          |
        */

        /**
         * list
         */
        Route::get('admin/projects/list', [
            'as' => 'projects.list',
            'uses' => 'ProjectAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/projects/edit', [
            'as' => 'projects.edit',
            'uses' => 'ProjectAdminController@edit'
        ]);

        /**
         * copy
         */
        Route::get('admin/projects/copy', [
            'as' => 'projects.copy',
            'uses' => 'ProjectAdminController@copy'
        ]);

        /**
         * post
         */
        Route::post('admin/projects/edit', [
            'as' => 'projects.post',
            'uses' => 'ProjectAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/projects/delete', [
            'as' => 'projects.delete',
            'uses' => 'ProjectAdminController@delete'
        ]);

        /**
         * trash
         */
         Route::get('admin/projects/trash', [
            'as' => 'projects.trash',
            'uses' => 'ProjectAdminController@trash'
        ]);

        /**
         * configs
        */
        Route::get('admin/projects/config', [
            'as' => 'projects.config',
            'uses' => 'ProjectAdminController@config'
        ]);

        Route::post('admin/projects/config', [
            'as' => 'projects.config',
            'uses' => 'ProjectAdminController@config'
        ]);

        /**
         * language
        */
        Route::get('admin/projects/lang', [
            'as' => 'projects.lang',
            'uses' => 'ProjectAdminController@lang'
        ]);

        Route::post('admin/projects/lang', [
            'as' => 'projects.lang',
            'uses' => 'ProjectAdminController@lang'
        ]);

    });
});
