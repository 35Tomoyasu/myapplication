<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/laravel', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {

    // ルーティングの設定（ホーム画面）
    Route::get('/', 'HomeController@index')->name('home');
    
    // ルーティングの設定（フォルダ一覧）
    Route::get('/folders/{id}/tasks', 'TaskController@index')->name('tasks.index');

    // ルーティングの設定（フォルダ作成）
    Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
    Route::post('/folders/create', 'FolderController@create');

    // ルーティングの設定（フォルダ編集）
    Route::get('/folders/{id}/edit', 'FolderController@showEditForm')->name('folders.edit');
    Route::post('/folders/{id}/edit', 'FolderController@edit');

    // // ルーティングの設定（フォルダ削除）
    Route::delete('/folders/{id}/delete', 'FolderController@delete')->name('folders.delete');

    // ルーティングの設定（タスク作成）
    Route::get('/folders/{id}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
    Route::post('/folders/{id}/tasks/create', 'TaskController@create');

    // ルーティングの設定（タスク編集）
    Route::get('/folders/{id}/tasks/{task_id}/edit', 'TaskController@showEditForm')->name('tasks.edit');
    Route::post('/folders/{id}/tasks/{task_id}/edit', 'TaskController@edit');

    // ルーティングの設定（タスク削除）
    Route::post('/folders/{id}/tasks/{task_id}/', 'TaskController@delete')->name('tasks.delete');

});


// ルーティングの設定（会員登録機能）
Auth::routes();
