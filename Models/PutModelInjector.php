<?php

namespace Models;

//Class used to invert dependencies
class PutModelInjector
{

    private $i_put;


    function __construct(IPutModel $put_model)
    {

        $this -> i_put = $put_model;

    }

    public function dataPut($data)
    {

        $this -> i_put -> putData($data);

    }

}