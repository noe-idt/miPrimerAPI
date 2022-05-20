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

/*$router->group(['prefix' => 'api'], function () use ($router) {

    $router->get('authors', ['uses' => 'AuthorController@showAllAuthors']);

    $router->get('authors/{id}', ['uses' => 'AuthorController@showOneAuthor']);

    $router->post('authors', ['uses' => 'AuthorController@create']);

    $router->delete('authors/{id}', ['uses' => 'AuthorController@delete']);

    $router->put('authors/{id}', ['uses' => 'AuthorController@update']);
});*/