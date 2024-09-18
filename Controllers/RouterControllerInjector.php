<?php

namespace Controllers;

use Controllers\IRouterController;

//Class for inverting dependencies
class RouterControllerInjector
{

    private $i_router;

    function __construct(IRouterController $router_controller)
    {

        $this -> i_router = $router_controller;

    }

    public function routing()
    {

        $this -> i_router -> route();

    }
}