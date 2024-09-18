<?php

namespace Models;

//Class for inverting dependencies
class DeleteModelInjector
{

    private $i_delete;

    function __construct(IDeleteModel $delete_model)
    {

        $this -> i_delete = $delete_model;

    }

    public function dataDelete($id)
    {

        $this -> i_delete -> deleteData($id);

    }

}