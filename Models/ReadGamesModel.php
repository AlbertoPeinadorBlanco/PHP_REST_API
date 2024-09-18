<?php

namespace Models;
use PDO;
use PDOException;

//Endpoint for reading games from the database
class ReadGamesModel extends ReadUserModel
{
    
    //Endpoint for reading games from the database
    public function readData($data)
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


        if($id == 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre == 'n_a' && $score == 'n_a' && $year == 'n_a' && $platform == 'n_a')
        {

            
            try
            {

                $sql = "SELECT * FROM tbl_games";

                $conn = $this -> connect();
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
            catch(PDOException $e)
            {

                $response = new ResponseModel(500, false, $e->getMessage(), null);
                $response->send('json');
                exit();

            }

            
    
            

        }
        if($id != 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre == 'n_a' && $score == 'n_a' && $year == 'n_a' && $platform == 'n_a')
        {
            //id

            if($id == '')
            {

                $response = new ResponseModel(400, true, ". ID cannot be empty!", null);
                $response->send($output);
                exit();

            }
            else
            {

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

                        try
                        {

                            $sql = "SELECT * FROM tbl_games WHERE id = :id";
    
                            $conn = $this -> connect();
                            $statement = $conn -> prepare($sql);
                            $statement ->bindValue(':id', $id, PDO::PARAM_INT);
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
                        catch(PDOException $e)
                        {

                            $response = new ResponseModel(500, false, $e->getMessage(), null);
                            $response->send('json');
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
           
        }
        if($id == 'n_a' && $name != 'n_a' && $author == 'n_a' && $genre == 'n_a' && $score == 'n_a' && $year == 'n_a' && $platform == 'n_a')
        {

            //name

            if($name == '')
            {

                $response = new ResponseModel(400, true, ". Name cannot be empty!", null);
                $response->send($output);
                exit();

            }
            else
            {

                try
                {

                    $sql = "SELECT * FROM tbl_games WHERE name = :name";
    
                    $conn = $this -> connect();
                    $statement = $conn -> prepare($sql);
                    $statement ->bindValue(':name', $name, PDO::PARAM_STR);
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
                catch(PDOException $e)
                {

                    $response = new ResponseModel(500, false, $e->getMessage(), null);
                    $response->send('json');
                    exit();

                }


            }

        }
        if($id == 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre == 'n_a' && $score == 'n_a' && $year == 'n_a' && $platform == 'n_a')
        {
          
            //author

            if(is_numeric($author))
            {

                $response = new ResponseModel(400, true, ". Author cannot be numeric!", null);
                $response->send($output);
                exit();

            }
            else
            {

                try
                {

                    $sql = "SELECT * FROM tbl_games WHERE author = :author";
    
                    $conn = $this -> connect();
                    $statement = $conn -> prepare($sql);
                    $statement ->bindValue(':author', $author, PDO::PARAM_STR);
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
                catch(PDOException $e)
                {

                    $response = new ResponseModel(500, false, $e->getMessage(), null);
                    $response->send('json');
                    exit();

                }

              

            }

        }
        if($id == 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre != 'n_a' && $score == 'n_a' && $year == 'n_a' && $platform == 'n_a')
        {

            //genre

            if(is_numeric($genre))
            {

                $response = new ResponseModel(400, true, ". Genre cannot be numeric!", null);
                $response->send($output);
                exit();

            }
            else
            {

                if($genre == '')
                {

                    $response = new ResponseModel(400, true, ". Genre cannot be empty!", null);
                    $response->send($output);
                    exit();

                }
                else
                {

                    try
                    {

                        $sql = "SELECT * FROM tbl_games WHERE genre = :genre";
    
                        $conn = $this -> connect();
                        $statement = $conn -> prepare($sql);
                        $statement ->bindValue(':genre', $genre, PDO::PARAM_STR);
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
                    catch(PDOException $e)
                    {

                        $response = new ResponseModel(500, false, $e->getMessage(), null);
                        $response->send('json');
                        exit();

                    }

                }
            }

        }
        if($id == 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre == 'n_a' && $score != 'n_a' && $year == 'n_a' && $platform == 'n_a')
        {

            //score

            if(!is_numeric($score))
            {

                $response = new ResponseModel(400, true, ". Score must be numeric!", null);
                $response->send($output);
                exit();

            }
            else
            {

                if($score == '')
                {
                    $response = new ResponseModel(400, true, ". Score cannot be empty!", null);
                    $response->send($output);
                    exit();

                }
                else
                {

                    try
                    {

                        $sql = "SELECT * FROM tbl_games WHERE score = :score";
    
                        $conn = $this -> connect();
                        $statement = $conn -> prepare($sql);
                        $statement ->bindValue(':score', $score, PDO::PARAM_INT);
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
                    catch(PDOException $e)
                    {

                        $response = new ResponseModel(500, false, $e->getMessage(), null);
                        $response->send('json');
                        exit();

                    }

                    

                }

            }

        }
        if($id == 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre == 'n_a' && $score == 'n_a' && $year != 'n_a' && $platform == 'n_a')
        {

            //year

            if(!is_numeric($year))
            {

                $response = new ResponseModel(400, true, ". Year must be numeric!", null);
                $response->send($output);
                exit();

            }
            else
            {

                if($year == '')
                {

                    $response = new ResponseModel(400, true, ". Year cannot be empty!", null);
                    $response->send($output);
                    exit();

                }
                else
                {

                    try
                    {

                        $sql = "SELECT * FROM tbl_games WHERE year = :year";
    
                        $conn = $this -> connect();
                        $statement = $conn -> prepare($sql);
                        $statement ->bindValue(':year', $year, PDO::PARAM_INT);
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
                    catch(PDOException $e)
                    {

                        $response = new ResponseModel(500, false, $e->getMessage(), null);
                        $response->send('json');
                        exit();

                    }

                }

            }

        }
        if($id == 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre == 'n_a' && $score == 'n_a' && $year == 'n_a' && $platform != 'n_a')
        {

            //platform

            if($platform == '')
            {

                $response = new ResponseModel(400, true, ". Platform cannot be empty!", null);
                $response->send($output);
                exit();

            }
            else
            {
                
                try
                {

                    $sql = "SELECT * FROM tbl_games WHERE platform LIKE CONCAT('%', :platform, '%')";
    
                    $conn = $this -> connect();
                    $statement = $conn -> prepare($sql);
                    $statement ->bindValue(":platform", $platform, PDO::PARAM_STR);
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
                catch(PDOException $e)
                {

                    $response = new ResponseModel(500, false, $e->getMessage(), null);
                    $response->send('json');
                    exit();

                }

            }

        }
        if($id == 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre != 'n_a' && $score == 'n_a' && $year == 'n_a' && $platform == 'n_a')
        {

            //author and genre

            if(is_numeric($author))
            {

                $response = new ResponseModel(400, true, ". Author cannot be numeric!", null);
                $response->send($output);
                exit();

            }
            else
            {

                if(!is_numeric($genre))
                {

                    try
                    {

                        $sql = "SELECT * FROM tbl_games WHERE author = :author AND genre = :genre";
    
                        $conn = $this -> connect();
                        $statement = $conn -> prepare($sql);
                        $statement -> bindValue(':author', $author, PDO::PARAM_STR);
                        $statement -> bindValue(':genre', $genre, PDO::PARAM_STR);
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
                    catch(PDOException $e)
                    {

                        $response = new ResponseModel(500, false, $e->getMessage(), null);
                        $response->send($output);
                        exit();

                    }

                }
                else
                {

                    $response = new ResponseModel(400, true, ". Genre cannot be numeric!", null);
                    $response->send($output);
                    exit();

                }

                
            }

        }
        if($id == 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre == 'n_a' && $score != 'n_a' && $year == 'n_a' && $platform == 'n_a')
        {

            //author, score

            if($author == '' || $score == "")
            {

                $response = new ResponseModel(400, true, ". Author and score cannot be empty!", null);
                $response->send($output);
                exit();

            }
            else
            {

                if(is_numeric($author))
                {

                    $response = new ResponseModel(400, true, ". Author cannot be numeric!", null);
                    $response->send($output);
                    exit();

                }
                else
                {
                    if(is_numeric($score))
                    {
    
                        try
                        {

                            $sql = "SELECT * FROM tbl_games WHERE author = :author AND score = :score";
        
                            $conn = $this -> connect();
                            $statement = $conn -> prepare($sql);
                            $statement -> bindValue(':author', $author, PDO::PARAM_STR);
                            $statement -> bindValue(':score', $score, PDO::PARAM_INT);
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
                        catch(PDOException $e)
                        {

                            $response = new ResponseModel(500, false, $e->getMessage(), null);
                            $response->send('json');
                            exit();

                        }

                    }
                    else
                    {

                        $response = new ResponseModel(400, true, ". Score must be numeric!", null);
                        $response->send($output);
                        exit();

                    }

                }

            }

        }
        if($id == 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre == 'n_a' && $score == 'n_a' && $year != 'n_a' && $platform == 'n_a')
        {
            //author, year

            if($author == '' || $year == "")
            {

                $response = new ResponseModel(400, true, ". Author and year cannot be empty!", null);
                $response->send($output);
                exit();

            }
            else
            {

                if(is_numeric($author))
                {

                    $response = new ResponseModel(400, true, ". Author cannot be numeric!", null);
                    $response->send($output);
                    exit();

                }
                else
                {
                    if(is_numeric($year))
                    {

                        try
                        {

                            $sql = "SELECT * FROM tbl_games WHERE author = :author AND year = :year";
        
                            $conn = $this -> connect();
                            $statement = $conn -> prepare($sql);
                            $statement -> bindValue(':author', $author, PDO::PARAM_STR);
                            $statement -> bindValue(':year', $year, PDO::PARAM_INT);
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
                        catch(PDOException $e)
                        {

                            $response = new ResponseModel(500, false, $e->getMessage(), null);
                            $response->send('json');
                            exit();

                        }
    
                    }
                    else
                    {

                        $response = new ResponseModel(400, true, ". Year must be numeric!", null);
                        $response->send($output);
                        exit();

                    }

                }

            }

        }
        if($id == 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre == 'n_a' && $score == 'n_a' && $year == 'n_a' && $platform != 'n_a')
        {
            //author, platform

            if($author == '' || $platform == "")
            {

                $response = new ResponseModel(400, true, ". Author and platform cannot be empty!", null);
                $response->send($output);
                exit();

            }
            else
            {

                if(is_numeric($author))
                {

                    $response = new ResponseModel(400, true, ". Author cannot be numeric!", null);
                    $response->send($output);
                    exit();

                }
                else
                {
                    if(!is_numeric($platform))
                    {
    
                        try
                        {

                            $sql = "SELECT * FROM tbl_games WHERE author = :author AND platform LIKE CONCAT('%' , :platform , '%')";
        
                            $conn = $this -> connect();
                            $statement = $conn -> prepare($sql);
                            $statement -> bindValue(':author', $author, PDO::PARAM_STR);
                            $statement -> bindValue(':platform', $platform, PDO::PARAM_STR);
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
                        catch(PDOException $e)
                        {

                            $response = new ResponseModel(500, false, $e->getMessage(), null);
                            $response->send('json');
                            exit();

                        }

                    }
                    else
                    {

                        $response = new ResponseModel(400, true, ". Platform cannot be numeric!", null);
                        $response->send($output);
                        exit();

                    }

                }

            }

        }
        if($id == 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre != 'n_a' && $score != 'n_a' && $year == 'n_a' && $platform == 'n_a')
        {
            //genre, score

            if($genre == '' || $score == "")
            {

                $response = new ResponseModel(400, true, ". Genre and score cannot be empty!", null);
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
                    if(is_numeric($score))
                    {
    
                        try
                        {

                            $sql = "SELECT * FROM tbl_games WHERE genre = :genre AND score = :score";
        
                            $conn = $this -> connect();
                            $statement = $conn -> prepare($sql);
                            $statement -> bindValue(':genre', $genre, PDO::PARAM_STR);
                            $statement -> bindValue(':score', $score, PDO::PARAM_INT);
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
                        catch(PDOException $e)
                        {

                            $response = new ResponseModel(500, false, $e->getMessage(), null);
                            $response->send('json');
                            exit();

                        }

                    }
                    else
                    {

                        $response = new ResponseModel(400, true, ". Score must be numeric!", null);
                        $response->send($output);
                        exit();

                    }

                }

            }

        }
        if($id == 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre != 'n_a' && $score == 'n_a' && $year != 'n_a' && $platform == 'n_a')
        {
            //genre, year

            if($genre == '' || $year == "")
            {

                $response = new ResponseModel(400, true, ". Genre and year cannot be empty!", null);
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
                    if(is_numeric($year))
                    {
    
                        try
                        {

                            $sql = "SELECT * FROM tbl_games WHERE genre = :genre AND year = :year ";
        
                            $conn = $this -> connect();
                            $statement = $conn -> prepare($sql);
                            $statement -> bindValue(':genre', $genre, PDO::PARAM_STR);
                            $statement -> bindValue(':year', $year, PDO::PARAM_INT);
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
                        catch(PDOException $e)
                        {

                            $response = new ResponseModel(500, false, $e->getMessage(), null);
                            $response->send('json');
                            exit();

                        }

                    }
                    else
                    {

                        $response = new ResponseModel(400, true, ". Year must be numeric!", null);
                        $response->send($output);
                        exit();

                    }

                }

            }
        }
        if($id == 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre != 'n_a' && $score == 'n_a' && $year == 'n_a' && $platform != 'n_a')
        {

            
            //genre, platform

            if($genre == '' || $platform == "")
            {

                $response = new ResponseModel(400, true, ". Genre and platform cannot be empty!", null);
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
                    if(!is_numeric($platform))
                    {
    
                        try
                        {

                            $sql = "SELECT * FROM tbl_games WHERE genre = :genre AND platform LIKE CONCAT('%' , :platform , '%')";
        
                            $conn = $this -> connect();
                            $statement = $conn -> prepare($sql);
                            $statement -> bindValue(':genre', $genre, PDO::PARAM_STR);
                            $statement -> bindValue(':platform', $platform, PDO::PARAM_STR);
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
                        catch(PDOException $e)
                        {

                            $response = new ResponseModel(500, false, $e->getMessage(), null);
                            $response->send('json');
                            exit();

                        }

                    }
                    else
                    {

                        $response = new ResponseModel(400, true, ". Platform cannot be numeric!", null);
                        $response->send($output);
                        exit();

                    }

                }

            }

        }
        if($id == 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre == 'n_a' && $score != 'n_a' && $year != 'n_a' && $platform == 'n_a')
        {
            //score, year

            if($score == '' || $year == "")
            {

                $response = new ResponseModel(400, true, ". Score and year cannot be empty!", null);
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
                    if(is_numeric($year))
                    {
    
                        try
                        {

                            $sql = "SELECT * FROM tbl_games WHERE score = :score AND year = :year";
        
                            $conn = $this -> connect();
                            $statement = $conn -> prepare($sql);
                            $statement -> bindValue(':score', $score, PDO::PARAM_INT);
                            $statement -> bindValue(':year', $year, PDO::PARAM_INT);
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
                        catch(PDOException $e)
                        {

                            $response = new ResponseModel(500, false, $e->getMessage(), null);
                            $response->send('json');
                            exit();

                        }

                    }
                    else
                    {

                        $response = new ResponseModel(400, true, ". Year must be numeric!", null);
                        $response->send($output);
                        exit();

                    }

                }

            }

        }
        if($id == 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre == 'n_a' && $score != 'n_a' && $year == 'n_a' && $platform != 'n_a')
        {
            //score, platform

            if($score == "" || $platform == "")
            {

                $response = new ResponseModel(400, true, ". Score and platform cannot be empty!", null);
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
                    if(!is_numeric($platform))
                    {
    
                        try
                        {

                            $sql = "SELECT * FROM tbl_games WHERE score = :score AND platform LIKE CONCAT('%' , :platform , '%')";
        
                            $conn = $this -> connect();
                            $statement = $conn -> prepare($sql);
                            $statement -> bindValue(':score', $score, PDO::PARAM_INT);
                            $statement -> bindValue(':platform', $platform, PDO::PARAM_STR);
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
                        catch(PDOException $e)
                        {

                            $response = new ResponseModel(500, false, $e->getMessage(), null);
                            $response->send('json');
                            exit();

                        }

                    }
                    else
                    {

                        $response = new ResponseModel(400, true, ". Platform cannot be numeric!", null);
                        $response->send($output);
                        exit();

                    }

                }

            }

        }
        if($id == 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre == 'n_a' && $score == 'n_a' && $year != 'n_a' && $platform != 'n_a')
        {
            //year, platform

            if($year == '' || $platform == "")
            {

                $response = new ResponseModel(400, true, ". Year and platform cannot be empty!", null);
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
                    if(!is_numeric($platform))
                    {

                        try
                        {


                            $sql = "SELECT * FROM tbl_games WHERE year = :year AND platform LIKE CONCAT('%' , :platform , '%')";
        
                            $conn = $this -> connect();
                            $statement = $conn -> prepare($sql);
                            $statement -> bindValue(':year', $year, PDO::PARAM_INT);
                            $statement -> bindValue(':platform', $platform, PDO::PARAM_STR);
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
                        catch(PDOException $e)
                        {

                            $response = new ResponseModel(500, false, $e->getMessage(), null);
                            $response->send('json');
                            exit();

                        }    

                    }
                    else
                    {

                        $response = new ResponseModel(400, true, ". Platform cannot be numeric!", null);
                        $response->send($output);
                        exit();

                    }

                }

            }

        }
        if($id == 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre != 'n_a' && $score != 'n_a' && $year == 'n_a' && $platform == 'n_a')
        {
            //author, genre, score

            if($author == "" || $genre == "" || $score == "")
            {

                $response = new ResponseModel(400, true, ". Author, genre and score cannot be empty!", null);
                $response->send($output);
                exit();

            }
            else
            {

                if(is_numeric($author))
                {

                    $response = new ResponseModel(400, true, ". Author cannot be numeric!", null);
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

                        if(is_numeric($score))
                        {

                            try
                            {
    
                                $sql = "SELECT * FROM tbl_games WHERE author = :author AND genre = :genre AND score = :score";
        
                                $conn = $this -> connect();
                                $statement = $conn -> prepare($sql);
                                $statement -> bindValue(':author', $author, PDO::PARAM_STR);
                                $statement -> bindValue(':genre', $genre, PDO::PARAM_STR);
                                $statement -> bindValue(':score', $score, PDO::PARAM_INT);
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
                            catch(PDOException $e)
                            {
    
                                $response = new ResponseModel(500, false, $e->getMessage(), null);
                                $response->send('json');
                                exit();
    
                            }

                        }
                        else
                        {

                            $response = new ResponseModel(400, true, ". Score must be numeric!", null);
                            $response->send($output);
                            exit();                            

                        }

                    }

                }

            }

        }
        if($id == 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre != 'n_a' && $score == 'n_a' && $year != 'n_a' && $platform == 'n_a')
        {
            //author, genre, year

            if($author == '' || $genre == "" || $year == "")
            {

                $response = new ResponseModel(400, true, ". Author, genre and year cannot be empty!", null);
                $response->send($output);
                exit();

            }
            else
            {

                if(is_numeric($author))
                {

                    $response = new ResponseModel(400, true, ". Author cannot be numeric!", null);
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

                        if(is_numeric($year))
                        {

                            try
                            {

                                $sql = "SELECT * FROM tbl_games WHERE author = :author AND genre = :genre AND year = :year";
        
                                $conn = $this -> connect();
                                $statement = $conn -> prepare($sql);
                                $statement -> bindValue(':author', $author, PDO::PARAM_STR);
                                $statement -> bindValue(':genre', $genre, PDO::PARAM_STR);
                                $statement -> bindValue(':year', $year, PDO::PARAM_INT);
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
                            catch(PDOException $e)
                            {
    
                                $response = new ResponseModel(500, false, $e->getMessage(), null);
                                $response->send('json');
                                exit();
    
                            }

                        }
                        else
                        {

                            $response = new ResponseModel(400, true, ". Year must be numeric!", null);
                            $response->send($output);
                            exit();                            

                        }

                    }

                }

            }

        }
        if($id == 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre != 'n_a' && $score == 'n_a' && $year == 'n_a' && $platform != 'n_a')
        {
            //author, genre, platform

            if($author == "" || $genre == "" || $platform == "")
            {

                $response = new ResponseModel(400, true, ". Author, genre and platform cannot be empty!", null);
                $response->send($output);
                exit();

            }
            else
            {

                if(is_numeric($author))
                {

                    $response = new ResponseModel(400, true, ". Author cannot be numeric!", null);
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

                        if(!is_numeric($platform))
                        {

                            try
                            {
    
                                $sql = "SELECT * FROM tbl_games WHERE author = :author AND genre = :genre AND platform LIKE CONCAT('%', :platform, '%')";
        
                                $conn = $this -> connect();
                                $statement = $conn -> prepare($sql);
                                $statement -> bindValue(':author', $author, PDO::PARAM_STR);
                                $statement -> bindValue(':genre', $genre, PDO::PARAM_STR);
                                $statement -> bindValue(':platform', $platform, PDO::PARAM_STR);
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
                            catch(PDOException $e)
                            {
    
                                $response = new ResponseModel(500, false, $e->getMessage(), null);
                                $response->send('json');
                                exit();
    
                            }

                        }
                        else
                        {

                            $response = new ResponseModel(400, true, ". Platform cannot be numeric!", null);
                            $response->send($output);
                            exit();                            

                        }

                    }

                }

            }

        }
        if($id == 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre == 'n_a' && $score != 'n_a' && $year != 'n_a' && $platform == 'n_a')
        {

            //author, score, year

            if($author == '' || $score == "" || $year == "")
            {

                $response = new ResponseModel(400, true, ". Author, score and year cannot be empty!", null);
                $response->send($output);
                exit();

            }
            else
            {

                if(is_numeric($author))
                {

                    $response = new ResponseModel(400, true, ". Author cannot be numeric!", null);
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

                        if(is_numeric($year))
                        {

                            try
                            {
    
                                $sql = "SELECT * FROM tbl_games WHERE author = :author AND score = :score AND year = :year";
        
                                $conn = $this -> connect();
                                $statement = $conn -> prepare($sql);
                                $statement -> bindValue(':author', $author, PDO::PARAM_STR);
                                $statement -> bindValue(':score', $score, PDO::PARAM_INT);
                                $statement -> bindValue(':year', $year, PDO::PARAM_INT);
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
                            catch(PDOException $e)
                            {
    
                                $response = new ResponseModel(500, false, $e->getMessage(), null);
                                $response->send('json');
                                exit();
    
                            }

                        }
                        else
                        {

                            $response = new ResponseModel(400, true, ". Year must be numeric!", null);
                            $response->send($output);
                            exit();                            

                        }

                    }

                }

            }

        }
        if($id == 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre == 'n_a' && $score != 'n_a' && $year == 'n_a' && $platform != 'n_a')
        {

            //author, score, platform

            if($author == '' || $platform == "" || $score == "")
            {

                $response = new ResponseModel(400, true, ". Author, platform and score cannot be empty!", null);
                $response->send($output);
                exit();

            }
            else
            {

                if(is_numeric($author))
                {

                    $response = new ResponseModel(400, true, ". Author cannot be numeric!", null);
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

                        if(!is_numeric($platform))
                        {

                            try
                            {
    
                                $sql = "SELECT * FROM tbl_games WHERE author = :author AND score = :score AND platform LIKE CONCAT('%', :platform, '%')";
        
                                $conn = $this -> connect();
                                $statement = $conn -> prepare($sql);
                                $statement -> bindValue(':author', $author, PDO::PARAM_STR);
                                $statement -> bindValue(':score', $score, PDO::PARAM_INT);
                                $statement -> bindValue(':platform', $platform, PDO::PARAM_STR);
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
                            catch(PDOException $e)
                            {
    
                                $response = new ResponseModel(500, false, $e->getMessage(), null);
                                $response->send('json');
                                exit();
    
                            }

                        }
                        else
                        {

                            $response = new ResponseModel(400, true, ". Platform cannot be numeric!", null);
                            $response->send($output);
                            exit();                            

                        }

                    }

                }

            }

        }
        if($id == 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre == 'n_a' && $score == 'n_a' && $year != 'n_a' && $platform != 'n_a')
        {

            //author, year, platform


            if($author == '' || $year == "" || $platform == "")
            {

                $response = new ResponseModel(400, true, ". Author, year and platform cannot be empty!", null);
                $response->send($output);
                exit();

            }
            else
            {

                if(is_numeric($author))
                {

                    $response = new ResponseModel(400, true, ". Author cannot be numeric!", null);
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

                        if(!is_numeric($platform))
                        {

                            try
                            {
    
                                $sql = "SELECT * FROM tbl_games WHERE author = :author AND year = :year AND platform LIKE CONCAT('%', :platform, '%')";
        
                                $conn = $this -> connect();
                                $statement = $conn -> prepare($sql);
                                $statement -> bindValue(':author', $author, PDO::PARAM_STR);
                                $statement -> bindValue(':year', $year, PDO::PARAM_INT);
                                $statement -> bindValue(':platform', $platform, PDO::PARAM_STR);
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
                            catch(PDOException $e)
                            {
    
                                $response = new ResponseModel(500, false, $e->getMessage(), null);
                                $response->send('json');
                                exit();
    
                            }

                        

                        }
                        else
                        {

                            $response = new ResponseModel(400, true, ". Platform cannot be numeric!", null);
                            $response->send($output);
                            exit();                            

                        }

                    }

                }

            }


        }
        if($id == 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre != 'n_a' && $score != 'n_a' && $year != 'n_a' && $platform == 'n_a')
        {

            //genre, score, year

            if($genre == '' || $score == "" || $year == "")
            {

                $response = new ResponseModel(400, true, ". Genre, score and year cannot be empty!", null);
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

                        if(is_numeric($year))
                        {

                            try
                            {
    
                                $sql = "SELECT * FROM tbl_games WHERE genre = :genre AND score = :score AND year = :year";
        
                                $conn = $this -> connect();
                                $statement = $conn -> prepare($sql);
                                $statement -> bindValue(':genre', $genre, PDO::PARAM_STR);
                                $statement -> bindValue(':score', $score, PDO::PARAM_INT);
                                $statement -> bindValue(':year', $year, PDO::PARAM_INT);
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
                            catch(PDOException $e)
                            {
    
                                $response = new ResponseModel(500, false, $e->getMessage(), null);
                                $response->send('json');
                                exit();
    
                            }

                        }
                        else
                        {

                            $response = new ResponseModel(400, true, ". Year must be numeric!", null);
                            $response->send($output);
                            exit();                            

                        }

                    }

                }

            }

        }
        if($id == 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre != 'n_a' && $score == 'n_a' && $year != 'n_a' && $platform != 'n_a')
        {

            //genre, year, platform

            if($genre == '' || $year == "" || $platform == "")
            {

                $response = new ResponseModel(400, true, ". Genre, year and platform cannot be empty!", null);
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
                    if(!is_numeric($year))
                    {

                        $response = new ResponseModel(400, true, ". Year must be numeric!", null);
                        $response->send($output);
                        exit();

                    }
                    else
                    {

                        if(!is_numeric($platform))
                        {

                            try
                            {
    
                                $sql = "SELECT * FROM tbl_games WHERE genre = :genre AND year = :year AND platform LIKE CONCAT('%', :platform, '%')";
        
                                $conn = $this -> connect();
                                $statement = $conn -> prepare($sql);
                                $statement -> bindValue(':genre', $genre, PDO::PARAM_STR);
                                $statement -> bindValue(':year', $year, PDO::PARAM_INT);
                                $statement -> bindValue(':platform', $platform, PDO::PARAM_STR);
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
                                    $response->send();
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
                        else
                        {

                            $response = new ResponseModel(400, true, ". Platform cannot be numeric!", null);
                            $response->send($output);
                            exit();                            

                        }

                    }

                }

            }

        }
        if($id == 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre != 'n_a' && $score != 'n_a' && $year == 'n_a' && $platform != 'n_a')
        {

            //genre, score, platform

            if($genre == '' || $score == "" || $platform == "")
            {

                $response = new ResponseModel(400, true, ". Genre, score and platform cannot be empty!", null);
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

                        if(!is_numeric($platform))
                        {

                            try
                            {
    
                                $sql = "SELECT * FROM tbl_games WHERE genre = :genre AND score = :score AND platform LIKE CONCAT('%', :platform, '%')";
        
                                $conn = $this -> connect();
                                $statement = $conn -> prepare($sql);
                                $statement -> bindValue(':genre', $genre, PDO::PARAM_STR);
                                $statement -> bindValue(':score', $score, PDO::PARAM_INT);
                                $statement -> bindValue(':platform', $platform, PDO::PARAM_STR);
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
                            catch(PDOException $e)
                            {
    
                                $response = new ResponseModel(500, false, $e->getMessage(), null);
                                $response->send('json');
                                exit();
    
                            }

                        }
                        else
                        {

                            $response = new ResponseModel(400, true, ". Platform cannot be numeric!", null);
                            $response->send($output);
                            exit();                            

                        }

                    }

                }

            }

        }
        if($id == 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre == 'n_a' && $score != 'n_a' && $year != 'n_a' && $platform != 'n_a')
        {
        
            //score, year, platform

            if($score == '' || $year == "" || $platform == "")
            {

                $response = new ResponseModel(400, true, ". Score, year and platform cannot be empty!", null);
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

                        if(!is_numeric($platform))
                        {

                            try
                            {
    
                                $sql = "SELECT * FROM tbl_games WHERE score = :score AND year = :year AND platform LIKE CONCAT('%', :platform, '%')";
        
                                $conn = $this -> connect();
                                $statement = $conn -> prepare($sql);
                                $statement -> bindValue(':score', $score, PDO::PARAM_INT);
                                $statement -> bindValue(':year', $year, PDO::PARAM_INT);
                                $statement -> bindValue(':platform', $platform, PDO::PARAM_STR);
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
                            catch(PDOException $e)
                            {
    
                                $response = new ResponseModel(500, false, $e->getMessage(), null);
                                $response->send('json');
                                exit();
    
                            }

                        }
                        else
                        {

                            $response = new ResponseModel(400, true, ". Platform cannot be numeric!", null);
                            $response->send($output);
                            exit();                            

                        }

                    }

                }

            }

        }

        if($id == 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre != 'n_a' && $score != 'n_a' && $year != 'n_a' && $platform == 'n_a')
        {
        
            //author, genre, score, year

            if($author == "" || $genre == "" || $score == "" || $year == "")
            {

                $response = new ResponseModel(400, true, ". Author, genre, score and year cannot be empty!", null);
                $response->send($output);
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
                            if(is_numeric($year))
                            {

                                try
                                {
        
                                    $sql = "SELECT * FROM tbl_games WHERE author = :author AND genre = :genre AND score = :score AND year = :year";
        
                                    $conn = $this -> connect();
                                    $statement = $conn -> prepare($sql);
                                    $statement -> bindValue(':author', $author, PDO::PARAM_STR);
                                    $statement -> bindValue(':genre', $genre, PDO::PARAM_STR);
                                    $statement -> bindValue(':score', $score, PDO::PARAM_INT);
                                    $statement -> bindValue(':year', $year, PDO::PARAM_INT);
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
                                catch(PDOException $e)
                                {
        
                                    $response = new ResponseModel(500, false, $e->getMessage(), null);
                                    $response->send('json');
                                    exit();
        
                                }

                             

                            }
                            else
                            {

                                $response = new ResponseModel(400, true, ". Year must be numeric!", null);
                                $response->send($output);
                                exit();

                            }

                        }     

                    }

                }        

            }

        }
        if($id == 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre != 'n_a' && $score != 'n_a' && $year == 'n_a' && $platform != 'n_a')
        {
        
            //author, genre, score, platform

            if($author == "" || $genre == "" || $score == "" || $platform == "")
            {

                $response = new ResponseModel(400, true, ". Author, genre, score and platform cannot be empty!", null);
                $response->send($output);
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

                            if(is_numeric($platform))
                            {
    
                                $response = new ResponseModel(400, true, ". platform cannot be numeric!", null);
                                $response->send($output);
                                exit();
                            }
                            else
                            {
                                
                                try
                                {
        
                                    $sql = "SELECT * FROM tbl_games WHERE author = :author AND genre = :genre AND score = :score AND platform LIKE CONCAT('%', :platform, '%')";
        
                                    $conn = $this -> connect();
                                    $statement = $conn -> prepare($sql);
                                    $statement -> bindValue(':author', $author, PDO::PARAM_STR);
                                    $statement -> bindValue(':genre', $genre, PDO::PARAM_STR);
                                    $statement -> bindValue(':score', $score, PDO::PARAM_INT);
                                    $statement -> bindValue(':platform', $platform, PDO::PARAM_STR);
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
                                catch(PDOException $e)
                                {
        
                                    $response = new ResponseModel(500, false, $e->getMessage(), null);
                                    $response->send('json');
                                    exit();
        
                                }

                            }     
    
                        }

                    }

                }        

            }

        }
        if($id == 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre != 'n_a' && $score == 'n_a' && $year != 'n_a' && $platform != 'n_a')
        {
        
            //author, genre, year, platform

            if($author == "" || $genre == "" || $year == "" || $platform == "")
            {

                $response = new ResponseModel(400, true, ". Author, genre, year and platform cannot be empty!", null);
                $response->send($output);
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
                                
                                try
                                {
        
                                    $sql = "SELECT * FROM tbl_games WHERE author = :author AND genre = :genre AND year = :year AND platform LIKE CONCAT('%', :platform, '%')";
        
                                    $conn = $this -> connect();
                                    $statement = $conn -> prepare($sql);
                                    $statement -> bindValue(':author', $author, PDO::PARAM_STR);
                                    $statement -> bindValue(':genre', $genre, PDO::PARAM_STR);
                                    $statement -> bindValue(':year', $year, PDO::PARAM_INT);
                                    $statement -> bindValue(':platform', $platform, PDO::PARAM_STR);
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
                                catch(PDOException $e)
                                {
        
                                    $response = new ResponseModel(500, false, $e->getMessage(), null);
                                    $response->send('json');
                                    exit();
        
                                }
    
                            }     
    
                        }
     
                    }

                }        

            }

        }
        if($id == 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre == 'n_a' && $score != 'n_a' && $year != 'n_a' && $platform != 'n_a')
        {
        
            //author, score, year, platform

            if($author == "" || $score == "" || $year == "" || $platform == "")
            {

                $response = new ResponseModel(400, true, ". Author, score, year and platform cannot be empty!", null);
                $response->send($output);
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
                                
                                try
                                {
        
                                    $sql = "SELECT * FROM tbl_games WHERE author = :author AND score = :score AND year = :year AND platform LIKE CONCAT('%', :platform, '%')";
        
                                    $conn = $this -> connect();
                                    $statement = $conn -> prepare($sql);
                                    $statement -> bindValue(':author', $author, PDO::PARAM_STR);
                                    $statement -> bindValue(':score', $score, PDO::PARAM_INT);
                                    $statement -> bindValue(':year', $year, PDO::PARAM_INT);
                                    $statement -> bindValue(':platform', $platform, PDO::PARAM_STR);
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
                                catch(PDOException $e)
                                {
        
                                    $response = new ResponseModel(500, false, $e->getMessage(), null);
                                    $response->send('json');
                                    exit();
        
                                }

                            }     
    

                        }

                        
                    }

                }        

            }


        }
        if($id == 'n_a' && $name == 'n_a' && $author == 'n_a' && $genre != 'n_a' && $score != 'n_a' && $year != 'n_a' && $platform != 'n_a')
        {
        
            //genre, score, year, platform

            if($genre == "" || $score == "" || $year == "" || $platform == "")
            {

                $response = new ResponseModel(400, true, ". Genre, score, year and platform cannot be empty!", null);
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
                                
                                try
                                {
        

                                    $sql = "SELECT * FROM tbl_games WHERE genre = :genre AND score = :score AND year = :year AND platform LIKE CONCAT('%', :platform, '%')";
        
                                    $conn = $this -> connect();
                                    $statement = $conn -> prepare($sql);
                                    $statement -> bindValue(':genre', $genre, PDO::PARAM_STR);
                                    $statement -> bindValue(':score', $score, PDO::PARAM_INT);
                                    $statement -> bindValue(':year', $year, PDO::PARAM_INT);
                                    $statement -> bindValue(':platform', $platform, PDO::PARAM_STR);
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
                                catch(PDOException $e)
                                {
        
                                    $response = new ResponseModel(500, false, $e->getMessage(), null);
                                    $response->send('json');
                                    exit();
        
                                }
    
                            }     
    
                        }
                        
                    }

                }        

            }

        }
        if($id == 'n_a' && $name == 'n_a' && $author != 'n_a' && $genre != 'n_a' && $score != 'n_a' && $year != 'n_a' && $platform != 'n_a')
        {
        
            //author, genre, score, year, platform
            
            $year1 = $year;
            $score1 = $score;

            if($author == "" || $genre == "" || $score == "" || $year = "" || $platform == "")
            {

                $response = new ResponseModel(400, true, ". Author, genre, score, year and platform cannot be empty!", null);
                $response->send($output);
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

                            
                            if(!is_numeric($year1))
                            {
    
                                $response = new ResponseModel(400, true, ". Year must be numeric!", null);
                                $response->send($output);
                                exit();

                            }
                            else
                            {
                                if(is_numeric($platform))
                                {

                                    $response = new ResponseModel(400, true, ". Platform cannot be numeric!", null);
                                    $response->send($output);
                                    exit();

                                }
                                else
                                {

                                    try
                                    {
            

                                        $sql = "SELECT * FROM tbl_games WHERE author = :author AND genre = :genre AND score = :score AND year = :year AND platform LIKE CONCAT('%', :platform, '%')";
            
                                        $conn = $this -> connect();
                                        $statement = $conn -> prepare($sql);
                                        $statement -> bindValue(':author', $author, PDO::PARAM_STR);
                                        $statement -> bindValue(':genre', $genre, PDO::PARAM_STR);
                                        $statement -> bindValue(':score', $score, PDO::PARAM_INT);
                                        $statement -> bindValue(':year', $year1, PDO::PARAM_INT);
                                        $statement -> bindValue(':platform', $platform, PDO::PARAM_STR);
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
                                    catch(PDOException $e)
                                    {
            
                                        $response = new ResponseModel(500, false, $e->getMessage(), null);
                                        $response->send('json');
                                        exit();
            
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

            $response = new ResponseModel(400, true, ". Proccess failed!", null);
            $response->send($output);
            exit();

        }
             
    }

}