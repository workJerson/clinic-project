<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(
    ['middleware' => 'cors'],
    function () {
        Route::group(
            ['prefix' => 'auth'],
            function () {
                Route::post('login', 'AuthController@login');
                Route::post('signup', 'AuthController@signup');
            }
        );
        Route::group(
            ['middleware' => 'auth:api'],
            function () {
                Route::get('auth/logout', 'AuthController@logout');
                Route::get('me', 'GetAuthenticatedUserInfo')->name('me');

                Route::resource('regions', 'RegionController', ['only' => ['index', 'show']]);
                Route::resource('province', 'ProvinceController', ['only' => ['index', 'show']]);
                Route::resource('files', 'FileController', ['only' => ['store', 'destroy']]);

                // Users
                Route::resource('users', 'UserController', ['except' => ['create', 'edit', 'destroy']]);
                Route::resource('user-details', 'UserDetailController', ['except' => ['create', 'edit', 'destroy']]);

                // Patient
                Route::resource('patients', 'PatientController', ['except' => ['edit', 'destroy']]);
                Route::resource('patient-hmos', 'PatientHmoController', ['except' => ['edit', 'destroy']]);

                // Service
                Route::resource('services', 'ServiceController', ['except' => ['edit', 'destroy']]);
                Route::resource('service-types', 'ServiceTypeController', ['except' => ['edit', 'destroy']]);

                // Personnel
                Route::resource('personnels', 'PersonnelController', ['except' => ['edit', 'destroy']]);

                // HMO
                Route::resource('hmos', 'HMOController', ['except' => ['edit', 'destroy']]);
            }
        );
    }
);
