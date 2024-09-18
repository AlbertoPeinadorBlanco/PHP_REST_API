<?php


namespace Controllers;

//Class for inverting dependencies
class ReadControllerInjector
{

    private $i_read_controller;

    function __construct(IReadController $controller)
    {

        $this -> i_read_controller = $controller;

    }

    public function dataRead()
    {

        $this -> i_read_controller -> readData();

    }

}