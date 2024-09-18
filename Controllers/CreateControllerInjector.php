<?php

namespace Controllers;

//Class for inverting dependencies
class CreateControllerInjector
{

    private $i_create_controller;

    function __construct(ICreateController $create_controller)
    {

        $this -> i_create_controller = $create_controller;

    }

    public function dataCreate()
    {

        $this -> i_create_controller-> createData();

    }

}