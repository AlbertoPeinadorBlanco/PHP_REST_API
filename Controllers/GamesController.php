<?php

namespace Controllers;
use Models\ReadGamesModel;
use Models\ReadModelInjector;
use Models\UpdateGamesModel;
use Models\UpdateModelInjector;
use Models\CreateGameModel;
use Models\CreateModelInjector;
use Models\DeleteGamesModel;
use Models\DeleteModelInjector;
use Models\PutGamesModel;
use Models\PutModelInjector;


//Class to serve as a bridge between the games related endpoints and the index page
class GamesController extends UserController
{

    //Class used to link the endpoint for reading games with the index page
    public function readData()
    {

        $read_games = new ReadGamesModel();
        $read_injector = new ReadModelInjector($read_games);


        $data = $this -> readParameters();
        
        $read_injector->dataRead($data);


    }


    //Class used to link the endpoint for patching games with the index page
    public function updateData()
    {

        $this -> setToken();

        $update_games = new UpdateGamesModel();
        $update_injector = new UpdateModelInjector($update_games);


        $data = $this -> readParameters();

        $update_injector -> dataUpdate($data);


    }

    //Class used to link the endpoint for updating (put) games with the index page
    public function putData()
    {

        $this -> setToken();

        $put_game = new PutGamesModel();
        $put_injector = new PutModelInjector($put_game);

        $data = $this -> readParameters();

        $put_injector -> dataPut($data);

    }

    //Class used to link the endpoint for deleting games with the index page
    public function deleteData()
    {

        $this -> setToken();

        $delete_games = new DeleteGamesModel();
        $update_injector = new DeleteModelInjector($delete_games);


        $data = $this -> readParameters();

        $update_injector -> dataDelete($data);

    }
    
    //Class used to link the endpoint for creating games with the index page
    public function createData()
    {

        $this -> setToken();

        $create_games = new CreateGameModel();
        $create_injector = new CreateModelInjector($create_games);


        $data = $this -> readParameters();

        $create_injector -> dataCreate($data);

    }

}