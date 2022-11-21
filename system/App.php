<?php
namespace System;
include 'vendor/autoload.php';
use App\controllers\AppController;
use App\controllers\UserController;
use Bootstrap\Router;

class  App
{
    public function run() : void
    {
        //$id = 4;
        $router = new Router();
        $router->get("/",[(new AppController()), 'index']);
        $router->post("/",[(new AppController()), 'index']);
        $router->post("/users", [(new UserController()), 'showAll']);
        $router->post("/user", [(new UserController()), 'showByID']);
        $router->get("/user", [(new UserController()), 'showByID']);
        $router->post("/users/delete", [(new UserController()), 'delete']);
        $router->post("/users/edit", [(new UserController()), 'edit']);
        $router->post("/users/update", [(new UserController()), 'update']);
        $router->post("/users/new", [(new UserController()), 'newUser']);
        $router->post("/users/create", [(new UserController()), 'createUser']);
        $router->run();
        $router->addNotFoundHandler(function (){
            echo 'not found';
        });
    }
}

?>
