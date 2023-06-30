<?php

define('VIEWS_PATH', __DIR__ . "/views");
define("CONTROLLERS_PATH", __DIR__ . "/controllers");
define("MODELS_PATH", __DIR__ . "/models");
define("FUNCTIONS_PATH", __DIR__ . "/functions");
define("MAIN_MENU", [
    'home' => 'Home',
    'new' => 'New arrivals',
    'used' => 'Used',
    'about' => 'About us',
    'contacts' => 'Contacts'
]);

// $navMenu = [
//     'home' => [
//         'mainMenu' => true,
//         'template' => VIEWS_PATH . "/home.php",
//         'title' => 'Home'

//     ],
//     'new' => [
//         'mainMenu' => true,
//         'template' => VIEWS_PATH . "/new.php",
//         'title' => 'New arrivals'
//     ],
//     'used' => [
//         'mainMenu' => true,
//         'template' => VIEWS_PATH . "/used.php",
//         'title' => 'Used'
//     ],
//     'about' => [
//         'mainMenu' => true,
//         'template' => VIEWS_PATH . "/about.php",
//         'title' => 'About US'
//     ],
//     'contacts' => [
//         'mainMenu' => true,
//         'template' => VIEWS_PATH . "/contacts.php",
//         'title' => 'Contacts'
//     ],
//     '404' => [
//         'mainMenu' => false,
//         'template' => VIEWS_PATH . "/404.php",
//     ]
// ];

spl_autoload_register(function ($className) {
    $filePath = CONTROLLERS_PATH . "/{$className}.php";
    if (is_readable($filePath)) {
        include_once $filePath;
    }
});

spl_autoload_register(function ($className) {
    $filePath = MODELS_PATH . "/{$className}.php";
    if (is_readable($filePath)) {
        include_once $filePath;
    }
});


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
