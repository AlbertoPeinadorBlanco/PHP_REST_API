<?php

namespace Models;
use PDO;
use PDOException;

//Endpoint for deleting user objects
class DeleteUserModel extends DBModel implements IDeleteModel
{

    //Function for deleting user objects
    public function deleteData($data)
    {

        $game_data = explode('/', $data);
        $id = $game_data[0];

        
        $output_function = new FormatSelectionModel();
        $output_injector = new FormatSelectionModelInjector($output_function);

        $output = $output_injector -> formatChose();


        try
        {

            $conn = $this ->connect();


            if($id != 'n_a')
            {

                if(is_numeric($id))
                {

                    $sql = 'SELECT * FROM tbl_users WHERE id = :id';
               
                                
                    $statement = $conn->prepare($sql);
                    $statement -> bindValue(':id', $id, PDO::PARAM_INT);
                    $statement -> execute();
        
                    if($statement->rowCount() == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {
                        
                        $sql2 = "DELETE FROM tbl_users WHERE id = :id";

                        $statement = $conn -> prepare($sql2);
                        $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                        $statement -> execute();
    
                        $statement -> closeCursor();
                        
                        $data = 'You have deleted the user wit ID = '.$id;
                        
                        $response = new ResponseModel(200, false, null, $data);
                        $response->send($output);
                        
                        exit();

                    }
                   

                }
                else
                {
                    
                    $response = new ResponseModel(400, false, '. ID must be numerical!', null);
                    $response->send($output);
                    exit();

                }

            }
            else
            {
                $response = new ResponseModel(400, false, '. ID cannot be empty!', null);
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