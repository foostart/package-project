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

    Route::group(['middleware' => ['admin_logged', 'can_see']], function () {

        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////PROJECTS ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        /**
         * list
         */
        Route::get('admin/project/list', [
            'as' => 'admin_project',
            'uses' => 'Foostart\Project\Controllers\Admin\ProjectAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/project/edit', [
            'as' => 'admin_project.edit',
            'uses' => 'Foostart\Project\Controllers\Admin\ProjectAdminController@edit'
        ]);

        /**
         * post
         */
        Route::post('admin/project/edit', [
            'as' => 'admin_project.post',
            'uses' => 'Foostart\Project\Controllers\Admin\ProjectAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/project/delete', [
            'as' => 'admin_project.delete',
            'uses' => 'Foostart\Project\Controllers\Admin\ProjectAdminController@delete'
        ]);
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////PROJECTS ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////




        
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////CATEGORIES///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
         Route::get('admin/project_category', [
            'as' => 'admin_project_category',
            'uses' => 'Foostart\Project\Controllers\Admin\ProjectCategoryAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/project_category/edit', [
            'as' => 'admin_project_category.edit',
            'uses' => 'Foostart\Project\Controllers\Admin\ProjectCategoryAdminController@edit'
        ]);

        /**
         * post
         */
        Route::post('admin/project_category/edit', [
            'as' => 'admin_project_category.post',
            'uses' => 'Foostart\Project\Controllers\Admin\ProjectCategoryAdminController@post'
        ]);
         /**
         * delete
         */
        Route::get('admin/project_category/delete', [
            'as' => 'admin_project_category.delete',
            'uses' => 'Foostart\Project\Controllers\Admin\ProjectCategoryAdminController@delete'
        ]);
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////CATEGORIES///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
    });
});
