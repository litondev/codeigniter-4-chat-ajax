<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'User\HomeController::index');
$routes->get('/signin','User\HomeController::signin',['filter' => 'not-auth']);
$routes->get("/signup",'User\HomeController::signup',['filter' => 'not-auth']);
$routes->post('/signin','User\AuthController::signin',['filter' => 'not-auth']);
$routes->post('/signup','User\AuthController::signup',['filter' => 'not-auth']);

$routes->get("/logout","User\AuthController::logout",['filter' => 'user-auth']);

$routes->get('/profil','User\ProfilController::index',['filter' => 'user-auth']);
$routes->post('/edit-profil-data','User\ProfilController::editProfilData',['filter' => 'user-auth']);
$routes->post('/edit-profil-photo','User\ProfilController::editProfilPhoto',['filter' => 'user-auth']);

$routes->get('/channel','User\ChannelController::index',['filter' => 'user-auth']);
$routes->get('/get-user','User\ChannelController::getUser',['filter' => 'user-auth']);
$routes->get('/add-channel','User\ChannelController::addChannel',['filter' => 'user-auth']);
$routes->post('/create-channel/(:num)','User\ChannelController::createChannel/$1',['filter' => 'user-auth']);

$routes->get('/user','User\ChatController::index',['filter' => 'user-auth']);
$routes->get('/chat/(:num)','User\ChatController::chat/$1',['filter' => 'user-auth']);
$routes->post('/chat/message/(:num)','User\ChatController::message/$1',['filter' => 'user-auth']);

$routes->get('/admin','Admin\HomeController::index',['filter' => 'admin-auth']);

$routes->get('/admin/setting','Admin\SettingController::index',['filter' => 'admin-auth']);
$routes->post('/admin/setting','Admin\SettingController::edit',['filter' => 'admin-auth']);

$routes->get('/admin/user','Admin\UserController::index',['filter' => 'admin-auth']);
$routes->post('/admin/edit-user','Admin\UserController::edit',['filter' => 'admin-auth']);

$routes->get('/admin/chat','Admin\ChatController::index',['filter' => 'admin-auth']);
$routes->get('/admin/chat-status/(:num)','Admin\ChatController::status/$1',['filter' => 'admin-auth']);

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
