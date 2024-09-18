<?php

namespace Controllers;

//Class for inverting dependencies
class PutControllerInjector
{

    private $i_put;


    function __construct(IPutController $putController)
    {

        $this -> i_put = $putController;

    }

    public function dataPut()
    {

        $this -> i_put -> putData();

    }

}