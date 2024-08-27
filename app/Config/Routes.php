<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use Config\Services;

/**
 * @var \CodeIgniter\Router\RouteCollection $routes
 */
$routes = Services::routes();

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('AuthController');
$routes->setDefaultMethod('entrar');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

// Carrega o sistema de rotas padrão do CodeIgniter
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

// Rota padrão para redirecionar para /entrar
$routes->get('/', function () {
    return redirect()->to('/entrar');
});

$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::loginPost');
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::registerPost');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/posts', 'PostController::index', ['filter' => 'auth']);
$routes->get('/post/create', 'PostController::create', ['filter' => 'auth']);
$routes->post('/post/store', 'PostController::store', ['filter' => 'auth']);
$routes->get('/post/edit/(:num)', 'PostController::edit/$1', ['filter' => 'auth']);
$routes->post('/post/update/(:num)', 'PostController::update/$1', ['filter' => 'auth']);
$routes->get('/post/delete/(:num)', 'PostController::delete/$1', ['filter' => 'auth']);

$routes->get('/forgot-password', 'PasswordController::forgotPassword');
$routes->post('/forgot-password', 'PasswordController::sendResetLink');
$routes->get('/reset-password/(:segment)', 'PasswordController::resetPassword/$1');
$routes->post('/reset-password', 'PasswordController::updatePassword');