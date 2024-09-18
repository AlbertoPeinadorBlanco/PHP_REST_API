<?php

namespace Models;
use PDO;
use PDOException;

//Endpoint for creating game objects
class CreateGameModel extends CreateUserModel
{

    //Function to check if a name of a game already exists in the database
    private function nameCheck($name)
    {     

        $conn = $this -> connect();

        $sql = 'SELECT * FROM tbl_games WHERE name = :name';
                
                                        
        $statement = $conn->prepare($sql);
        $statement -> bindParam(':name', $name, PDO::PARAM_STR);
        $statement -> execute();
        $statement -> closeCursor();

        return $statement -> rowCount();
    
    }

    //Function to input a new game item into the database
    public function createData($data)
    {

        $output_function = new FormatSelectionModel();
        $output_injector = new FormatSelectionModelInjector($output_function);

        $output = $output_injector -> formatChose();

        $game_data = explode('/', $data);
        $name = $game_data[1];
        $author = $game_data[2];
        $genre = $game_data[3];
        $score = $game_data[4];
        $year = $game_data[5];
        $platform = $game_data[6];


        if($name != 'n_a' && $author != 'n_a' && $genre != 'n_a' && $score != 'n_a' && $year != 'n_a' && $platform != 'n_a')
        {
            
            try
            {
                                 
                if($this -> nameCheck($name) != 0)
                {
                    
                    $response = new ResponseModel(409, false, '. Game already exists!');
                    $response -> send($output);
                    exit();

                }
                else
                {

                    if(is_numeric($author))
                    {

                        $response = new ResponseModel(400, true, ". Aurhor cannot be numeric!", null);
                        $response->send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($genre))
                        {

                            $response = new ResponseModel(400, true, ". Genre cannot be numeric!", null);
                            $response->send($output);
                            exit();

                        }
                        else
                        {

                            if(!is_numeric($score))
                            {

                                $response = new ResponseModel(400, true, ". Score must be numeric!", null);
                                $response->send($output);
                                exit();

                            }
                            else
                            {

                                if(!is_numeric($year))
                                {

                                    $response = new ResponseModel(400, true, ". Year must be numeric!", null);
                                    $response->send($output);
                                    exit();

                                }
                                else
                                {

                                    if(is_numeric($platform))
                                    {

                                        $response = new ResponseModel(400, true, ". platform cannot be numeric!", null);
                                        $response->send($output);
                                        exit();

                                    }
                                    else
                                    {

                                        $conn = $this -> connect();

                                        $sql = "INSERT INTO tbl_games (name, author, genre, score, year, platform) VALUES (:name, :author, :genre, :score, :year, :platform)";
                    
                                        $statement = $conn -> prepare($sql);
                                        $statement -> bindValue(':name', $name, PDO::PARAM_STR);
                                        $statement -> bindValue(':author', $author, PDO::PARAM_STR);
                                        $statement -> bindValue(':genre', $genre, PDO::PARAM_STR);
                                        $statement -> bindValue(':score', $score, PDO::PARAM_INT);
                                        $statement -> bindValue(':year', $year, PDO::PARAM_INT);
                                        $statement -> bindValue(':platform', $platform, PDO::PARAM_STR);
                                        $statement -> execute();
                    
                                        $statement -> closeCursor();
                    
                    
                                        $result = array();
                                        $result['name'] = $name;
                                        $result['author'] = $author;
                                        $result['genre'] = $genre;
                                        $result['score'] = $score;
                                        $result['year'] = $year;
                                        $result['platform'] = $platform;
                        
                        
                                        $response = new ResponseModel(201, false, null, $result);
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
                $response->send('json');
                exit();

            }

        }
        else
        {

            $response = new ResponseModel(400, false, '. No fields can be empty. Please input values!', null);
            $response -> send($output);
            exit();

        }

    }
       
}