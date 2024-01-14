<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/login', 'AuthController@login');
$router->post('/register', 'AuthController@register');


$router->group(['middleware' => 'auth:api'], function () use ($router) {
    // $router->get('/', function () {
    //     // Uses Auth Middleware
    // });

    $router->get('user/profile', function () {
        // Uses Auth Middleware
    });
    $router->post('logout', 'AuthController@logout');
    $router->post('refresh', 'AuthController@refresh');
    $router->post('me', 'AuthController@me');

    $router->get('/mahasiswa','MahasiswaController@index');
    $router->post('/mahasiswa','MahasiswaController@store');
    $router->put('/mahasiswa/{id}','MahasiswaController@update');
    $router->get('/mahasiswa/{id}','MahasiswaController@show');
    $router->delete('/mahasiswa/{id}','MahasiswaController@destroy');

    
    $router->get('/dosen','DosenController@index');
    $router->post('/dosen','DosenController@store');
    $router->put('/dosen/{id}','DosenController@update');
    $router->get('/dosen/{id}','DosenController@show');
    $router->delete('/dosen/{id}','DosenController@destroy');

    $router->get('/matakuliah','MataKuliahController@index');
    $router->post('/matakuliah','MataKuliahController@store');
    $router->put('/matakuliah/{id}','MataKuliahController@update');
    $router->get('/matakuliah/{id}','MataKuliahController@show');
    $router->delete('/matakuliah/{id}','MataKuliahController@destroy');

    $router->get('/penilaian','PenilaianController@index');
    $router->post('/penilaian','PenilaianController@store');
    $router->put('/penilaian/{id}','PenilaianController@update');
    $router->get('/penilaian/{id}','PenilaianController@show');
    $router->delete('/penilaian/{id}','PenilaianController@destroy');

});