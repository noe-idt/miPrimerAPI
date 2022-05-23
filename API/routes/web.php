<?php

/** @var \Laravel\Lumen\Routing\Router $router */
use App\Http\Controllers\ObjetoController;

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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('usuarios', ['uses' => 'ObjetoController@listar']);
    $router->get('usuarios/{id}', ['uses' => 'ObjetoController@obtenerDetalle']);
    $router->post('usuarios/nuevo', ['uses' => 'ObjetoController@agregar']);
    $router->post('usuarios/editar/{id}', ['uses' => 'ObjetoController@editar']);
    $router->get('usuarios/eliminar/{id}', ['uses' => 'ObjetoController@eliminar']);
});

$router->group(['prefix' => 'api/marcas'], function () use ($router) {
    $router->get('index', ['uses' => 'MarcaController@listar']);
    $router->get('/{id}', ['uses' => 'MarcaController@obtenerDetalle']);
    $router->post('/nuevo', ['uses' =>'MarcaController@agregar']);
    $router->post('/editar/{id}', ['uses' => 'MarcaController@editar']);
    $router->get('/eliminar/{id}', ['uses' =>'MarcaController@eliminar']);
});

$router->group(['prefix' => 'api/perfiles'], function () use ($router) {
    $router->get('index', ['uses' => 'PerfilesController@listar']);
    $router->get('/{id}', ['uses' => 'PerfilesController@obtenerDetalle']);
    $router->post('/nuevo', ['uses' =>'PerfilesController@agregar']);
    $router->post('/editar/{id}', ['uses' => 'PerfilesController@editar']);
    $router->get('/eliminar/{id}', ['uses' =>'PerfilesController@eliminar']);
});