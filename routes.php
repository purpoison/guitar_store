<?php
$page = "home";
if (isset($_GET['page'])) {
    $page = $_GET['page'];
};

$routes = [
    'home' => 'ProductController:index',
    'new' => 'ProductController:new',
    'used' => 'ProductController:used',
    'about' => 'ProductController:about',
    'contacts' => 'ProductController:contacts',
    'search' => 'ProductController:search',
    '404' =>  'ProductController:status404'
];

$handler = $routes['404'];
if (array_key_exists($page, $routes)) {
    $handler = $routes[$page];
    list($controller, $method) = explode(":", $handler);
    require_once CONTROLLERS_PATH . "/{$controller}.php";
    $controllerOBj = new $controller();
    $controllerOBj->$method();
}
