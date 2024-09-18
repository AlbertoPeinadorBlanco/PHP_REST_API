<?php

namespace Controllers;

//Class for inverting dependencies
class AuthenticationInjector
{

   private $i_authentication;


    function __construct(IAuthentication $authentication)
    {

        $this -> i_authentication = $authentication;

    }

    public function authenticate()
    {

        $this ->i_authentication -> getToken();

    }

}
