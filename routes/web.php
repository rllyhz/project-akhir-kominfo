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
Route::get('/penyakit/getDataChart', 'KasusPenyakitController@getDataChart');
Route::get('/pariwisata/getDataChart', 'PariwisataController@getDataChart');
Route::get('/lingkunganHidup/getDataChart', 'LingkunganHidupController@getDataChart');
Route::get('/kependudukan/getDataChart', 'KependudukanController@getDataChart');
Route::get('/pekerjaanUmum/getDataChart', 'PekerjaanUmumController@getDataChart');
Route::get('/penanggulanganBencana/getDataChart', 'PenanggulanganBencanaController@getDataChart');

// Untuk Semua user
Route::middleware('auth', 'web')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Profile
    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::post('/profile/update', 'ProfileController@update')->name('profile.update');
});

// Khusus Admin
Route::prefix('/admin')->middleware('auth', 'isAdmin', 'web')->group(function () {
    // Pariwisata
    Route::get('/pariwisata/dasboard','PariwisataController@dasboard_pariwisata')->name('admin.dasboard_pariwisata');
    Route::get('/pariwisata/add','PariwisataController@cd_pariwisata')->name('admin.par_pariwisata_add');
    Route::get('/pariwisata/export_excell','PariwisataController@export_excell')->name('admin.par_export_excell');
    Route::post('/pariwisata/import_excell','PariwisataController@import_excell')->name('admin.par_import_excell');
    Route::get('/pariwisata/cetak_pdf','PariwisataController@cetak_pdf')->name('admin.par_cetak_pdf');
    Route::resource('/pariwisata','PariwisataController')->names([
            'edit' => 'admin.pariwisata.edit',
            'index' => 'admin.pariwisata.index',
            'create' => 'admin.pariwisata.create',
            'store' => 'admin.pariwisata.store',
            'show' => 'admin.pariwisata.show',
            'destroy' => 'admin.pariwisata.destroy',
            'update' => 'admin.pariwisata.update',
    ]);

    // Lingkungan Hidup
    Route::get('/lingkunganHidup/add','LingkunganHidupController@cd_lingkunganHidup')->name('admin.lh_lingkungan_add');
    Route::get('/lingkunganHidup/dasboard','LingkunganHidupController@dasboard_lingkunganHidup')->name('admin.dasboard_lingkunganHidup');

    Route::get('/lingkunganHidup/export_excell','LingkunganHidupController@export_excell')->name('admin.lh_export_excell');
    Route::post('/lingkunganHidup/import_excell','LingkunganHidupController@import_excell')->name('admin.lh_import_excell');
    Route::get('/lingkunganHidup/cetak_pdf','LingkunganHidupController@cetak_pdf')->name('admin.lh_cetak_pdf');
    Route::resource('/lingkunganHidup','LingkunganHidupController')->names([
            'edit' => 'admin.lingkunganHidup.edit',
            'index' => 'admin.lingkunganHidup.index',
            'create' => 'admin.lingkunganHidup.create',
            'store' => 'admin.lingkunganHidup.store',
            'show' => 'admin.lingkunganHidup.show',
            'destroy' => 'admin.lingkunganHidup.destroy',
            'update' => 'admin.lingkunganHidup.update',
    ]);
    // Kependudukan
    Route::get('/kependudukan/add','KependudukanController@cd_kependudukan')->name('admin.kep_pend_add');
    Route::get('/kependudukan/dasboard','KependudukanController@dasboard_kependudukan')->name('admin.dasboard_kependudukan');

    Route::get('/kependudukan/export_excell','KependudukanController@export_excell')->name('admin.kep_export_excell');
    Route::post('/kependudukan/import_excell','KependudukanController@import_excell')->name('admin.kep_import_excell');
    Route::get('/kependudukan/cetak_pdf','KependudukanController@cetak_pdf')->name('cetak_pdf');
    Route::resource('/kependudukan','KependudukanController')->names([
            'edit' => 'admin.kependudukan.edit',
            'index' => 'admin.kependudukan.index',
            'create' => 'admin.kependudukan.create',
            'store' => 'admin.kependudukan.store',
            'show' => 'admin.kependudukan.show',
            'destroy' => 'admin.kependudukan.destroy',
            'update' => 'admin.kependudukan.update',
    ]);

    // Pekerjaan Umum
    Route::get('/pekerjaanUmum/add','PekerjaanUmumController@cd_pekerjaanUmum')->name('admin.pek_pekerjaan_umum_add');
    Route::get('/pekerjaanUmum/dasboard','PekerjaanUmumController@dasboard_pekerjaanUmum')->name('admin.dasboard_pekerjaanUmum');

    Route::get('/pekerjaanUmum/export_excell','PekerjaanUmumController@export_excell')->name('admin.pu_export_excell');
    Route::post('/pekerjaanUmum/import_excell','PekerjaanUmumController@import_excell')->name('admin.pu_import_excell');
    Route::get('/pekerjaanUmum/cetak_pdf','PekerjaanUmumController@cetak_pdf')->name('admin.pu_cetak_pdf');
    Route::resource('/pekerjaanUmum','PekerjaanUmumController')->names([
            'edit' => 'admin.pekerjaanUmum.edit',
            'index' => 'admin.pekerjaanUmum.index',
            'create' => 'admin.pekerjaanUmum.create',
            'store' => 'admin.pekerjaanUmum.store',
            'show' => 'admin.pekerjaanUmum.show',
            'destroy' => 'admin.pekerjaanUmum.destroy',
            'update' => 'admin.pekerjaanUmum.update',
    ]);

    // Penanggulangan Bencana
    Route::get('/penanggulanganBencana/add','PenanggulanganBencanaController@cd_penanggulangan_bencana')->name('admin.pen_penanggulangan_bencana_add');
    Route::get('/penanggulanganBencana/dasboard','PenanggulanganBencanaController@dasboard_penanggulanganBencana')->name('admin.dasboard_penanggulanganBencana');

    Route::get('/penanggulanganBencana/export_excell','PenanggulanganBencanaController@export_excell')->name('admin.pb_export_excell');
    Route::post('/penanggulanganBencana/import_excell','PenanggulanganBencanaController@import_excell')->name('admin.pb_import_excell');
    Route::get('/penanggulanganBencana/cetak_pdf','PenanggulanganBencanaController@cetak_pdf')->name('admin.pb_cetak_pdf');
    Route::resource('/penanggulanganBencana','PenanggulanganBencanaController')->names([
            'edit' => 'admin.penanggulanganBencana.edit',
            'index' => 'admin.penanggulanganBencana.index',
            'create' => 'admin.penanggulanganBencana.create',
            'store' => 'admin.penanggulanganBencana.store',
            'show' => 'admin.penanggulanganBencana.show',
            'destroy' => 'admin.penanggulanganBencana.destroy',
            'update' => 'admin.penanggulanganBencana.update',
    ]);
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
    Route::resource('penyakit', 'KasusPenyakitController')->names([
        'edit' => 'admin.penyakit.edit',
        'index' => 'admin.penyakit.index',
        'create' => 'admin.penyakit.create',
        'store' => 'admin.penyakit.store',
        'show' => 'admin.penyakit.show',
        'destroy' => 'admin.penyakit.destroy',
        'update' => 'admin.penyakit.update',
    ]);
    Route::post('/penyakit/import', 'KasusPenyakitController@import')->name('admin.penyakit.import');
    Route::get('/penyakit/export', 'KasusPenyakitController@export')->name('admin.penyakit.export');

    // Admin.Pariwisata
    Route::get('/pariwisata/dasboard', 'PariwisataController@dasboard_pariwisata')->name('admin.dasboard_pariwisata');
    Route::get('/pariwisata/add', 'PariwisataController@cd_pariwisata')->name('admin.par_pariwisata_add');
    Route::get('/pariwisata/export_excell', 'PariwisataController@export_excell')->name('admin.par_export_excell');
    Route::post('/pariwisata/import_excell', 'PariwisataController@import_excell')->name('admin.par_import_excell');
    Route::get('/pariwisata/cetak_pdf', 'PariwisataController@cetak_pdf')->name('admin.par_cetak_pdf');
    Route::resource('/pariwisata', 'PariwisataController')->names([
        'edit' => 'admin.pariwisata.edit',
        'index' => 'admin.pariwisata.index',
        'create' => 'admin.pariwisata.create',
        'store' => 'admin.pariwisata.store',
        'show' => 'admin.pariwisata.show',
        'destroy' => 'admin.pariwisata.destroy',
        'update' => 'admin.pariwisata.update',
    ]);
});
