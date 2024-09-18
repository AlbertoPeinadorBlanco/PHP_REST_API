<?php

namespace Models;
use PDO;
use PDOException;

//Endpoint for updating users (patch)
class UpdateUserModel extends DBModel implements IUpdateModel
{

    //Function for updating users (patch)
    public function updateData($data)
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

            $conn = $this -> connect();

            if($id != 'n_a')
            {

                
                if(is_numeric($id))
                {
                    
                    $sql = 'SELECT * FROM tbl_users WHERE id = :id';
               
                                
                    $statement = $conn->prepare($sql);
                    $statement -> bindValue(':id', $id, PDO::PARAM_INT);
                    $statement -> execute();
                    $statement -> closeCursor();
  
                    
                    if($statement -> rowCount() == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {
                        
                        if($name != 'n_a' && $password != 'n_a' && $role != 'n_a')
                        {
                       
                            if(!is_numeric($name))
                            {

                                $sql2 = 'SELECT * FROM tbl_users WHERE username = :username';
                            
                                    
                                $statement = $conn->prepare($sql2);
                                $statement->bindValue(':username', $name, PDO::PARAM_STR);
                                $statement->execute();
                                $statement -> closeCursor();

        
        
                                if($statement ->rowCount() != 0)
                                {
        
                                    $response = new ResponseModel(409, false, '. User already exists!');
                                    $response -> send($output);
                                    exit();
        
                                }
                                else
                                {

                                    if(!is_numeric($role))
                                    {

                                        $sql3 = "UPDATE tbl_users SET username = :name, password = :pword, role = :role WHERE id = :id";
            
                                       
                                        $statement = $conn -> prepare($sql3);
                                        $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                        $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                                        $statement -> bindParam(':pword', $hash, PDO::PARAM_STR);
                                        $statement -> bindParam(':role', $role, PDO::PARAM_STR);
                                        $statement -> execute();
                
                                        $statement -> closeCursor();
                

                                        $response = new ResponseModel(200, false, null, null);
                                        $response -> send($output);
                                        exit(); 

                                    }
                                    else
                                    {

                                        $response = new ResponseModel(400, false, '. Role cannot be numeric!', null);
                                        $response -> send($output);
                                        exit();

                                    }
                
                                }

                            }
                            else
                            {

                                $response = new ResponseModel(400, false, '. Name cannot be numeric!', null);
                                $response -> send($output);
                                exit();

                            }            
       
                        }
                       
                        if($name != 'n_a' && $password == 'n_a' && $role == 'n_a')
                        {

                            //name

                            if(!is_numeric($name))
                            {

                                $sql = "UPDATE tbl_users SET username = :name WHERE id = :id";
            
                                $statement = $conn -> prepare($sql);
                                $statement -> bindValue(':id', $id, PDO::PARAM_INT);
                                $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                                $statement -> execute();
        
                                $statement -> closeCursor();

        
                                $response = new ResponseModel(200, false, null, null);
                                $response -> send($output);
                                exit(); 

                            }
                            else
                            {

                                $response = new ResponseModel(400, false, '. Name cannot be numeric!', null);
                                $response -> send($output);
                                exit();

                            }

                        }
                        if($name == 'n_a' && $password != 'n_a' && $role == 'n_a')
                        {

                            //password

                            $sql = "UPDATE tbl_users SET password = :password WHERE id = :id";
        
                            $statement = $conn -> prepare($sql);
                            $statement -> bindParam(':id', $id);
                            $statement -> bindParam(':password', $hash, PDO::PARAM_STR);
                            $statement -> execute();
    
                            $statement -> closeCursor();

    
                            $response = new ResponseModel(200, false, null, null);
                            $response -> send($output);
                            exit(); 

                        }
                        if($name == 'n_a' && $password == 'n_a' && $role != 'n_a')
                        {

                            //role

                            $sql = "UPDATE tbl_users SET role = :role WHERE id = :id";
        
                            $statement = $conn -> prepare($sql);
                            $statement -> bindValue(':id', $id, PDO::PARAM_INT);
                            $statement -> bindParam(':role', $role, PDO::PARAM_STR);
                            $statement -> execute();
    
                            $statement -> closeCursor();

    
                            $response = new ResponseModel(200, false, null, null);
                            $response -> send($output);
                            exit(); 

                        }
                        if($name != 'n_a' && $password != 'n_a' && $role == 'n_a')
                        {

                            //name and password

                            if(!is_numeric($name))
                            {

                                $sql = "UPDATE tbl_users SET username = :name, password = :password WHERE id = :id";
            
                                $statement = $conn -> prepare($sql);
                                $statement -> bindValue(':id', $id, PDO::PARAM_INT);
                                $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                                $statement ->bindParam(':password', $hash, PDO::PARAM_STR);
                                $statement -> execute();
        
                                $statement -> closeCursor();

                                $response = new ResponseModel(200, false, null, null);
                                $response -> send($output);
                                exit(); 

                            }
                            else
                            {

                                $response = new ResponseModel(400, false, '. Name cannot be numeric!', null);
                                $response -> send($output);
                                exit();

                            }

                        }
                        if($name != 'n_a' && $password == 'n_a' && $role != 'n_a')
                        {

                            //name and role

                            if(!is_numeric($name) && !is_numeric($role))
                            {

                                $sql = "UPDATE tbl_users SET username = :name, role = :role WHERE id = :id";
            
                                $statement = $conn -> prepare($sql);
                                $statement -> bindValue(':id', $id, PDO::PARAM_INT);
                                $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                                $statement -> bindParam(':role', $role, PDO::PARAM_STR);

                                $statement -> execute();
        
                                $statement -> closeCursor();
        

                                $response = new ResponseModel(200, false, null, null);
                                $response -> send($output);
                                exit(); 

                            }
                            else
                            {

                                $response = new ResponseModel(400, false, '. Name & role cannot be numeric!', null);
                                $response -> send($output);
                                exit();

                            }

                        }
                        if($name == 'n_a' && $password != 'n_a' && $role != 'n_a')
                        {

                            //password and role
                            
                            if(!is_numeric($role))
                            {

                                $sql = "UPDATE tbl_users SET password = :password, role = :role WHERE id = :id";
            
                                $statement = $conn -> prepare($sql);
                                $statement -> bindValue(':id', $id, PDO::PARAM_INT);
                                $statement -> bindParam(':password', $hash, PDO::PARAM_STR);
                                $statement -> bindParam(':role', $role, PDO::PARAM_STR);

                                $statement -> execute();
        
                                $statement -> closeCursor();

        
                                $response = new ResponseModel(200, false, null, null);
                                $response -> send($output);
                                exit(); 

                            }
                            else
                            {

                                $response = new ResponseModel(400, false, '. Name & role cannot be numeric!', null);
                                $response -> send($output);
                                exit();

                            }

                        }
                        else
                        {

                            $response = new ResponseModel(400, false, '. Action failed!', null);
                            $response -> send($output);
                            exit();

                        }

                    }
                      
                }
                else
                {
    
                    $response = new ResponseModel(400, false, '. ID must be numerical!', null);
                    $response -> send($output);
                    exit();
    
                }
            }
            else
            {

                $response = new ResponseModel(400, false, '. ID cannot be empty!', null);
                $response -> send($output);
                exit();

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