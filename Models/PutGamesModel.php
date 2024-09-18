<?php


namespace Models;
use PDO;
use PDOException;


//Endpoint for updating (put) game objects
class PutGamesModel extends PutUserModel
{

    //Function to check if a name of a game already exists in the database
    private function nameCheckGames($data)
    {

        try
        {

            $conn = $this -> connect();

            $sql = 'SELECT * FROM tbl_games WHERE name = :name';
                   
                                            
            $query = $conn->prepare($sql);
            $query->bindValue(':name', $data, PDO::PARAM_STR);
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

    //Function to PUT data into the games table
    public function putData($data)
    {

        $game_data = explode('/', $data);
        $id = $game_data[0];
        $name = $game_data[1];
        $author = $game_data[2];
        $genre = $game_data[3];
        $score = $game_data[4];
        $year = $game_data[5];
        $platform = $game_data[6];


        $output_function = new FormatSelectionModel();
        $output_injector = new FormatSelectionModelInjector($output_function);

        $output = $output_injector -> formatChose();

        try
        {

            $conn = $this -> connect();

            if($id != 'n_a' && $name != 'n_a' && $author != 'n_a' && $genre != 'n_a' && $score != 'n_a' && $year != 'n_a' && $platform != 'n_a')
            {

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, true, ". ID must be numeric.", null);
                    $response->send($output);
                    exit();

                }
                else
                {

                    if(is_numeric($genre))
                    {

                        $response = new ResponseModel(400, true, ". Genre cannot be numeric.", null);
                        $response->send($output);
                        exit();

                    }
                    else
                    {
                        if(!is_numeric($score))
                        {

                            $response = new ResponseModel(400, true, ". Score must be numeric.", null);
                            $response->send($output);
                            exit();

                        }
                        else
                        {

                            if(!is_numeric($year))
                            {

                                $response = new ResponseModel(400, true, ". Year must be numeric.", null);
                                $response->send($output);
                                exit();

                            }
                            else
                            {
                                
                                $sql = "SELECT * FROM tbl_games WHERE id = :id";

                                $statement = $conn -> prepare($sql);
                                $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                $statement -> execute();
                                $statement -> closeCursor();
    
            
                                if($statement ->rowCount() == 0)
                                {
                                    if($this -> nameCheck($name) == 0)
                                    {

                                        $sql = "INSERT INTO tbl_games (name, author, genre, score, year, platform) VALUES (:name, :author, :genre, :score, :year, :platform)";

                                        $statement = $conn -> prepare($sql);
                                        $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                                        $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                        $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                        $statement -> bindParam(':score', $score, PDO::PARAM_INT);
                                        $statement -> bindParam(':year', $year, PDO::PARAM_INT);
                                        $statement -> bindParam(':platform', $platform, PDO::PARAM_STR);

                                        $statement -> execute();

                                        
                                        $result = array();
                                        $result['name'] = $name;
                                        $result['author'] = $author;
                                        $result['genre'] = $genre;
                                        $result['score'] = $score;
                                        $result['year'] = $year;
                                        $result['platform'] = $platform;
                                            
                                        $statement -> closeCursor();

                                        
                                        $response = new ResponseModel(201, false, null, $result);
                                        $response->send($output);
                                        exit();

                                    }
                                    else
                                    {
                                        
                                        $sql = "UPDATE  tbl_games SET name = :name, author = :author, genre = :genre, score = :score, year = :year, platform = platform WHERE id = :id";
                                        
                                        $statement = $conn -> prepare($sql);
                                        $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                        $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                                        $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                        $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                        $statement -> bindParam(':score', $score, PDO::PARAM_INT);
                                        $statement -> bindParam(':year', $year, PDO::PARAM_INT);
                                        $statement -> bindParam(':platform', $platform, PDO::PARAM_STR);
    
                                        $statement -> execute();
    
                                        
                                        $result = array();
                                        $result['name'] = $name;
                                        $result['author'] = $author;
                                        $result['genre'] = $genre;
                                        $result['score'] = $score;
                                        $result['year'] = $year;
                                        $result['platform'] = $platform;
                                            
                                        $statement -> closeCursor();
    
                                        
                                        $response = new ResponseModel(201, false, null, $result);
                                        $response->send($output);
                                        exit();

                                    }

                                }
                                else
                                {
                                    
                                    if($this -> nameCheckGames($name) == 0)
                                    {
                                      
                                        $sql = "UPDATE  tbl_games SET name = :name, author = :author, genre = :genre, score = :score, year = :year, platform = :platform WHERE id = :id";
                                        
                                        $statement = $conn -> prepare($sql);
                                        $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                        $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                                        $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                        $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                        $statement -> bindParam(':score', $score, PDO::PARAM_INT);
                                        $statement -> bindParam(':year', $year, PDO::PARAM_INT);
                                        $statement -> bindParam(':platform', $platform, PDO::PARAM_STR);
    
                                        $statement -> execute();
    
                                        
                                        $result = array();
                                        $result['name'] = $name;
                                        $result['author'] = $author;
                                        $result['genre'] = $genre;
                                        $result['score'] = $score;
                                        $result['year'] = $year;
                                        $result['platform'] = $platform;
                                            
                                        $statement -> closeCursor();
    
                                        
                                        $response = new ResponseModel(201, false, null, $result);
                                        $response->send($output);
                                        exit();

                                    }
                                    else
                                    {

                                        $response = new ResponseModel(409, true, ". Game already exists.", null);
                                        $response->send($output);
                                        exit();

                                    }
                                   
                                }

                            }

                        }

                    }

                }

            }
            else
            {

                $response = new ResponseModel(400, false, '. Please input all the values (ID, name, author, genre, score, year, platform).', null);
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