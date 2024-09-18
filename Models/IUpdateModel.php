<?php


namespace Models;

//Interface to implement in the update (patch) classes
interface IUpdateModel
{

    public function updateData($data);

}