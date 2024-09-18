<?php

namespace Models;
use PDO;
use PDOException;


//Endpoint for deleting game objects
class DeleteGamesModel extends DeleteUserModel
{

    //Function for deleting game objects
    public function deleteData($data)
    {

        $game_data = explode('/', $data);
        $id = $game_data[0];

        $output_function = new FormatSelectionModel();
        $output_injector = new FormatSelectionModelInjector($output_function);

        $output = $output_injector -> formatChose();

        try
        {

            $conn = $this -> connect();


            if($id != 'n_a')
            {
    
                if(!is_numeric($id))
                {
        
                    $response = new ResponseModel(400, false, '. ID must be numerical!', null);
                    $response->send($output);
                    exit();
        
                }
                else
                {
        
                    $sql = 'SELECT * FROM tbl_games WHERE id = :id';
                   
                                    
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
                        
                        $sql = "DELETE FROM tbl_games WHERE id = :id";

                        $statement = $conn -> prepare($sql);
                        $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                        $statement -> execute();
    
                        $statement -> closeCursor();
    
                        $data = "You have deleted a game with ID = ".$id;
                        $response = new ResponseModel(200, false, null, $data);
                        $response->send($output);
                        
                        exit();

                    }
                   
        
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