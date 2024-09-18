<?php

namespace Models;

//Class for inverting dependencies
class ReadModelInjector
{

    private $i_read;


    function __construct(IRead $read)
    {

        $this -> i_read = $read;

    }

    public function dataRead($data)
    {

        $this -> i_read -> readData($data);

    }

}