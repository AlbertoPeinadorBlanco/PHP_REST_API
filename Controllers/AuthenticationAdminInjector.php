<?php

namespace Controllers;

//Class used to invert dependencies
class AuthenticationAdminInjector
{

    private $i_authentication_Admin;
    

    function __construct(IAuthenticationAdmin $authentication)
    {

        $this -> i_authentication_Admin = $authentication;

    }

    public function authenticate()
    {

        $this ->i_authentication_Admin -> getTokenAdmin();

    }

}