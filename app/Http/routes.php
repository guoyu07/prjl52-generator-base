<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect('/home');
});


/*
|--------------------------------------------------------------------------
| API routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'api', 'namespace' => 'API'], function () {
    Route::group(['prefix' => 'v1'], function () {
        require config('infyom.laravel_generator.path.api_routes');
    });
});

Route::get('/home', 'HomeController@index');

Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder');

Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate');

Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate');

/*
|--------------------------------------------------------------------------
| Backend routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'backend', 'namespace' => 'Backend'], function () {
	// Backend Auth
	Route::get('/login', ['as' => 'backend.getLogin', 'uses' => 'AuthController@getLogin']);
    Route::post('/login', ['as' => 'backend.postLogin', 'uses' => 'AuthController@postLogin']);
    Route::get('/logout', ['as' => 'backend.getLogout', 'uses' => 'AuthController@getLogout']);

    // Password Reset Routes
    Route::get('/password/reset', '\App\Http\Controllers\Auth\PasswordController@getEmail');
    Route::post('/password/email', '\App\Http\Controllers\Auth\PasswordController@postEmail');
    Route::get('/password/reset/{token}', '\App\Http\Controllers\Auth\PasswordController@getReset');
    Route::post('/password/reset', '\App\Http\Controllers\Auth\PasswordController@postReset');

    Route::group(['middleware' => 'auth.backend'], function () {
    	// Default
    	Route::get('/', ['as' => 'backend.news.index', 'uses' => 'NewsController@index']);
        // Sort
        Route::post('/sort', ['as' => 'backend.sort', 'uses' => '\Rutorika\Sortable\SortableController@sort']);

		// News Routes
    	Route::group(['prefix' => 'news'], function () {
    		Route::get('/', ['as' => 'backend.news.index', 'uses' => 'NewsController@index']);
    		Route::get('/{id}/edit', ['as' => 'backend.news.edit', 'uses' => 'NewsController@edit']);
    		Route::get('/create', ['as' => 'backend.news.create', 'uses' => 'NewsController@create']);
    		Route::post('/', ['as' => 'backend.news.store', 'uses' => 'NewsController@store']);
    		Route::put('/{id}', ['as' => 'backend.news.update', 'uses' => 'NewsController@update']);
    		Route::delete('/{id}/delete', ['as' => 'backend.news.destroy', 'uses' => 'NewsController@destroy']);
    		Route::get('/{id}/attachment/{attachment_id}/delete', ['as' => 'backend.attachment.destroy', 'uses' => 'NewsController@destroyAttachment']);
    	});

        // Department Routes
        Route::group(['prefix' => 'department'], function () {
            Route::get('/', ['as' => 'backend.department.index', 'uses' => 'DepartmentController@index']);
            Route::get('/{id}/edit', ['as' => 'backend.department.edit', 'uses' => 'DepartmentController@edit']);
            Route::get('/create', ['as' => 'backend.department.create', 'uses' => 'DepartmentController@create']);
            Route::post('/', ['as' => 'backend.department.store', 'uses' => 'DepartmentController@store']);
            Route::put('/{id}', ['as' => 'backend.department.update', 'uses' => 'DepartmentController@update']);
            Route::delete('/{id}/delete', ['as' => 'backend.department.destroy', 'uses' => 'DepartmentController@destroy']);
        });
    });
});


