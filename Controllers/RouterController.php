<?php


namespace Controllers;

use Controllers\AuthenticationController;
use Controllers\AuthenticationInjector;
use Models\RoutingErrorsModel;
use Models\RoutingErrorModelInjector;

require_once '../jwt/JWTExceptionWithPayloadInterface.php';
require_once '../jwt/SignatureInvalidException.php';


//This class controls the paths available
class RouterController implements IRouterController
{

    //Function to route the requests to the specified section
    public function route()
    {

        $error = new RoutingErrorsModel();
        $error_injector = new RoutingErrorModelInjector($error);


        $uri = parse_url($_SERVER['REQUEST_URI'])['path'];

        $uri2 = explode('/', $uri);
      
        /*$routes = [

            //'/' => '/Public/index.php',
            '/users' => '/Controllers/UserController',
            '/public/games' => '/Controllers/GamesController',
            '/public/authentication' => '/Controllers/AuthenticationController'
            

        ];*/
        

        
        if(array_key_exists(5, $uri2))
        {
            
            if($uri2[5] == 'users')
            {

                $user_controller = new UserController();


                if($_SERVER['REQUEST_METHOD'] === 'GET')
                {

                    $read_users_injector = new ReadControllerInjector($user_controller);

                    $read_users_injector -> dataRead();


                }
                if($_SERVER['REQUEST_METHOD'] === 'POST')
                {

                    $create_users_injector = new CreateControllerInjector($user_controller);

                    $create_users_injector -> dataCreate();

                }
                if($_SERVER['REQUEST_METHOD'] === 'PATCH')
                {

                    $update_users_injector = new UpdateControllerInjector($user_controller);

                    $update_users_injector -> dataUpdate();

                }
                if($_SERVER['REQUEST_METHOD'] === 'DELETE')
                {

                    $delete_users_injector = new DeleteControllerInjector($user_controller);

                    $delete_users_injector -> dataDelete();

                }
                if($_SERVER['REQUEST_METHOD'] === 'PUT')
                {

                    $put_user_injector = new PutControllerInjector($user_controller);

                    $put_user_injector -> dataPut();

                }
                else
                {
              
                    $error_injector -> errorRouting();

                }

            }
            if($uri2[5] == 'games')
            {

                $game_controller = new GamesController();


                if($_SERVER['REQUEST_METHOD'] === 'GET')
                {

                    
                    $read_games_injector = new ReadControllerInjector($game_controller);

                    $read_games_injector -> dataRead();

                }
                if($_SERVER['REQUEST_METHOD'] === 'POST')
                {

                    $create_games_injector = new CreateControllerInjector($game_controller);

                    $create_games_injector -> dataCreate();

                }
                if($_SERVER['REQUEST_METHOD'] === 'PATCH')
                {

                    $update_games_injector = new UpdateControllerInjector($game_controller);

                    $update_games_injector -> dataUpdate();

                }
                if($_SERVER['REQUEST_METHOD'] === 'DELETE')
                {

                    $delete_games_injector = new DeleteControllerInjector($game_controller);

                    $delete_games_injector -> dataDelete();

                }
                if($_SERVER['REQUEST_METHOD'] === 'PUT')
                {

                    $put_game_injector = new PutControllerInjector($game_controller);

                    $put_game_injector -> dataPut();

                }
                else
                {
        
                    $error_injector -> errorRouting();
        
                }

            }
            if($uri2[5] == 'authentication')
            {

                $auth = new AuthenticationController();
                $auth_injector = new AuthenticationInjector($auth);

                $auth_injector -> authenticate();

            }
            if($uri2[5] == 'authenticateadmin')
            {

                $auth = new AuthenticationController();
                $auth_injector = new AuthenticationAdminInjector($auth);

                $auth_injector -> authenticate();

            }
            else
            {
    
                $error_injector -> errorRouting();
    
            }

        }
        else
        {

            $error_injector -> errorRouting();

        }

    }
 
}