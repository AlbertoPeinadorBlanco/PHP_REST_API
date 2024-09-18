<?php

namespace Models;

use Models\DBModel;
use Firebase\JWT\JWT;
use PDO;
use PDOException;

require_once '../jwt/JWT.php';

//Class to serve as endpoint for user authentication and handle error messages relating to token validation
class AuthenticationModel extends DBModel
{

    //Function to check for user and password and create a token using a payload array
    public function authenticateUser()
    {

        $output_function = new FormatSelectionModel();
        $output_injector = new FormatSelectionModelInjector($output_function);

        $output = $output_injector -> formatChose();

        try
        {

            $header = getallheaders();

            $conn = $this ->connect();


            if(array_key_exists('User', $header))
            {

                $name = $header['User'];
                

                if($name !== '')
                {

                    if(!is_numeric($name))
                    {

                        $sql = "SELECT * FROM tbl_users WHERE username = :username";

                        $statement = $conn -> prepare($sql);
                        $statement -> bindValue(':username', $name, PDO::PARAM_STR);
                        $statement -> execute();
                        
                        
                        if($statement->rowCount() != 0)
                        {
                            
                            $result = $statement->fetch(PDO::FETCH_ASSOC);
                            


                            $hash = $result['password'];


                            if(array_key_exists('Password', $header))
                            {

                                $password = $header['Password'];

                                $verified = password_verify($password, $hash);
    
                                
                                if($verified == true)
                                {

                                    $payload = [
    
                                        'iat' => time(),
                                        'iss' => 'localhost',
                                        'exp' => time() + (300),
                                        'userID' => $result['id'],
                                        'role' => $result['role']
    
                                    ];
    
                                    
                                    $token = JWT::encode($payload, 'SECRET_KEY', 'HS256');
                                        
                                    $data = 'Token: ' . $token;
    
                                    $response = new ResponseModel(200, false, null, $data);
                                    $response -> send($output);
                                    exit(); 
    
                                }
                                else
                                {
    
                                    $response = new ResponseModel(401, false, '. Invalid credentials!', null);
                                    $response -> send($output);
                                    exit();
    
                                }

                            }
                            else
                            {

                                $response = new ResponseModel(400, false, '. Password must be inputted!', null);
                                $response -> send($output);
                                exit();

                            }
                         

                        }
                        else
                        {

                            $response = new ResponseModel(401, false, '. Invalid credentials!', null);
                            $response -> send($output);
                            exit();

                        }
                    
                    }
                    else
                    {

                        $response = new ResponseModel(400, false, '. Name cannot be numeric!', null);
                        $response -> send($output);
                        exit();

                    }         

                }
                else
                {

                    $response = new ResponseModel(400, false, '. Name cannot be empty!', null);
                    $response -> send($output);
                    exit();

                }

            }
            else
            {

                $response = new ResponseModel(400, false, '. Name must be inputted!', null);
                $response -> send($output);
                exit();

            }
            

        }
        catch(PDOException $e)
        {

            $response = new ResponseModel(500, false, $e->getMessage(), null);
            $response -> send($output);
            exit();

        }

    }

    //Function to display an error message if no access token is present
    public function errorMessageNoToken()
    {

        $output_function = new FormatSelectionModel();
        $output_injector = new FormatSelectionModelInjector($output_function);

        $output = $output_injector -> formatChose();
        $response = new ResponseModel(401, false, 'Access token required!', null);
        $response -> send($output);
        exit();

    }

    //Function to display an error message if an access token is expired
    public function errorMessageTokenExpired()
    {

        $output_function = new FormatSelectionModel();
        $output_injector = new FormatSelectionModelInjector($output_function);

        $output = $output_injector -> formatChose();
        $response = new ResponseModel(401, false, 'Access token expired!', null);
        $response -> send($output);
        exit();

    }

    //Function to display an error message if the inputted access token is invalid
    public function errorMessageTokenInvalid()
    {

        $output_function = new FormatSelectionModel();
        $output_injector = new FormatSelectionModelInjector($output_function);

        $output = $output_injector -> formatChose();
        $response = new ResponseModel(401, false, 'Access token invalid!', null);
        $response -> send($output);
        exit();

    }

    //Function to display an error message if the access token provided don't allow access to the intended resource
    public function errorMessageForbiddenResource()
    {

        $output_function = new FormatSelectionModel();
        $output_injector = new FormatSelectionModelInjector($output_function);

        $output = $output_injector -> formatChose();
        $response = new ResponseModel(403, false, null, null);
        $response -> send($output);
        exit();

    }

}