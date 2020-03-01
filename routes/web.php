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

Auth::routes();

// Untuk guest
Route::middleware('web')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/kategori', function () {
        return "Kategori";
    });
});

// Untuk front-end data Chart
Route::get('/sekolah/getDataChart', 'SekolahController@getDataChart');
Route::get('/penyakit/getDataChart', 'PenyakitController@getDataChart');

// Untuk Semua user
Route::middleware('auth', 'web')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Profile
    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::get('/profile/update', 'ProfileController@update')->name('profile.update');
});

// Khusus Admin
Route::prefix('/admin')->middleware('auth', 'isAdmin', 'web')->group(function () {
    // Dashboard admin
    Route::get('/', 'AdminController@index')->name('admin.dashboard');

    // Admin Manage
    Route::prefix('manage')->group(function () {
        // Admin Manage Kategori
        Route::resource('/kategori', 'KategoriController')->names([
            'edit' => 'admin.manage.kategori.edit',
            'index' => 'admin.manage.kategori.index',
            'create' => 'admin.manage.kategori.create',
            'store' => 'admin.manage.kategori.store',
            'show' => 'admin.manage.kategori.show',
            'destroy' => 'admin.manage.kategori.destroy',
            'update' => 'admin.manage.kategori.update',
        ]);

        // Admin Manage Users
        Route::resource('users', 'UserController')->names([
            'edit' => 'admin.manage.users.edit',
            'index' => 'admin.manage.users.index',
            'create' => 'admin.manage.users.create',
            'store' => 'admin.manage.users.store',
            'show' => 'admin.manage.users.show',
            'destroy' => 'admin.manage.users.destroy',
            'update' => 'admin.manage.users.update',
        ]);
    });

    // Admin.kategori
    Route::prefix('/kategori')->group(function () {
        // Pendidikan
        Route::get('/pendidikan', 'PendidikanController@index')->name('admin.pendidikan');
        Route::get('/pendidikan/data_sekolah', 'PendidikanController@data_sekolah')->name('admin.pendidikan.data_sekolah');

        // Kesehatan
        Route::get('/kesehatan', 'KesehatanController@index')->name('admin.kesehatan');
        Route::get('/pendidikan/data_penyakit', 'KesehatanController@data_penyakit')->name('admin.pendidikan.data_penyakit');
    });


    // Admin.sekolah
    Route::resource('sekolah', 'SekolahController')->names([
        'edit' => 'admin.sekolah.edit',
        'index' => 'admin.sekolah.index',
        'create' => 'admin.sekolah.create',
        'store' => 'admin.sekolah.store',
        'show' => 'admin.sekolah.show',
        'destroy' => 'admin.sekolah.destroy',
        'update' => 'admin.sekolah.update',
    ]);
    Route::post('/sekolah/import', 'SekolahController@import')->name('admin.sekolah.import');
    Route::get('/sekolah/export', 'SekolahController@export')->name('admin.sekolah.export');

    // Admin.Penyakit
    Route::resource('penyakit', 'PenyakitController')->names([
        'edit' => 'admin.penyakit.edit',
        'index' => 'admin.penyakit.index',
        'create' => 'admin.penyakit.create',
        'store' => 'admin.penyakit.store',
        'show' => 'admin.penyakit.show',
        'destroy' => 'admin.penyakit.destroy',
        'update' => 'admin.penyakit.update',
    ]);
    Route::post('/penyakit/import', 'PenyakitController@import')->name('admin.penyakit.import');
    Route::get('/penyakit/export', 'PenyakitController@export')->name('admin.penyakit.export');
});
