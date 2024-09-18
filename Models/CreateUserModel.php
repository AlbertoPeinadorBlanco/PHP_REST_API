<?php

namespace Models;
use PDO;
use PDOException;


//Endpoint for creating user objects
class CreateUserModel extends DBModel implements ICreateModel
{

    //Function to input a new user item into the database
    public function createData($data)
    {

        $user_data = explode('/', $data);

        $name = $user_data[1];
        $password = $user_data[7];
        $role = $user_data[8];

        
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $output_function = new FormatSelectionModel();
        $output_injector = new FormatSelectionModelInjector($output_function);

        $output = $output_injector -> formatChose();


        try
        {

            $conn = $this -> connect();


            if($name != 'n_a' && $password != 'n_a' && $role != 'n_a')
            {

                if(!is_numeric($name) && !is_numeric($role))
                {

                    $sql = "SELECT * FROM tbl_users WHERE username = :name";

                    $statement = $conn -> prepare($sql);
                    $statement -> bindValue(':name', $name, PDO::PARAM_STR);
                    $statement -> execute();
                    

                    if($statement -> rowCount() != 0)
                    {

                        $response = new ResponseModel(409, false, '. User already exists!');
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        $sql2 = "INSERT INTO tbl_users (username, password, role) VALUES (:name, :password, :role)";

                        $statement = $conn -> prepare($sql2);
    
                        $statement -> bindValue(':name', $name, PDO::PARAM_STR);
                        $statement -> bindValue(':password', $hash, PDO::PARAM_STR);
                        $statement -> bindValue(':role', $role, PDO::PARAM_STR);
                        $statement -> execute();
                        
                        $result = array();
                        $result['username'] = $name;
                        $result['password'] = $hash;
                        $result['role'] = $role;
                            
                        
                        $response = new ResponseModel(201, false, null, $result);
                        $response->send($output);
                        exit();

                    }

                }
                else
                {

                    $response = new ResponseModel(400, false, '. Username & role cannot be numerical!', null);
                    $response->send($output);
                    exit();

                }

            }
            else
            {

                $response = new ResponseModel(400, true, ". Name, password and role cannot be empty!", null);
                $response->send($output);
                exit();

            }

        }
        catch(PDOException $e)
        {

            $response = new ResponseModel(500, false, $e->getMessage(), null);
            $response->send('json');
            exit();

        }

    }

}