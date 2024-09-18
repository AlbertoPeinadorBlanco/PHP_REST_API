<?php

namespace Controllers;


use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Models\AuthenticationModel;


require_once '../jwt/Key.php';
require_once '../jwt/ExpiredException.php';
require_once '../jwt/JWTExceptionWithPayloadInterface.php';

//Class to implement varous functions related to users and games
class BaseController
{

    //Function to set user tokens
    protected function setToken()
    {

        $token_error = new AuthenticationModel();
        
        
        try
        {
            
            $token = $this -> getBearerToken();


            if($token != null)
            {

                try
                {

                    $payload = JWT::decode($token, new Key('SECRET_KEY', 'HS256'));

                }
                catch(Exception $e)
                {
                    $token_error -> errorMessageTokenInvalid();
                    exit();

                }


            }
            else
            {
                $token_error -> errorMessageNoToken();
                exit();

            }

        }
        catch(ExpiredException $e)
        {

            $token_error -> errorMessageTokenExpired();
            exit();

        }

    }

    //Function to set admin tokens
    protected function setTokenAdmin()
    {

        //$token_error = new AuthenticationModelAdmin();
        $token_error = new AuthenticationModel();
        
        try
        {
            
            $token = $this -> getBearerToken();


            if($token != null)
            {

                try
                {
                    
                    $payload = JWT::decode($token, new Key('SECRET_KEY', 'HS256'));

                    if($payload -> role != 'admin')
                    {
                        $token_error ->errorMessageForbiddenResource();

                    }                  

                }
                catch(Exception $e)
                {
                    $token_error -> errorMessageTokenInvalid();
                    exit();

                }


            }
            else
            {
                $token_error -> errorMessageNoToken();
                exit();

            }

        }
        catch(ExpiredException $e)
        {

            $token_error -> errorMessageTokenExpired();
            exit();

        }
    }

    //Function to read authorisatio parameters in http headers
    public function getAuthorisationHeader()
    {
        $header = null;

        if(isset($_SERVER['Authorization']))
        {

            $header = trim($_SERVER['Authorization']);

        }
        elseif(isset($_SERVER['HTTP_AUTHORIZATION']))
        {

            $header = trim($_SERVER['HTTP_AUTHORIZATION']);

        }
        elseif(function_exists('apache_request_headers'))
        {

            
            //$req_header = apache_request_headers();
            //$req_header = array_combine(array_map('ucwords', array_keys($req_header)), array_values($req_header));

            //print_r($req_header);

            $header = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];

            /*if(isset($req_header['Authorization']))
            {
                //$header = trim($req_header['Authorization']);
                $header = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];


            }*/

        }

        return $header;

    }

    //Function to get the tokens
    public function getBearerToken()
    {

        $header = $this -> getAuthorisationHeader();
        
        if(!empty($header))
        {

            if(preg_match('/Bearer\s(\S+)/', $header, $matches))
            {
                return $matches[1];
            }

        }
        else
        {
            return null;
        }

    }

    //Function to read parameters from http requests
    public function readParameters()
    {

        if(array_key_exists('id', $_GET))
        {
    
            if($_GET['id'] == '')
            {

                $id = 'n_a';

            }
            else
            {

                $id = strval($_GET['id']);

            }

        }
        else if(!array_key_exists('id', $_GET))
        {

            $id = 'n_a';
        }

        if(array_key_exists('name', $_GET))
        {

            if($_GET['name'] == '')
            {

                $name = 'n_a';

            }
            else
            {

                $name = strval($_GET['name']);

            }

        }
        else if(!array_key_exists('name', $_GET))
        {

            $name = 'n_a';

        }
        if(array_key_exists('author', $_GET))
        {

            if($_GET['author'] == '')
            {

                $author = 'n_a';
                
            }
            else
            {

                $author = strval($_GET['author']);

            }

        }
        else if(!array_key_exists('author', $_GET))
        {

            $author = 'n_a';

        }
        if(array_key_exists('genre', $_GET))
        {

            if($_GET['genre'] == '')
            {

                $genre = 'n_a';
                
            }
            else
            {

                $genre = strval($_GET['genre']);

            }

        }
        else if(!array_key_exists('genre', $_GET))
        {

            $genre = 'n_a';

        }
        if(array_key_exists('score', $_GET))
        {

            if($_GET['score'] == '')
            {

                $score = 'n_a';
                
            }
            else
            {

                $score = strval($_GET['score']);

            }

        }
        else if(!array_key_exists('score', $_GET))
        {

            $score = 'n_a';

        }
        if(array_key_exists('year', $_GET))
        {

            if($_GET['year'] == '')
            {

                $year = 'n_a';
                
            }
            else
            {

                $year = strval($_GET['year']);

            }

        }
        else if(!array_key_exists('year', $_GET))
        {

            $year = 'n_a';

        }
        if(array_key_exists('platform', $_GET))
        {

            if($_GET['platform'] == '')
            {

                $platform = 'n_a';
                
            }
            else
            {

                $platform = strval($_GET['platform']);

            }

        }
        else if(!array_key_exists('platform', $_GET))
        {

            $platform = 'n_a';

        }
        if(array_key_exists('password', $_GET))
        {
            
            if($_GET['password'] == '')
            {

                $password = 'n_a';
                
            }
            else
            {

                $password = strval($_GET['password']);

            }
        }
        else if(!array_key_exists('password', $_GET))
        {

            $password = 'n_a';

        }
        if(array_key_exists('role', $_GET))
        {
            
            if($_GET['role'] == '')
            {

                $role = 'n_a';
                
            }
            else
            {

                $role = strval($_GET['role']);

            }
        }
        else if(!array_key_exists('role', $_GET))
        {

            $role = 'n_a';
            
        }

        return $data = $id . '/' . $name . '/' . $author  . '/' . $genre  . '/' . $score  . '/' . $year . '/' . $platform . '/' . $password . '/' . $role;

    }

}