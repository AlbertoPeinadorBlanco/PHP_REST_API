<?php

namespace Models;
use PDO;
use PDOException;


//Endpoint for updating (put) users
class PutUserModel extends DBModel implements IPutModel
{

    private function nameCheckUser($name)
    {

        try
        {

            $conn = $this -> connect();

            $sql = 'SELECT * FROM tbl_users WHERE username = :name';
                   
                                            
            $query = $conn->prepare($sql);
            $query->bindValue(':name', $name, PDO::PARAM_STR);
            $query->execute();
    
            return $query -> rowCount();
    

        }
        catch(PDOException $e)
        {

            $response = new ResponseModel(500, false, $e->getMessage(), null);
            $response->send('json');
            exit();

        }

    }

    //Function for updating (put) users
    public function putData($data)
    {

        $user_data = explode('/', $data);

        $id = $user_data[0];
        $name = $user_data[1];
        $password = $user_data[7];
        $role = $user_data[8];

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $output_function = new FormatSelectionModel();
        $output_injector = new FormatSelectionModelInjector($output_function);

        $output = $output_injector -> formatChose();

        try
        {

            $conn = $this ->connect();

            if($id == 'n_a' || $name == 'n_a' || $password == 'n_a' || $role == 'n_a')
            {

                $response = new ResponseModel(400, true, ". Please input all the values required (ID, name, password & role).", null);
                $response->send($output);
                exit();

            }
            else
            {

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, true, ". ID must be numeric.", null);
                    $response->send($output);
                    exit();

                }
                else
                {
                    if(is_numeric($name))
                    {

                        $response = new ResponseModel(400, true, ". Name cannot be numeric.", null);
                        $response->send($output);
                        exit();
    

                    }
                    else
                    {

                        if(is_numeric($role))
                        {

                            $response = new ResponseModel(400, true, ". Role cannot be numeric.", null);
                            $response->send($output);
                            exit();
        

                        }
                        else
                        {

                            $sql = "SELECT * FROM tbl_users WHERE id = :id";

                            $statement = $conn -> prepare($sql);
                            $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                            $statement -> execute();
                            $statement -> closeCursor();

        
                            if($statement ->rowCount() == 0)
                            {
                        
                                if($this -> nameCheckUser($name) == 0)
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
                                        
                                    $statement -> closeCursor();

                                    
                                    $response = new ResponseModel(201, false, null, $result);
                                    $response->send($output);
                                    exit();
                                    
                                }
                                else
                                {

                                    $response = new ResponseModel(409, true, ". Username already exists.", null);
                                    $response->send($output);
                                    exit();

                                }                            
        
                            }
                            else
                            {

                                if($this -> nameCheckUser($name) == 0)
                                {

                                    $sql = "UPDATE tbl_users SET username = :name, password = :pword, role = :role WHERE id = :id";

                                    $statement = $conn -> prepare($sql);
                                    $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                    $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                                    $statement -> bindParam(':pword', $hash, PDO::PARAM_STR);
                                    $statement -> bindParam(':role', $role, PDO::PARAM_STR);
                                    $statement -> execute();
            
                                    $statement -> closeCursor();
    
                                    $result = array();
                                    $result['username'] = $name;
                                    $result['password'] = $hash;
                                    $result['role'] = $role;
                                        
            
                                    $response = new ResponseModel(200, false, null, $result);
                                    $response -> send($output);
                                    exit(); 

                                }
                                else
                                {

                                    $response = new ResponseModel(409, true, ". Username already exists.", null);
                                    $response->send($output);
                                    exit();

                                } 

                            }

                        }

                    }

                }

            }

        }
        catch(PDOException $e)
        {

            $response = new ResponseModel(500, false, $e->getMessage(), null);
            $response -> send('json');
            exit();

        }

    }

}

