<?php

namespace Models;

use PDO;
use PDOException;


//Class to stablish a connection with the database
class DBModel
{

    protected $connection = null;

    //Function to stablish a connection with the database
    public function connect()
    {
        try
        {
            $env = parse_ini_file('../Inc/.env');
            $host = $env['HOST'];
            $user = $env['USER'];
            $pass = $env['PASS'];
            $conn = $this -> connection = new PDO($host, $user, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
            /*$host = "localhost";
            $database_name = "db_videogames";
            $dsn = "mysql:host=$host;dbname=$database_name";
    
            $conn = $this -> connection = new PDO($dsn, 'root', "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);*/
            
            return $conn;
    
        }
        catch(PDOException $e)
        {

            $response = new ResponseModel(500, false, $e->getMessage(), null);
            $response->send('json');
            exit();

        }

    }

}