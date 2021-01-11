<?php

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'admin'], function () { 
        
        // フォルダの設定
        Route::get('/folders/create', 'Admin\FolderController@create')->name('admin.folders.create');
        Route::post('/folders/create', 'Admin\FolderController@store')->name('admin.folders.store');
        Route::get('/folders/{id}/edit', 'Admin\FolderController@edit')->name('admin.folders.edit');
        Route::post('/folders/{id}/edit', 'Admin\FolderController@update')->name('admin.folders.update');
        Route::post('/folders/{id}/', 'Admin\FolderController@delete')->name('admin.folders.delete');

        // タスクの設定
        Route::get('/folders/{id}/tasks', 'Admin\TaskController@index')->name('admin.tasks.index');
        Route::get('/folders/{id}/tasks/create', 'Admin\TaskController@create')->name('admin.tasks.create');
        Route::post('/folders/{id}/tasks/create', 'Admin\TaskController@store')->name('admin.tasks.store');
        Route::get('/folders/{id}/tasks/{task_id}/edit', 'Admin\TaskController@edit')->name('admin.tasks.edit');
        Route::post('/folders/{id}/tasks/{task_id}/edit', 'Admin\TaskController@update')->name('admin.tasks.update');
        Route::post('/folders/{id}/tasks/{task_id}/', 'Admin\TaskController@delete')->name('admin.tasks.delete');
    });
});

Auth::routes();
