<?php

namespace Controllers;

use Models\AuthenticationModel;
use Models\AuthenticationModelAdmin;


//This class serves as a bridge between models and controllers
class AuthenticationController implements IAuthentication, IAuthenticationAdmin
{

    //Function to get user's tokens from the endpoint
    public function getToken()
    {

        $token_error = new AuthenticationModel();
        $token_error -> authenticateUser();
        

    } 

    //Function to get administrator's tokens from the endpoint
    public function getTokenAdmin()
    {

        $admin = new AuthenticationModel();
        $admin->authenticateUser();

    }

}