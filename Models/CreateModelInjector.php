<?php

namespace Models;

//Class used to invert dependencies
class CreateModelInjector
{

    private $i_create;

    function __construct(ICreateModel $create_model)
    {

        $this -> i_create = $create_model;

    }

    public function dataCreate($data)
    {

        $this ->i_create ->createData($data);

    }

}