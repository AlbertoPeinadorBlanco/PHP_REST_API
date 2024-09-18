<?php

namespace Models;

//Class used to invert dependencies
class UpdateModelInjector
{

    private $i_update;

    function __construct(IUpdateModel $update_user)
    {

        $this -> i_update = $update_user; 

    }

    public function dataUpdate($data)
    {

        $this -> i_update -> updateData($data);

    }

}