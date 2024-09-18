<?php

namespace Controllers;

//Class used to invert dependencies
class UpdateControllerInjector
{

    private $i_update;


    function __construct(IUpdateController $update_controller)
    {

        $this -> i_update = $update_controller;

    }

    public function dataUpdate()
    {

        $this -> i_update -> updateData();

    }

}