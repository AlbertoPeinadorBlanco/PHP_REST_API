<?php

namespace Controllers;

use Models\ReadUserModel;
use Models\ReadModelInjector;
use Models\CreateUserModel;
use Models\CreateModelInjector;
use Models\UpdateUserModel;
use Models\UpdateModelInjector;
use Models\DeleteUserModel;
use Models\DeleteModelInjector;
use Models\PutUserModel;
use Models\PutModelInjector;



//Class to serve as a bridge between the users related endpoints and the index page
class UserController extends BaseController implements IReadController, ICreateController, IDeleteController, IUpdateController, IPutController
{

    //Class used to link the endpoint for reading users with the index page
    public function readData()
    {

        $this -> setTokenAdmin();

        $read_user = new ReadUserModel();
        $read_injector = new ReadModelInjector($read_user); 
        $data = $this -> readParameters();
        $read_injector ->dataRead($data);
        
    }

    //Class used to link the endpoint for creating users with the index page
    public function createData()
    {

        $this -> setTokenAdmin();

        $create_user = new CreateUserModel();
        $create_injector = new CreateModelInjector($create_user);
        
        $data = $this -> readParameters();
        
        $create_injector -> dataCreate($data);

    }

    //Class used to link the endpoint for deleting users with the index page
    public function deleteData()
    {

        $this -> setTokenAdmin();

        $delete_user = new DeleteUserModel();
        $delete_injector = new DeleteModelInjector($delete_user);

        $data = $this -> readParameters();

        $delete_injector -> dataDelete($data);

    }

    //Class used to link the endpoint for updating (put) users with the index page
    public function putData()
    {

        $this -> setTokenAdmin();

        $put_user = new PutUserModel();
        $put_injector = new PutModelInjector($put_user);

        $data = $this -> readParameters();

        $put_injector -> dataPut($data);

    }

    //Class used to link the endpoint for patching users with the index page
    public function updateData()
    {

        $this -> setTokenAdmin();

        $update_user = new UpdateUserModel();
        $update_injector = new UpdateModelInjector($update_user);

        $data = $this -> readParameters();

        $update_injector -> dataUpdate($data);

    }

}