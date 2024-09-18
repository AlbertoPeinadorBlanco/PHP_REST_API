<?php

use Controllers\RouterController;
use Controllers\RouterControllerInjector;


//ini_set('display_errors', 1);


const BASE_PATH = __DIR__.'/../';

require BASE_PATH.'Core/Functions.php';

//Function to autoload files
spl_autoload_register(function ($class)
{
    $class = str_replace('\\', '/', $class);

    require  base_path("{$class}.php");

});



$router = new RouterController();
$router_injector = new RouterControllerInjector($router);

$router_injector -> routing();



















