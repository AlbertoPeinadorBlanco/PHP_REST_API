<?php

namespace Controllers;

//Class for inverting dependencies
class DeleteControllerInjector
{

    private $i_delete;


    function __construct(IDeleteController $delete_controller)
    {

        $this -> i_delete = $delete_controller;

    }

    public function dataDelete()
    {

        $this -> i_delete -> deleteData();

    }

}