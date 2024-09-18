<?php

namespace Models;
use PDO;
use PDOException;


//Endpoint to read users from the database
class ReadUserModel extends DBModel implements IRead
{
   
    //Function to read users from the database
    public function readData($data)
    {

        $user_data = explode('/', $data);

        $id = $user_data[0];
        $name = $user_data[1];
        $role = $user_data[8];

        $output_function = new FormatSelectionModel();
        $output_injector = new FormatSelectionModelInjector($output_function);

        $output = $output_injector -> formatChose();
        
       
        try
        {

            $conn = $this ->connect();

            $result = array();


            if($id == 'n_a' && $name == 'n_a' && $role == 'n_a')
            {

                //all users

                $sql = "SELECT * FROM tbl_users";

                $statement = $conn -> prepare($sql);
                $statement -> execute();


                if($statement -> rowCount() != 0)
                {

                    while($row = $statement -> fetch(PDO::FETCH_ASSOC))
                    {
                        $result[] = $row;
                    }
    
                    $statement -> closeCursor();
    
                    
                    $response = new ResponseModel(200, true, null, $result);
                    $response -> send($output);
                    exit();

                }
                else
                {
                    $response = new ResponseModel(404, true, null, null);
                    $response->send($output);
                    exit();

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $role == 'n_a')
            {

                //by id

                if(is_numeric($id))
                {

                    if($id == 0)
                    {

                        $response = new ResponseModel(400, true, ". ID must be greater than 0!", null);
                        $response->send($output);
                        exit();

                    }
                    else
                    {

                        $sql = "SELECT * FROM tbl_users WHERE id = :id";

                        $statement = $conn -> prepare($sql);
                        $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                        $statement -> execute();

                        if($statement -> rowCount() != 0)
                        {

                            while($row = $statement -> fetch(PDO::FETCH_ASSOC))
                            {
                                $result[] = $row;
                            }
            
                            $statement -> closeCursor();
            
                            
                            $response = new ResponseModel(200, true, null, $result);
                            $response -> send($output);
                            exit();

                        }
                        else
                        {
                            $response = new ResponseModel(404, true, null, null);
                            $response->send($output);
                            exit();

                        }

                    }                 

                }
                else
                {

                    $response = new ResponseModel(400, true, ". ID must be numeric!", null);
                    $response->send($output);
                    exit();

                }

            }
            if($id == 'n_a' && $name != 'n_a' && $role == 'n_a')
            {

                //by name

                if(is_numeric($name))
                {

                    $response = new ResponseModel(400, true, ". Name cannot be numeric!", null);
                    $response->send($output);
                    exit();

                }
                else
                {

                    $sql = "SELECT * FROM tbl_users WHERE username = :name";

                    $statement = $conn -> prepare($sql);
                    $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                    $statement -> execute();

                    if($statement -> rowCount() != 0)
                    {

                        while($row = $statement->fetch(PDO::FETCH_ASSOC))
                        {
                            $result[] = $row;
                        }
        
                        $statement -> closeCursor();
        
                        
                        $response = new ResponseModel(200, true, null, $result);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        $response = new ResponseModel(404, true, null, null);
                        $response->send($output);
                        exit();

                    }

                }
               

              

            }
            if($id == 'n_a' && $name == 'n_a' && $role != 'n_a')
            {

                //by role

                if(is_numeric($role))
                {

                    $response = new ResponseModel(400, true, ". Role cannot be numeric!", null);
                    $response->send($output);
                    exit();

                }
                else
                {

                    $sql = "SELECT * FROM tbl_users WHERE role = :role";

                    $statement = $conn -> prepare($sql);
                    $statement -> bindParam(':role', $role, PDO::PARAM_STR);
                    $statement -> execute();

                    if($statement -> rowCount() != 0)
                    {

                        while($row = $statement -> fetch(PDO::FETCH_ASSOC))
                        {
                            $result[] = $row;
                        }
        
                        $statement -> closeCursor();
        
                        
                        $response = new ResponseModel(200, true, null, $result);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        $response = new ResponseModel(404, true, null, null);
                        $response->send($output);
                        exit();

                    }

                }
               

               

            }
            if($id != 'n_a' && $name != 'n_a' && $role == 'n_a')
            {

                //by id and name

                if(!is_numeric($id) || is_numeric($name))
                {

                    $response = new ResponseModel(400, true, ". ID must be numeric and name cannot be numeric!", null);
                    $response->send($output);
                    exit();

                }
                else
                {

                    $sql = "SELECT * FROM tbl_users WHERE id = :id AND username = :name";

                    $statement = $conn -> prepare($sql);
                    $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                    $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                    $statement -> execute();

                    if($statement -> rowCount() != 0)
                    {

                        while($row = $statement -> fetch(PDO::FETCH_ASSOC))
                        {
                            $result[] = $row;
                        }
        
                        $statement -> closeCursor();
        
                        
                        $response = new ResponseModel(200, true, null, $result);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        $response = new ResponseModel(404, true, null, null);
                        $response->send($output);
                        exit();

                    }

                }
               

               

            }
            if($id != 'n_a' && $name != 'n_a' && $role != 'n_a')
            {

                //by id, name and role

                if(!is_numeric($id) || is_numeric($name) || is_numeric($role))
                {

                    $response = new ResponseModel(400, true, ". ID must be numeric, name and role cannot be numeric!", null);
                    $response->send($output);
                    exit();

                }
                else
                {

                    $sql = "SELECT * FROM tbl_users WHERE id = :id AND username = :name AND role = :role";

                    $statement = $conn -> prepare($sql);
                    $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                    $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                    $statement -> bindParam(':role', $role, PDO::PARAM_STR);
                    $statement -> execute();

                    if($statement -> rowCount() != 0)
                    {

                        while($row = $statement -> fetch(PDO::FETCH_ASSOC))
                        {
                            $result[] = $row;
                        }
        
                        $statement -> closeCursor();
        
                        
                        $response = new ResponseModel(200, true, null, $result);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        $response = new ResponseModel(404, true, null, null);
                        $response->send($output);
                        exit();

                    }

                }
               
            }
            if($id == 'n_a' && $name != 'n_a' && $role != 'n_a')
            {

                //by name and role

                if(is_numeric($name) || is_numeric($role))
                {

                    $response = new ResponseModel(400, true, ". Name and role cannot be numeric!", null);
                    $response->send($output);
                    exit();

                }
                else
                {

                    $sql = "SELECT * FROM tbl_users WHERE username = :name AND role = :role";

                    $statement = $conn -> prepare($sql);
                    $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                    $statement -> bindParam(':role', $role, PDO::PARAM_STR);
                    $statement -> execute();

                    if($statement -> rowCount() != 0)
                    {

                        while($row = $statement -> fetch(PDO::FETCH_ASSOC))
                        {
                            $result[] = $row;
                        }
        
                        $statement -> closeCursor();
        
                        
                        $response = new ResponseModel(200, true, null, $result);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        $response = new ResponseModel(404, true, null, null);
                        $response->send($output);
                        exit();

                    }

                }
               
            }
            if($id != 'n_a' && $name == 'n_a' && $role != 'n_a')
            {

                //by id and role
                
                if(!is_numeric($id) || is_numeric($role))
                {

                    $response = new ResponseModel(400, true, ". ID must be numeric and role cannot be numeric!", null);
                    $response->send($output);
                    exit();

                }
                else
                {

                    $sql = "SELECT * FROM tbl_users WHERE id = :id AND role = :role";

                    $statement = $conn -> prepare($sql);
                    $statement -> bindParam(':id', $id, PDO::PARAM_STR);
                    $statement -> bindParam(':role', $role, PDO::PARAM_STR);
                    $statement -> execute();

                    if($statement -> rowCount() != 0)
                    {

                        while($row = $statement -> fetch(PDO::FETCH_ASSOC))
                        {
                            $result[] = $row;
                        }
        
                        $statement -> closeCursor();
        
                        
                        $response = new ResponseModel(200, true, null, $result);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        $response = new ResponseModel(404, true, null, null);
                        $response->send($output);
                        exit();

                    }

                }
               
            }
            else
            {

                $response = new ResponseModel(400, false, '. Action failed!', null);
                $response -> send($output);
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