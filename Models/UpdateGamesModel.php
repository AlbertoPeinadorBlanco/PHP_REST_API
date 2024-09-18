<?php

namespace Models;
use PDO;
use PDOException;

//Endpoint for updating games (patch)
class UpdateGamesModel extends UpdateUserModel
{


    //Function to check for an item id
    private function idCheck($id)
    {

        try
        {
            
            $conn = $this -> connect();

            $sql = 'SELECT * FROM tbl_games WHERE id = :id';
                   
                                    
            $query = $conn->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
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

    //Function to check if name already exists
    private function nameCheck($name)
    {

        try
        {

            $conn = $this -> connect();

            $sql = 'SELECT * FROM tbl_games WHERE name = :name';
                   
                                            
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


    //Function for updating games (patch)
    public function updateData($data)
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


            if($id != 'n_a' && $name != 'n_a' && $author == 'n_a' && $genre == 'n_a' && $score == 'n_a' && $year == 'n_a' && $platform == 'n_a')
            {
    
                //name and ID

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($name))
                        {
    
                            $response = new ResponseModel(400, false, '. Name cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                                            
                            if($this -> nameCheck($name) != 0)
                            {
                                
                                $response = new ResponseModel(409, false, '. Game already exists!');
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                $sql = "UPDATE tbl_games SET name = :name WHERE id = :id";
    
                                $statement = $conn -> prepare($sql);
                                $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                                $statement -> execute();

                                $statement -> closeCursor();
                
                                $response = new ResponseModel(200, false, null, null);
                                $response -> send($output);
                                exit(); 

                            }
    
                        }

                    }

                }
    
            }
            if($id != 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre == 'n_a' && $score == 'n_a' && $year == 'n_a' && $platform == 'n_a')
            {

                //id and author

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(!is_numeric($author))
                        {

                            $sql = "UPDATE tbl_games SET author = :author WHERE id = :id";
    
                            $statement = $conn -> prepare($sql);
                            $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                            $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                            $statement -> execute();


                            $statement -> closeCursor();
                
                            $response = new ResponseModel(200, false, null, null);
                            $response -> send($output);
                            exit(); 

                        }
                        else
                        {
                            $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                            $response -> send($output);
                            exit();
                        }

                    }

                }
    
            }
            if($id != 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre != 'n_a' && $score == 'n_a' && $year == 'n_a' && $platform == 'n_a')
            {

                //id and genre

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(!is_numeric($genre))
                        {

                            $sql = "UPDATE tbl_games SET genre = :genre WHERE id = :id";
    
                            $statement = $conn -> prepare($sql);
                            $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                            $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                            $statement -> execute();


                            $statement -> closeCursor();
                
                            $response = new ResponseModel(200, false, null, null);
                            $response -> send($output);
                            exit(); 

                        }
                        else
                        {
                            $response = new ResponseModel(400, false, '. Genre cannot be numeric!', null);
                            $response -> send($output);
                            exit();
                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre == 'n_a' && $score != 'n_a' && $year == 'n_a' && $platform == 'n_a')
            {

                //id and score

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($score))
                        {

                            $sql = "UPDATE tbl_games SET score = :score WHERE id = :id";
    
                            $statement = $conn -> prepare($sql);
                            $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                            $statement -> bindParam(':score', $score, PDO::PARAM_INT);
                            $statement -> execute();


                            $statement -> closeCursor();
                
                            $response = new ResponseModel(200, false, null, null);
                            $response -> send($output);
                            exit(); 

                        }
                        else
                        {
                            $response = new ResponseModel(400, false, '. Score must be numeric!', null);
                            $response -> send($output);
                            exit();
                        }

                    }

                }


            }
            if($id != 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre == 'n_a' && $score == 'n_a' && $year != 'n_a' && $platform == 'n_a')
            {

                //id and year

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($year))
                        {

                            $sql = "UPDATE tbl_games SET year = :year WHERE id = :id";
    
                            $statement = $conn -> prepare($sql);
                            $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                            $statement -> bindParam(':year', $year, PDO::PARAM_INT);
                            $statement -> execute();

                            $statement -> closeCursor();
                
                            $response = new ResponseModel(200, false, null, null);
                            $response -> send($output);
                            exit(); 

                        }
                        else
                        {
                            $response = new ResponseModel(400, false, '. Year must be numeric!', null);
                            $response -> send($output);
                            exit();
                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre == 'n_a' && $score == 'n_a' && $year == 'n_a' && $platform != 'n_a')
            {

                //id and platform

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(!is_numeric($platform))
                        {

                            $sql = "UPDATE tbl_games SET platform = :platform WHERE id = :id";
    
                            $statement = $conn -> prepare($sql);
                            $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                            $statement -> bindParam(':platform', $platform, PDO::PARAM_STR);
                            $statement -> execute();

                            $statement -> closeCursor();
                
                            $response = new ResponseModel(200, false, null, null);
                            $response -> send($output);
                            exit(); 

                        }
                        else
                        {
                            $response = new ResponseModel(400, false, '. Platform cannot be numeric!', null);
                            $response -> send($output);
                            exit();
                        }

                    }

                }

            }
            if($id != 'n_a' && $name != 'n_a' && $author != 'n_a' && $genre == 'n_a' && $score == 'n_a' && $year == 'n_a' && $platform == 'n_a')
            {

                //id, name and author

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($name))
                        {
    
                            $response = new ResponseModel(400, false, '. Name cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                                            
                            if($this -> nameCheck($name) != 0)
                            {
                                
                                $response = new ResponseModel(409, false, '. Name already exists!');
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(!is_numeric($author))
                                {

                                    $sql = "UPDATE tbl_games SET name = :name, author = :author WHERE id = :id";

                                    $statement = $conn -> prepare($sql);
                                    $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                    $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                                    $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                    $statement -> execute();

                                    $statement -> closeCursor();
                    
                                    $response = new ResponseModel(200, false, null, null);
                                    $response -> send($output);
                                    exit(); 

                                }
                                else
                                {

                                    $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }

                            }
    
                        }

                    }

                }

            }
            if($id != 'n_a' && $name != 'n_a' && $author == 'n_a' && $genre != 'n_a' && $score == 'n_a' && $year == 'n_a' && $platform == 'n_a')
            {

                //id, name and genre

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($name))
                        {
    
                            $response = new ResponseModel(400, false, '. Name cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                                            
                            if($this -> nameCheck($name) != 0)
                            {
                                
                                $response = new ResponseModel(409, false, '. User already exists!');
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(!is_numeric($genre))
                                {

                                    $sql = "UPDATE tbl_games SET name = :name, genre = :genre WHERE id = :id";

                                    $statement = $conn -> prepare($sql);
                                    $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                    $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                                    $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                    $statement -> execute();

                                    $statement -> closeCursor();
                    
                                    $response = new ResponseModel(200, false, null, null);
                                    $response -> send($output);
                                    exit(); 

                                }
                                else
                                {

                                    $response = new ResponseModel(400, false, '. Genre cannot be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }

                            }
    
                        }

                    }

                }

            }
            if($id != 'n_a' && $name != 'n_a' && $author == 'n_a' && $genre == 'n_a' && $score != 'n_a' && $year == 'n_a' && $platform == 'n_a')
            {

                //id, name and score

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($name))
                        {
    
                            $response = new ResponseModel(400, false, '. Name cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                                            
                            if($this -> nameCheck($name) != 0)
                            {
                                
                                $response = new ResponseModel(409, false, '. Name already exists!');
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(is_numeric($score))
                                {

                                    $sql = "UPDATE tbl_games SET name = :name, score = :score WHERE id = :id";

                                    $statement = $conn -> prepare($sql);
                                    $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                    $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                                    $statement -> bindParam(':score', $score, PDO::PARAM_INT);
                                    $statement -> execute();


                                    $statement -> closeCursor();
                    
                                    $response = new ResponseModel(200, false, null, null);
                                    $response -> send($output);
                                    exit(); 

                                }
                                else
                                {

                                    $response = new ResponseModel(400, false, '. Score must be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }

                            }
    
                        }

                    }

                }

            }
            if($id != 'n_a' && $name != 'n_a' && $author == 'n_a' && $genre == 'n_a' && $score == 'n_a' && $year != 'n_a' && $platform == 'n_a')
            {

                //id, name and year

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($name))
                        {
    
                            $response = new ResponseModel(400, false, '. Name cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                                            
                            if($this -> nameCheck($name) != 0)
                            {
                                
                                $response = new ResponseModel(409, false, '. Name already exists!');
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(is_numeric($year))
                                {

                                    $sql = "UPDATE tbl_games SET name = :name, year = :year WHERE id = :id";

                                    $statement = $conn -> prepare($sql);
                                    $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                    $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                                    $statement -> bindParam(':year', $year, PDO::PARAM_INT);
                                    $statement -> execute();


                                    $statement -> closeCursor();
                    
                                    $response = new ResponseModel(200, false, null, null);
                                    $response -> send($output);
                                    exit(); 

                                }
                                else
                                {

                                    $response = new ResponseModel(400, false, '. Year must be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }

                            }
    
                        }

                    }

                }

            }
            if($id != 'n_a' && $name != 'n_a' && $author == 'n_a' && $genre == 'n_a' && $score == 'n_a' && $year == 'n_a' && $platform != 'n_a')
            {

                //id, name and platform

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($name))
                        {
    
                            $response = new ResponseModel(400, false, '. Name cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                                            
                            if($this -> nameCheck($name) != 0)
                            {
                                
                                $response = new ResponseModel(409, false, '. Name already exists!');
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(!is_numeric($platform))
                                {

                                    $sql = "UPDATE tbl_games SET name = :name, platform = :platform WHERE id = :id";

                                    $statement = $conn -> prepare($sql);
                                    $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                    $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                                    $statement -> bindParam(':platform', $platform, PDO::PARAM_STR);
                                    $statement -> execute();


                                    $statement -> closeCursor();
                    
                                    $response = new ResponseModel(200, false, null, null);
                                    $response -> send($output);
                                    exit(); 

                                }
                                else
                                {

                                    $response = new ResponseModel(400, false, '. Platform cannot be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }

                            }
    
                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre != 'n_a' && $score == 'n_a' && $year == 'n_a' && $platform == 'n_a')
            {

                //id, author and genre

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($author))
                        {
    
                            $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                                            

                            if(!is_numeric($genre))
                            {

                                $sql = "UPDATE tbl_games SET author = :author, genre = :genre WHERE id = :id";

                                $statement = $conn -> prepare($sql);
                                $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                $statement -> bindParam(':author', $author, PDO::PARAM_STR);                             

                                $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                $statement -> execute();

                                $statement -> closeCursor();
                
                                $response = new ResponseModel(200, false, null, null);
                                $response -> send($output);
                                exit(); 

                            }
                            else
                            {

                                $response = new ResponseModel(400, false, '. Genre cannot be numeric!', null);
                                $response -> send($output);
                                exit();

                            }
   
                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre == 'n_a' && $score != 'n_a' && $year == 'n_a' && $platform == 'n_a')
            {

                //id, author and score

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($author))
                        {
    
                            $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                                            

                            if(is_numeric($score))
                            {

                                $sql = "UPDATE tbl_games SET author = :author, score = :score WHERE id = :id";

                                $statement = $conn -> prepare($sql);
                                $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                $statement -> bindParam(':score', $score, PDO::PARAM_INT);
                                $statement -> execute();


                                $statement -> closeCursor();
                
                                $response = new ResponseModel(200, false, null, null);
                                $response -> send($output);
                                exit(); 

                            }
                            else
                            {

                                $response = new ResponseModel(400, false, '. Score must be numeric!', null);
                                $response -> send($output);
                                exit();

                            }
   
                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre == 'n_a' && $score == 'n_a' && $year != 'n_a' && $platform == 'n_a')
            {

                //id, author and year

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($author))
                        {
    
                            $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                                            

                            if(is_numeric($year))
                            {

                                $sql = "UPDATE tbl_games SET author = :author, year = :year WHERE id = :id";

                                $statement = $conn -> prepare($sql);
                                $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                $statement -> bindParam(':year', $year, PDO::PARAM_INT);
                                $statement -> execute();


                                $statement -> closeCursor();
                
                                $response = new ResponseModel(200, false, null, null);
                                $response -> send($output);
                                exit(); 

                            }
                            else
                            {

                                $response = new ResponseModel(400, false, '. Year must be numeric!', null);
                                $response -> send($output);
                                exit();

                            }
   
                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre == 'n_a' && $score == 'n_a' && $year == 'n_a' && $platform != 'n_a')
            {

                //id, author and platform

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($author))
                        {
    
                            $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                                            

                            if(!is_numeric($platform))
                            {

                                $sql = "UPDATE tbl_games SET author = :author, platform = :platform WHERE id = :id";

                                $statement = $conn -> prepare($sql);
                                $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                $statement -> bindParam(':platform', $platform, PDO::PARAM_STR);
                                $statement -> execute();


                                $statement -> closeCursor();
                
                                $response = new ResponseModel(200, false, null, null);
                                $response -> send($output);
                                exit(); 

                            }
                            else
                            {

                                $response = new ResponseModel(400, false, '. Platform cannot be numeric!', null);
                                $response -> send($output);
                                exit();

                            }
   
                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre != 'n_a' && $score != 'n_a' && $year == 'n_a' && $platform == 'n_a')
            {

                //id, genre and score

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($genre))
                        {
    
                            $response = new ResponseModel(400, false, '. Genre cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                                            

                            if(is_numeric($score))
                            {

                                $sql = "UPDATE tbl_games SET genre = :genre, score = :score WHERE id = :id";

                                $statement = $conn -> prepare($sql);
                                $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                $statement -> bindParam(':score', $score, PDO::PARAM_INT);
                                $statement -> execute();


                                $statement -> closeCursor();
                
                                $response = new ResponseModel(200, false, null, null);
                                $response -> send($output);
                                exit(); 

                            }
                            else
                            {

                                $response = new ResponseModel(400, false, '. Score must be numeric!', null);
                                $response -> send($output);
                                exit();

                            }
   
                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre != 'n_a' && $score == 'n_a' && $year != 'n_a' && $platform == 'n_a')
            {

                //id, genre and year

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($genre))
                        {
    
                            $response = new ResponseModel(400, false, '. Genre cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                                            

                            if(is_numeric($year))
                            {

                                $sql = "UPDATE tbl_games SET genre = :genre, year = :year WHERE id = :id";

                                $statement = $conn -> prepare($sql);
                                $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                $statement -> bindParam(':year', $year, PDO::PARAM_INT);
                                $statement -> execute();


                                $statement -> closeCursor();
                
                                $response = new ResponseModel(200, false, null, null);
                                $response -> send($output);
                                exit(); 

                            }
                            else
                            {

                                $response = new ResponseModel(400, false, '. Year must be numeric!', null);
                                $response -> send($output);
                                exit();

                            }
   
                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre != 'n_a' && $score == 'n_a' && $year == 'n_a' && $platform != 'n_a')
            {

                //id, genre and platform

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($genre))
                        {
    
                            $response = new ResponseModel(400, false, '. Genre cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                                            

                            if(!is_numeric($platform))
                            {

                                $sql = "UPDATE tbl_games SET genre = :genre, platform = :platform WHERE id = :id";

                                $statement = $conn -> prepare($sql);
                                $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                $statement -> bindParam(':platform', $platform, PDO::PARAM_STR);
                                $statement -> execute();


                                $statement -> closeCursor();
                
                                $response = new ResponseModel(200, false, null, null);
                                $response -> send($output);
                                exit(); 

                            }
                            else
                            {

                                $response = new ResponseModel(400, false, '. Platform cannot be numeric!', null);
                                $response -> send($output);
                                exit();

                            }
   
                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre == 'n_a' && $score != 'n_a' && $year != 'n_a' && $platform == 'n_a')
            {

                //id, score and year

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(!is_numeric($score))
                        {
    
                            $response = new ResponseModel(400, false, '. Score must be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                                            

                            if(is_numeric($year))
                            {

                                $sql = "UPDATE tbl_games SET score = :score, year = :year WHERE id = :id";

                                $statement = $conn -> prepare($sql);
                                $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                $statement -> bindParam(':score', $score, PDO::PARAM_INT);
                                $statement -> bindParam(':year', $year, PDO::PARAM_INT);
                                $statement -> execute();


                                $statement -> closeCursor();
                
                                $response = new ResponseModel(200, false, null, null);
                                $response -> send($output);
                                exit(); 

                            }
                            else
                            {

                                $response = new ResponseModel(400, false, '. Year must be numeric!', null);
                                $response -> send($output);
                                exit();

                            }
   
                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre == 'n_a' && $score != 'n_a' && $year == 'n_a' && $platform != 'n_a')
            {

                //id, score and platform

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(!is_numeric($score))
                        {
    
                            $response = new ResponseModel(400, false, '. Score must be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                                            

                            if(!is_numeric($platform))
                            {

                                $sql = "UPDATE tbl_games SET score = :score, platform = :platform WHERE id = :id";

                                $statement = $conn -> prepare($sql);
                                $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                $statement -> bindParam(':score', $score, PDO::PARAM_INT);
                                $statement -> bindParam(':platform', $platform, PDO::PARAM_STR);
                                $statement -> execute();


                                $statement -> closeCursor();
                
                                $response = new ResponseModel(200, false, null, null);
                                $response -> send($output);
                                exit(); 

                            }
                            else
                            {

                                $response = new ResponseModel(400, false, '. Platform cannot be numeric!', null);
                                $response -> send($output);
                                exit();

                            }
   
                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre == 'n_a' && $score == 'n_a' && $year != 'n_a' && $platform != 'n_a')
            {

                //id, year and platform

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(!is_numeric($year))
                        {
    
                            $response = new ResponseModel(400, false, '. Year must be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                                            

                            if(!is_numeric($platform))
                            {

                                $sql = "UPDATE tbl_games SET year = :year, platform = :platform WHERE id = :id";

                                $statement = $conn -> prepare($sql);
                                $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                $statement -> bindParam(':year', $year, PDO::PARAM_INT);
                                $statement -> bindParam(':platform', $platform, PDO::PARAM_STR);
                                $statement -> execute();


                                $statement -> closeCursor();
                
                                $response = new ResponseModel(200, false, null, null);
                                $response -> send($output);
                                exit(); 

                            }
                            else
                            {

                                $response = new ResponseModel(400, false, '. Platform cannot be numeric!', null);
                                $response -> send($output);
                                exit();

                            }
   
                        }

                    }

                }

            }
            if($id != 'n_a' && $name != 'n_a' && $author != 'n_a' && $genre != 'n_a' && $score == 'n_a' && $year == 'n_a' && $platform == 'n_a')
            {

                //id, name, author and genre

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($name))
                        {
    
                            $response = new ResponseModel(400, false, '. Name cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                                            
                            if($this -> nameCheck($name) != 0)
                            {
                                
                                $response = new ResponseModel(409, false, '. Name already exists!');
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(!is_numeric($author))
                                {

                                    if(!is_numeric($genre))
                                    {

                                        $sql = "UPDATE tbl_games SET name = :name, author = :author, genre = :genre WHERE id = :id";

                                        $statement = $conn -> prepare($sql);
                                        $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                        $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                                        $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                        $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                        $statement -> execute();
    
    
                                        $statement -> closeCursor();
                        
                                        $response = new ResponseModel(200, false, null, null);
                                        $response -> send($output);
                                        exit(); 

                                    }
                                    else
                                    {

                                        $response = new ResponseModel(400, false, '. Genre cannot be numeric!', null);
                                        $response -> send($output);
                                        exit();

                                    }

                                }
                                else
                                {

                                    $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }

                            }
    
                        }

                    }

                }

            }
            if($id != 'n_a' && $name != 'n_a' && $author != 'n_a' && $genre == 'n_a' && $score != 'n_a' && $year == 'n_a' && $platform == 'n_a')
            {

                //id, name, author and score

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($name))
                        {
    
                            $response = new ResponseModel(400, false, '. Name cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                                            
                            if($this -> nameCheck($name) != 0)
                            {
                                
                                $response = new ResponseModel(409, false, '. Name already exists!');
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(!is_numeric($author))
                                {

                                    if(is_numeric($score))
                                    {

                                        $sql = "UPDATE tbl_games SET name = :name, author = :author, score = :score WHERE id = :id";

                                        $statement = $conn -> prepare($sql);
                                        $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                        $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                                        $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                        $statement -> bindParam(':score', $score, PDO::PARAM_INT);
                                        $statement -> execute();
    
    
                                        $statement -> closeCursor();
                        
                                        $response = new ResponseModel(200, false, null, null);
                                        $response -> send($output);
                                        exit(); 

                                    }
                                    else
                                    {

                                        $response = new ResponseModel(400, false, '. Score must be numeric!', null);
                                        $response -> send($output);
                                        exit();

                                    }

                                }
                                else
                                {

                                    $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }

                            }
    
                        }

                    }

                }

            }
            if($id != 'n_a' && $name != 'n_a' && $author != 'n_a' && $genre == 'n_a' && $score == 'n_a' && $year != 'n_a' && $platform == 'n_a')
            {

                //id, name, author and year

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($name))
                        {
    
                            $response = new ResponseModel(400, false, '. Name cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                                            
                            if($this -> nameCheck($name) != 0)
                            {
                                
                                $response = new ResponseModel(409, false, '. Name already exists!');
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(!is_numeric($author))
                                {

                                    if(is_numeric($year))
                                    {

                                        $sql = "UPDATE tbl_games SET name = :name, author = :author, year = :year WHERE id = :id";

                                        $statement = $conn -> prepare($sql);
                                        $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                        $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                                        $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                        $statement -> bindParam(':year', $year, PDO::PARAM_INT);
                                        $statement -> execute();
    
    
                                        $statement -> closeCursor();
                        
                                        $response = new ResponseModel(200, false, null, null);
                                        $response -> send($output);
                                        exit(); 

                                    }
                                    else
                                    {

                                        $response = new ResponseModel(400, false, '. Year must be numeric!', null);
                                        $response -> send($output);
                                        exit();

                                    }

                                }
                                else
                                {

                                    $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }

                            }
    
                        }

                    }

                }

            }
            if($id != 'n_a' && $name != 'n_a' && $author != 'n_a' && $genre == 'n_a' && $score == 'n_a' && $year == 'n_a' && $platform != 'n_a')
            {

                //id, name, author and platform

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($name))
                        {
    
                            $response = new ResponseModel(400, false, '. Name cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                                            
                            if($this -> nameCheck($name) != 0)
                            {
                                
                                $response = new ResponseModel(409, false, '. Name already exists!');
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(!is_numeric($author))
                                {

                                    if(!is_numeric($platform))
                                    {

                                        $sql = "UPDATE tbl_games SET name = :name, author = :author, platform = :platform WHERE id = :id";

                                        $statement = $conn -> prepare($sql);
                                        $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                        $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                                        $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                        $statement -> bindParam(':platform', $platform, PDO::PARAM_STR);
                                        $statement -> execute();
    
    
                                        $statement -> closeCursor();
                        
                                        $response = new ResponseModel(200, false, null, null);
                                        $response -> send($output);
                                        exit(); 

                                    }
                                    else
                                    {

                                        $response = new ResponseModel(400, false, '. Platform cannot be numeric!', null);
                                        $response -> send($output);
                                        exit();

                                    }

                                }
                                else
                                {

                                    $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }

                            }
    
                        }

                    }

                }

            }
            if($id != 'n_a' && $name != 'n_a' && $author == 'n_a' && $genre == 'n_a' && $score != 'n_a' && $year == 'n_a' && $platform != 'n_a')
            {

                //id, name, score and platform

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($name))
                        {
    
                            $response = new ResponseModel(400, false, '. Name cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                                            
                            if($this -> nameCheck($name) != 0)
                            {
                                
                                $response = new ResponseModel(409, false, '. Name already exists!');
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(is_numeric($score))
                                {

                                    if(!is_numeric($platform))
                                    {

                                        $sql = "UPDATE tbl_games SET name = :name, score = :score, platform = :platform WHERE id = :id";

                                        $statement = $conn -> prepare($sql);
                                        $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                        $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                                        $statement -> bindParam(':score', $score, PDO::PARAM_STR);
                                        $statement -> bindParam(':platform', $platform, PDO::PARAM_STR);
                                        $statement -> execute();
    
    
                                        $statement -> closeCursor();
                        
                                        $response = new ResponseModel(200, false, null, null);
                                        $response -> send($output);
                                        exit(); 

                                    }
                                    else
                                    {

                                        $response = new ResponseModel(400, false, '. Platform cannot be numeric!', null);
                                        $response -> send($output);
                                        exit();

                                    }

                                }
                                else
                                {

                                    $response = new ResponseModel(400, false, '. Score must be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }

                            }
    
                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre != 'n_a' && $score != 'n_a' && $year == 'n_a' && $platform == 'n_a')
            {

                //id, author, genre and score

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($author))
                        {
    
                            $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                        
                            if(!is_numeric($genre))
                            {

                                if(is_numeric($score))
                                {

                                    $sql = "UPDATE tbl_games SET author = :author, genre = :genre, score = :score WHERE id = :id";

                                    $statement = $conn -> prepare($sql);
                                    $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                    $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                    $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                    $statement ->bindParam(':score', $score, PDO::PARAM_INT);
                                    $statement -> execute();


                                    $statement -> closeCursor();
                    
                                    $response = new ResponseModel(200, false, null, null);
                                    $response -> send($output);
                                    exit(); 

                                }
                                else
                                {

                                    $response = new ResponseModel(400, false, '. Score must be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }

                            }
                            else
                            {

                                $response = new ResponseModel(400, false, '. Genre cannot be numeric!', null);
                                $response -> send($output);
                                exit();

                            }

                            
    
                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre != 'n_a' && $score == 'n_a' && $year != 'n_a' && $platform == 'n_a')
            {

                //id, author, genre and year

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($author))
                        {
    
                            $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                        
                            if(!is_numeric($genre))
                            {

                                if(is_numeric($year))
                                {

                                    $sql = "UPDATE tbl_games SET author = :author, genre = :genre, year = :year WHERE id = :id";

                                    $statement = $conn -> prepare($sql);
                                    $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                    $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                    $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                    $statement ->bindParam(':year', $year, PDO::PARAM_INT);
                                    $statement -> execute();


                                    $statement -> closeCursor();
                    
                                    $response = new ResponseModel(200, false, null, null);
                                    $response -> send($output);
                                    exit(); 

                                }
                                else
                                {

                                    $response = new ResponseModel(400, false, '. Year must be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }

                            }
                            else
                            {

                                $response = new ResponseModel(400, false, '. Genre cannot be numeric!', null);
                                $response -> send($output);
                                exit();

                            }

                            
    
                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre != 'n_a' && $score == 'n_a' && $year == 'n_a' && $platform != 'n_a')
            {

                //id, author, genre and platform

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($author))
                        {
    
                            $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                        
                            if(!is_numeric($genre))
                            {

                                if(!is_numeric($platform))
                                {

                                    $sql = "UPDATE tbl_games SET author = :author, genre = :genre, platform = :platform WHERE id = :id";

                                    $statement = $conn -> prepare($sql);
                                    $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                    $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                    $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                    $statement ->bindParam(':platform', $platform, PDO::PARAM_STR);
                                    $statement -> execute();


                                    $statement -> closeCursor();
                    
                                    $response = new ResponseModel(200, false, null, null);
                                    $response -> send($output);
                                    exit(); 

                                }
                                else
                                {

                                    $response = new ResponseModel(400, false, '. Platform cannot be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }

                            }
                            else
                            {

                                $response = new ResponseModel(400, false, '. Genre cannot be numeric!', null);
                                $response -> send($output);
                                exit();

                            }

                            
    
                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre == 'n_a' && $score != 'n_a' && $year == 'n_a' && $platform != 'n_a')
            {

                //id, author, score and platform

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($author))
                        {
    
                            $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                        
                            if(is_numeric($score))
                            {

                                if(!is_numeric($platform))
                                {

                                    $sql = "UPDATE tbl_games SET author = :author, score = :score, platform = :platform WHERE id = :id";

                                    $statement = $conn -> prepare($sql);
                                    $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                    $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                    $statement -> bindParam(':score', $score, PDO::PARAM_INT);
                                    $statement ->bindParam(':platform', $platform, PDO::PARAM_STR);
                                    $statement -> execute();


                                    $statement -> closeCursor();
                    
                                    $response = new ResponseModel(200, false, null, null);
                                    $response -> send($output);
                                    exit(); 

                                }
                                else
                                {

                                    $response = new ResponseModel(400, false, '. Platform cannot be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }

                            }
                            else
                            {

                                $response = new ResponseModel(400, false, '. Score must be numeric!', null);
                                $response -> send($output);
                                exit();

                            }

                            
    
                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre == 'n_a' && $score == 'n_a' && $year != 'n_a' && $platform != 'n_a')
            {

                //id, author, year and platform

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($author))
                        {
    
                            $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                        
                            if(is_numeric($year))
                            {

                                if(!is_numeric($platform))
                                {

                                    $sql = "UPDATE tbl_games SET author = :author, year = :year, platform = :platform WHERE id = :id";

                                    $statement = $conn -> prepare($sql);
                                    $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                    $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                    $statement -> bindParam(':year', $year, PDO::PARAM_INT);
                                    $statement ->bindParam(':platform', $platform, PDO::PARAM_STR);
                                    $statement -> execute();


                                    $statement -> closeCursor();
                    
                                    $response = new ResponseModel(200, false, null, null);
                                    $response -> send($output);
                                    exit(); 

                                }
                                else
                                {

                                    $response = new ResponseModel(400, false, '. Platform cannot be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }

                            }
                            else
                            {

                                $response = new ResponseModel(400, false, '. Year must be numeric!', null);
                                $response -> send($output);
                                exit();

                            }

                            
    
                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre != 'n_a' && $score == 'n_a' && $year != 'n_a' && $platform != 'n_a')
            {

                //id, genre, year and platform

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($genre))
                        {
    
                            $response = new ResponseModel(400, false, '. Genre cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                        
                            if(is_numeric($year))
                            {

                                if(!is_numeric($platform))
                                {

                                    $sql = "UPDATE tbl_games SET genre = :genre, year = :year, platform = :platform WHERE id = :id";

                                    $statement = $conn -> prepare($sql);
                                    $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                    $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                    $statement -> bindParam(':year', $year, PDO::PARAM_INT);
                                    $statement ->bindParam(':platform', $platform, PDO::PARAM_STR);
                                    $statement -> execute();


                                    $statement -> closeCursor();
                    
                                    $response = new ResponseModel(200, false, null, null);
                                    $response -> send($output);
                                    exit(); 

                                }
                                else
                                {

                                    $response = new ResponseModel(400, false, '. Platform cannot be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }

                            }
                            else
                            {

                                $response = new ResponseModel(400, false, '. Year must be numeric!', null);
                                $response -> send($output);
                                exit();

                            }

                            
    
                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre != 'n_a' && $score != 'n_a' && $year != 'n_a' && $platform == 'n_a')
            {

                //id, genre, score and year

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($genre))
                        {
    
                            $response = new ResponseModel(400, false, '. Genre cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                        
                            if(!is_numeric($score))
                            {

                                $response = new ResponseModel(400, false, '. Score must be numeric!', null);
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(is_numeric($year))
                                {

                                    $sql = "UPDATE tbl_games SET genre = :genre, score = :score, year = :year WHERE id = :id";

                                    $statement = $conn -> prepare($sql);
                                    $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                    $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                    $statement -> bindParam(':score', $score, PDO::PARAM_INT);
                                    $statement -> bindParam(':year', $year, PDO::PARAM_INT);
                                    $statement -> execute();


                                    $statement -> closeCursor();
                    
                                    $response = new ResponseModel(200, false, null, null);
                                    $response -> send($output);
                                    exit(); 

                                }
                                else
                                {

                                    $response = new ResponseModel(400, false, '. Year must be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }                               

                            }

                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre != 'n_a' && $score != 'n_a' && $year == 'n_a' && $platform != 'n_a')
            {

                //id, genre, score and platform

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($genre))
                        {
    
                            $response = new ResponseModel(400, false, '. Genre cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                        
                            if(!is_numeric($score))
                            {

                                $response = new ResponseModel(400, false, '. Score must be numeric!', null);
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(!is_numeric($platform))
                                {

                                    $sql = "UPDATE tbl_games SET genre = :genre, score = :score, platform = :platform WHERE id = :id";

                                    $statement = $conn -> prepare($sql);
                                    $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                    $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                    $statement -> bindParam(':score', $score, PDO::PARAM_INT);
                                    $statement -> bindParam(':platform', $platform, PDO::PARAM_STR);
                                    $statement -> execute();


                                    $statement -> closeCursor();
                    
                                    $response = new ResponseModel(200, false, null, null);
                                    $response -> send($output);
                                    exit(); 

                                }
                                else
                                {

                                    $response = new ResponseModel(400, false, '. Platform cannot be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }                               

                            }

                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre == 'n_a' && $score != 'n_a' && $year != 'n_a' && $platform != 'n_a')
            {

                //id, score, year and platform

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(!is_numeric($score))
                        {
    
                            $response = new ResponseModel(400, false, '. Score must be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                        
                            if(!is_numeric($year))
                            {

                                $response = new ResponseModel(400, false, '. Year must be numeric!', null);
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(!is_numeric($platform))
                                {

                                    $sql = "UPDATE tbl_games SET score = :score, year = :year, platform = :platform WHERE id = :id";

                                    $statement = $conn -> prepare($sql);
                                    $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                    $statement -> bindParam(':score', $score, PDO::PARAM_INT);
                                    $statement -> bindParam(':year', $year, PDO::PARAM_INT);
                                    $statement -> bindParam(':platform', $platform, PDO::PARAM_STR);
                                    $statement -> execute();


                                    $statement -> closeCursor();
                    
                                    $response = new ResponseModel(200, false, null, null);
                                    $response -> send($output);
                                    exit(); 

                                }
                                else
                                {

                                    $response = new ResponseModel(400, false, '. Platform cannot be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }                               

                            }

                        }

                    }

                }

            }
            if($id != 'n_a' && $name != 'n_a' && $author != 'n_a' && $genre != 'n_a' && $score != 'n_a' && $year == 'n_a' && $platform == 'n_a')
            {

                //id, name, author, genre and score

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($name))
                        {
    
                            $response = new ResponseModel(400, false, '. Name cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                                            
                            if($this -> nameCheck($name) != 0)
                            {
                                
                                $response = new ResponseModel(409, false, '. Name already exists!');
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(is_numeric($author))
                                {

                                    $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }
                                else
                                {

                                   if(is_numeric($genre))
                                   {

                                        $response = new ResponseModel(400, false, '. Genre cannot be numeric!', null);
                                        $response -> send($output);
                                        exit();

                                   }
                                   else
                                   {

                                        if(is_numeric($score))
                                        {

                                            $sql = "UPDATE tbl_games SET name = :name, author = :author, genre = :genre,
                                             score = :score WHERE id = :id";

                                            $statement = $conn -> prepare($sql);
                                            $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                            $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                                            $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                            $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                            $statement -> bindParam(':score', $score, PDO::PARAM_INT);
                                            $statement -> execute();
        
        
                                            $statement -> closeCursor();
                            
                                            $response = new ResponseModel(200, false, null, null);
                                            $response -> send($output);
                                            exit(); 

                                        }
                                        else
                                        {

                                            $response = new ResponseModel(400, false, '. Score must be numeric!', null);
                                            $response -> send($output);
                                            exit();

                                        }

                                   }

                                }

                            }
    
                        }

                    }

                }

            }
            if($id != 'n_a' && $name != 'n_a' && $author != 'n_a' && $genre != 'n_a' && $score == 'n_a' && $year != 'n_a' && $platform == 'n_a')
            {

                //id, name, author, genre and year

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($name))
                        {
    
                            $response = new ResponseModel(400, false, '. Name cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                                            
                            if($this -> nameCheck($name) != 0)
                            {
                                
                                $response = new ResponseModel(409, false, '. Name already exists!');
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(is_numeric($author))
                                {

                                    $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }
                                else
                                {

                                   if(is_numeric($genre))
                                   {

                                        $response = new ResponseModel(400, false, '. Genre cannot be numeric!', null);
                                        $response -> send($output);
                                        exit();

                                   }
                                   else
                                   {

                                        if(is_numeric($year))
                                        {

                                            $sql = "UPDATE tbl_games SET name = :name, author = :author, genre = :genre, year = :year WHERE id = :id";

                                            $statement = $conn -> prepare($sql);
                                            $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                            $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                                            $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                            $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                            $statement -> bindParam(':year', $year, PDO::PARAM_INT);
                                            $statement -> execute();
        
        
                                            $statement -> closeCursor();
                            
                                            $response = new ResponseModel(200, false, null, null);
                                            $response -> send($output);
                                            exit(); 

                                        }
                                        else
                                        {

                                            $response = new ResponseModel(400, false, '. Year must be numeric!', null);
                                            $response -> send($output);
                                            exit();

                                        }

                                   }

                                }

                            }
    
                        }

                    }

                }

            }
            if($id != 'n_a' && $name != 'n_a' && $author != 'n_a' && $genre != 'n_a' && $score == 'n_a' && $year == 'n_a' && $platform != 'n_a')
            {

                //id, name, author, genre and platform

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($name))
                        {
    
                            $response = new ResponseModel(400, false, '. Name cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                                            
                            if($this -> nameCheck($name) != 0)
                            {
                                
                                $response = new ResponseModel(409, false, '. Name already exists!');
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(is_numeric($author))
                                {

                                    $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }
                                else
                                {

                                   if(is_numeric($genre))
                                   {

                                        $response = new ResponseModel(400, false, '. Genre cannot be numeric!', null);
                                        $response -> send($output);
                                        exit();

                                   }
                                   else
                                   {

                                        if(!is_numeric($platform))
                                        {

                                            $sql = "UPDATE tbl_games SET name = :name, author = :author, genre = :genre, platform = :platform WHERE id = :id";

                                            $statement = $conn -> prepare($sql);
                                            $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                            $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                                            $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                            $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                            $statement -> bindParam(':platform', $platform, PDO::PARAM_STR);
                                            $statement -> execute();
        
        
                                            $statement -> closeCursor();
                            
                                            $response = new ResponseModel(200, false, null, null);
                                            $response -> send($output);
                                            exit(); 

                                        }
                                        else
                                        {

                                            $response = new ResponseModel(400, false, '. Platform cannot be numeric!', null);
                                            $response -> send($output);
                                            exit();

                                        }

                                   }

                                }

                            }
    
                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre != 'n_a' && $score != 'n_a' && $year != 'n_a' && $platform == 'n_a')
            {

                //id, author, genre, score and year

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($author))
                        {
    
                            $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                        
                            if(is_numeric($genre))
                            {

                                $response = new ResponseModel(400, false, '. Genre cannot be numeric!', null);
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(!is_numeric($score))
                                {

                                    $response = new ResponseModel(400, false, '. Score must be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }
                                else
                                {

                                    if(is_numeric($year))
                                    {

                                        $sql = "UPDATE tbl_games SET author = :author, genre = :genre,
                                         score = :score, year = :year WHERE id = :id";

                                        $statement = $conn -> prepare($sql);
                                        $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                        $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                        $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                        $statement -> bindParam(':score', $score, PDO::PARAM_INT);
                                        $statement -> bindParam(':year', $year, PDO::PARAM_INT);
                                        $statement -> execute();
    
    
                                        $statement -> closeCursor();
                        
                                        $response = new ResponseModel(200, false, null, null);
                                        $response -> send($output);
                                        exit(); 

                                    }
                                    else
                                    {

                                        $response = new ResponseModel(400, false, '. Year must be numeric!', null);
                                        $response -> send($output);
                                        exit();

                                    }

                                }                               

                            }

                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre == 'n_a' && $score != 'n_a' && $year != 'n_a' && $platform != 'n_a')
            {

                //id, author, score, year, platform

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($author))
                        {
    
                            $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                        
                            if(is_numeric($platform))
                            {

                                $response = new ResponseModel(400, false, '. Platform cannot be numeric!', null);
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(!is_numeric($score))
                                {

                                    $response = new ResponseModel(400, false, '. Score must be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }
                                else
                                {

                                    if(is_numeric($year))
                                    {

                                        $sql = "UPDATE tbl_games SET author = :author,
                                         score = :score, year = :year, platform = :platform WHERE id = :id";

                                        $statement = $conn -> prepare($sql);
                                        $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                        $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                        $statement -> bindParam(':score', $score, PDO::PARAM_INT);
                                        $statement -> bindParam(':year', $year, PDO::PARAM_INT);
                                        $statement -> bindParam(':platform', $platform, PDO::PARAM_STR);

                                        $statement -> execute();
    
    
                                        $statement -> closeCursor();
                        
                                        $response = new ResponseModel(200, false, null, null);
                                        $response -> send($output);
                                        exit(); 

                                    }
                                    else
                                    {

                                        $response = new ResponseModel(400, false, '. Year must be numeric!', null);
                                        $response -> send($output);
                                        exit();

                                    }

                                }                               

                            }

                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre != 'n_a' && $score != 'n_a' && $year == 'n_a' && $platform != 'n_a')
            {

                //id, author, genre, score, platform

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($author))
                        {
    
                            $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                        
                            if(is_numeric($platform))
                            {

                                $response = new ResponseModel(400, false, '. Platform cannot be numeric!', null);
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(!is_numeric($score))
                                {

                                    $response = new ResponseModel(400, false, '. Score must be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }
                                else
                                {

                                    if(!is_numeric($genre))
                                    {

                                        $sql = "UPDATE tbl_games SET author = :author,
                                         genre = :genre, score = :score, platform = :platform WHERE id = :id";

                                        $statement = $conn -> prepare($sql);
                                        $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                        $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                        $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                        $statement -> bindParam(':score', $score, PDO::PARAM_INT);
                                        $statement -> bindParam(':platform', $platform, PDO::PARAM_STR);

                                        $statement -> execute();
    
    
                                        $statement -> closeCursor();
                        
                                        $response = new ResponseModel(200, false, null, null);
                                        $response -> send($output);
                                        exit(); 

                                    }
                                    else
                                    {

                                        $response = new ResponseModel(400, false, '. Genre cannot be numeric!', null);
                                        $response -> send($output);
                                        exit();

                                    }

                                }                               

                            }

                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre != 'n_a' && $score == 'n_a' && $year != 'n_a' && $platform != 'n_a')
            {

                //id, author, genre, year, platform

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($author))
                        {
    
                            $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                        
                            if(is_numeric($platform))
                            {

                                $response = new ResponseModel(400, false, '. Platform cannot be numeric!', null);
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(!is_numeric($year))
                                {

                                    $response = new ResponseModel(400, false, '. Year must be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }
                                else
                                {

                                    if(!is_numeric($genre))
                                    {

                                        $sql = "UPDATE tbl_games SET author = :author,
                                         genre = :genre, year = :year, platform = :platform WHERE id = :id";

                                        $statement = $conn -> prepare($sql);
                                        $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                        $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                        $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                        $statement -> bindParam(':year', $year, PDO::PARAM_INT);
                                        $statement -> bindParam(':platform', $platform, PDO::PARAM_STR);

                                        $statement -> execute();
    
    
                                        $statement -> closeCursor();
                        
                                        $response = new ResponseModel(200, false, null, null);
                                        $response -> send($output);
                                        exit(); 

                                    }
                                    else
                                    {

                                        $response = new ResponseModel(400, false, '. Genre cannot be numeric!', null);
                                        $response -> send($output);
                                        exit();

                                    }

                                }                               

                            }

                        }

                    }

                }

            }
            if($id != 'n_a' && $name != 'n_a' && $author != 'n_a' && $genre == 'n_a' && $score != 'n_a' && $year != 'n_a' && $platform == 'n_a')
            {

                //id, name,author, score and year

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($author))
                        {
    
                            $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                        
                            if(is_numeric($name))
                            {

                                $response = new ResponseModel(400, false, '. Name cannot be numeric!', null);
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(!is_numeric($score))
                                {

                                    $response = new ResponseModel(400, false, '. Score must be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }
                                else
                                {

                                    if(is_numeric($year))
                                    {

                                        $sql = "UPDATE tbl_games SET name = :name, author = :author,
                                         score = :score, year = :year WHERE id = :id";

                                        $statement = $conn -> prepare($sql);
                                        $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                        $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                                        $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                        $statement -> bindParam(':score', $score, PDO::PARAM_INT);
                                        $statement -> bindParam(':year', $year, PDO::PARAM_INT);
                                        $statement -> execute();
    
    
                                        $statement -> closeCursor();
                        
                                        $response = new ResponseModel(200, false, null, null);
                                        $response -> send($output);
                                        exit(); 

                                    }
                                    else
                                    {

                                        $response = new ResponseModel(400, false, '. Year must be numeric!', null);
                                        $response -> send($output);
                                        exit();

                                    }

                                }                               

                            }

                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre != 'n_a' && $score != 'n_a' && $year == 'n_a' && $platform != 'n_a')
            {

                //id, author, genre, score and platform

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($author))
                        {
    
                            $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                        
                            if(is_numeric($genre))
                            {

                                $response = new ResponseModel(400, false, '. Genre cannot be numeric!', null);
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(!is_numeric($score))
                                {

                                    $response = new ResponseModel(400, false, '. Score must be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }
                                else
                                {

                                    if(!is_numeric($platform))
                                    {

                                        $sql = "UPDATE tbl_games SET author = :author, genre = :genre,
                                         score = :score, platform = :platform WHERE id = :id";

                                        $statement = $conn -> prepare($sql);
                                        $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                        $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                        $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                        $statement -> bindParam(':score', $score, PDO::PARAM_INT);
                                        $statement -> bindParam(':platformr', $platform, PDO::PARAM_STR);
                                        $statement -> execute();
    
    
                                        $statement -> closeCursor();
                        
                                        $response = new ResponseModel(200, false, null, null);
                                        $response -> send($output);
                                        exit(); 

                                    }
                                    else
                                    {

                                        $response = new ResponseModel(400, false, '. Platform cannot be numeric!', null);
                                        $response -> send($output);
                                        exit();

                                    }

                                }                               

                            }

                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre != 'n_a' && $score != 'n_a' && $year != 'n_a' && $platform == 'n_a')
            {

                //id, author, genre, year and platform

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($author))
                        {
    
                            $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                        
                            if(is_numeric($genre))
                            {

                                $response = new ResponseModel(400, false, '. Genre cannot be numeric!', null);
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(!is_numeric($year))
                                {

                                    $response = new ResponseModel(400, false, '. Year must be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }
                                else
                                {

                                    if(!is_numeric($platform))
                                    {

                                        $sql = "UPDATE tbl_games SET author = :author, genre = :genre,
                                         year = :year, platform = :platform WHERE id = :id";

                                        $statement = $conn -> prepare($sql);
                                        $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                        $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                        $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                        $statement -> bindParam(':year', $year, PDO::PARAM_INT);
                                        $statement -> bindParam(':platform', $platform, PDO::PARAM_STR);
                                        $statement -> execute();
    
    
                                        $statement -> closeCursor();
                        
                                        $response = new ResponseModel(200, false, null, null);
                                        $response -> send($output);
                                        exit(); 

                                    }
                                    else
                                    {

                                        $response = new ResponseModel(400, false, '. Platform cannot be numeric!', null);
                                        $response -> send($output);
                                        exit();

                                    }

                                }                               

                            }

                        }

                    }

                }


            }
            if($id != 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre != 'n_a' && $score != 'n_a' && $year != 'n_a' && $platform != 'n_a')
            {

                //id, genre, score, year and platform

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($genre))
                        {
    
                            $response = new ResponseModel(400, false, '. Genre cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                        
                            if(!is_numeric($score))
                            {

                                $response = new ResponseModel(400, false, '. Score must be numeric!', null);
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(!is_numeric($year))
                                {

                                    $response = new ResponseModel(400, false, '. Year must be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }
                                else
                                {

                                    if(!is_numeric($platform))
                                    {

                                        $sql = "UPDATE tbl_games SET genre = :genre, score = :score,
                                         year = :year, platform = :platform WHERE id = :id";

                                        $statement = $conn -> prepare($sql);
                                        $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                        $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                        $statement -> bindParam(':score', $score, PDO::PARAM_INT);
                                        $statement -> bindParam(':year', $year, PDO::PARAM_INT);
                                        $statement -> bindParam(':platform', $platform, PDO::PARAM_STR);
                                        $statement -> execute();
    
    
                                        $statement -> closeCursor();
                        
                                        $response = new ResponseModel(200, false, null, null);
                                        $response -> send($output);
                                        exit(); 

                                    }
                                    else
                                    {

                                        $response = new ResponseModel(400, false, '. Platform cannot be numeric!', null);
                                        $response -> send($output);
                                        exit();

                                    }

                                }                               

                            }

                        }

                    }

                }


            }
            if($id != 'n_a' && $name != 'n_a' && $author != 'n_a' && $genre != 'n_a' && $score != 'n_a' && $year != 'n_a' && $platform == 'n_a')
            {

                //id, name, author, genre, score and year

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($name))
                        {
    
                            $response = new ResponseModel(400, false, '. Name cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                                            
                            if($this -> nameCheck($name) != 0)
                            {
                                
                                $response = new ResponseModel(409, false, '. Name already exists!');
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(is_numeric($author))
                                {

                                    $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }
                                else
                                {

                                   if(is_numeric($genre))
                                   {

                                        $response = new ResponseModel(400, false, '. Genre cannot be numeric!', null);
                                        $response -> send($output);
                                        exit();

                                   }
                                   else
                                   {

                                        if(!is_numeric($score))
                                        {

                                            $response = new ResponseModel(400, false, '. Score must be numeric!', null);
                                            $response -> send($output);
                                            exit();

                                        }
                                        else
                                        {

                                            if(is_numeric($year))
                                            {

                                                $sql = "UPDATE tbl_games SET name = :name, author = :author, genre = :genre,
                                                 score = :score, year = :year WHERE id = :id";

                                                $statement = $conn -> prepare($sql);
                                                $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                                $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                                                $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                                $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                                $statement -> bindParam(':score', $score, PDO::PARAM_INT);
                                                $statement -> bindParam(':year', $year, PDO::PARAM_INT);
                                                $statement -> execute();

                       
                                                $statement -> closeCursor();
                                
                                                $response = new ResponseModel(200, false, null, null);
                                                $response -> send($output);
                                                exit(); 

                                            }
                                            else
                                            {

                                                $response = new ResponseModel(400, false, '. Year must be numeric!', null);
                                                $response -> send($output);
                                                exit();

                                            }

                                        }

                                   }

                                }

                            }
    
                        }

                    }

                }

            }
            if($id != 'n_a' && $name != 'n_a' && $author != 'n_a' && $genre != 'n_a' && $score != 'n_a' && $year == 'n_a' && $platform != 'n_a')
            {

                //id, name, author, genre, score and platform

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($name))
                        {
    
                            $response = new ResponseModel(400, false, '. Name cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                                            
                            if($this -> nameCheck($name) != 0)
                            {
                                
                                $response = new ResponseModel(409, false, '. Name already exists!');
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(is_numeric($author))
                                {

                                    $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }
                                else
                                {

                                   if(is_numeric($genre))
                                   {

                                        $response = new ResponseModel(400, false, '. Genre cannot be numeric!', null);
                                        $response -> send($output);
                                        exit();

                                   }
                                   else
                                   {

                                        if(!is_numeric($score))
                                        {

                                            $response = new ResponseModel(400, false, '. Score must be numeric!', null);
                                            $response -> send($output);
                                            exit();

                                        }
                                        else
                                        {

                                            if(!is_numeric($platform))
                                            {

                                                $sql = "UPDATE tbl_games SET name = :name, author = :author, genre = :genre, score = :score, platform = :platform WHERE id = :id";

                                                $statement = $conn -> prepare($sql);
                                                $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                                $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                                                $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                                $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                                $statement -> bindParam(':score', $score, PDO::PARAM_INT);
                                                $statement -> bindParam(':platform', $platform, PDO::PARAM_INT);
                                                $statement -> execute();

                       
                                                $statement -> closeCursor();
                                
                                                $response = new ResponseModel(200, false, null, null);
                                                $response -> send($output);
                                                exit(); 

                                            }
                                            else
                                            {

                                                $response = new ResponseModel(400, false, '. Platform cannot be numeric!', null);
                                                $response -> send($output);
                                                exit();

                                            }

                                        }

                                   }

                                }

                            }
    
                        }

                    }

                }

            }
            if($id != 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre != 'n_a' && $score != 'n_a' && $year != 'n_a' && $platform != 'n_a')
            {

                //id, author, genre, score, year and platform

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($author))
                        {
    
                            $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                        
                            if(is_numeric($genre))
                            {

                                $response = new ResponseModel(400, false, '. Genre cannot be numeric!', null);
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(!is_numeric($score))
                                {

                                    $response = new ResponseModel(400, false, '. Score must be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }
                                else
                                {

                                    if(!is_numeric($year))
                                    {

                                        $response = new ResponseModel(400, false, '. Year must be numeric!', null);
                                        $response -> send($output);
                                        exit();

                                    }
                                    else
                                    {

                                       if(!is_numeric($platform))
                                       {

                                            $sql = "UPDATE tbl_games SET author = :author, genre = :genre,
                                            score = :score, year = :year, platform = :platform WHERE id = :id";

                                            $statement = $conn -> prepare($sql);
                                            $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                            $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                            $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                            $statement -> bindParam(':score', $score, PDO::PARAM_INT);
                                            $statement -> bindParam(':year', $year, PDO::PARAM_INT);
                                            $statement -> bindParam(':platform', $platform, PDO::PARAM_STR);
                                            $statement -> execute();


                                            $statement -> closeCursor();


                                            $response = new ResponseModel(200, false, null, null);
                                            $response -> send($output);
                                            exit(); 

                                        }
                                        else
                                        {

                                            $response = new ResponseModel(400, false, '. Platform cannot be numeric!', null);
                                            $response -> send($output);
                                            exit();

                                        }

                                    }

                                }                               

                            }

                        }

                    }

                }

            }
            if($id != 'n_a' && $name != 'n_a' && $author != 'n_a' && $genre != 'n_a' && $score != 'n_a' && $year != 'n_a' && $platform != 'n_a')
            {

                //id, name, author, genre, score, year and platform

                if(!is_numeric($id))
                {

                    $response = new ResponseModel(400, false, '. ID must be numeric!', null);
                    $response -> send($output);
                    exit();

                }
                else
                {
        
                    if($this -> idCheck($id) == 0)
                    {
                        
                        $response = new ResponseModel(404, true, null, null);
                        $response -> send($output);
                        exit();

                    }
                    else
                    {

                        if(is_numeric($name))
                        {
    
                            $response = new ResponseModel(400, false, '. Name cannot be numeric!', null);
                            $response -> send($output);
                            exit();
    
                        }
                        else
                        {
                                            
                            if($this -> nameCheck($name) != 0)
                            {
                                
                                $response = new ResponseModel(409, false, '. Name already exists!');
                                $response -> send($output);
                                exit();

                            }
                            else
                            {

                                if(is_numeric($author))
                                {

                                    $response = new ResponseModel(400, false, '. Author cannot be numeric!', null);
                                    $response -> send($output);
                                    exit();

                                }
                                else
                                {

                                   if(is_numeric($genre))
                                   {

                                        $response = new ResponseModel(400, false, '. Genre cannot be numeric!', null);
                                        $response -> send($output);
                                        exit();

                                   }
                                   else
                                   {

                                        if(!is_numeric($score))
                                        {

                                            $response = new ResponseModel(400, false, '. Score must be numeric!', null);
                                            $response -> send($output);
                                            exit();

                                        }
                                        else
                                        {

                                            if(!is_numeric($year))
                                            {

                                                $response = new ResponseModel(400, false, '. Year must be numeric!', null);
                                                $response -> send($output);
                                                exit();

                                            }
                                            else
                                            {

                                                if(!is_numeric($platform))
                                                {


                                                    $sql = "UPDATE tbl_games SET name = :name, author = :author, genre = :genre, 
                                                    score = :score, year = :year, platform = :platform WHERE id = :id";

                                                    $statement = $conn -> prepare($sql);
                                                    $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                                                    $statement -> bindParam(':name', $name, PDO::PARAM_STR);
                                                    $statement -> bindParam(':author', $author, PDO::PARAM_STR);
                                                    $statement -> bindParam(':genre', $genre, PDO::PARAM_STR);
                                                    $statement -> bindParam(':score', $score, PDO::PARAM_INT);
                                                    $statement -> bindParam(':year', $year, PDO::PARAM_INT);
                                                    $statement -> bindParam(':platform', $platform, PDO::PARAM_STR);
                                                    $statement -> execute();
    
                           
                                                    $statement -> closeCursor();
                                    
                                                    $response = new ResponseModel(200, false, null, null);
                                                    $response -> send($output);
                                                    exit(); 

                                                }
                                                else
                                                {

                                                    $response = new ResponseModel(400, false, '. Platform cannot be numeric!', null);
                                                    $response -> send($output);
                                                    exit();

                                                }

                                            }

                                        }

                                   }

                                }

                            }
    
                        }

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
            $response -> send('json');
            exit();

        }
       


    }

}