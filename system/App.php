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
        $router = new Router();
        $router->get("",[new AppController(), 'index']);
        $router->post("",[new AppController(), 'index']);
        $router->post("/users", [new UserController(), 'showAll']);
        $router->post("/user", [new UserController(), 'chooseByID']);
        $router->post("/user/[0-9]+", [new UserController(), 'showByID']);
        $router->get("/user/[0-9]+", [new UserController(), 'showByID']);
        $router->post("/users/delete/[0-9]+", [new UserController(), 'delete']);
        $router->post("/users/edit/[0-9]+", [new UserController(), 'edit']);
        $router->get("/users/delete/[0-9]+", [new UserController(), 'delete']);
        $router->get("/users/edit/[0-9]+", [new UserController(), 'edit']);
        $router->post("/users/new", [new UserController(), 'newUser']);
        $router->post("/users/create", [new UserController(), 'createUser']);
        $router->run();
    }
}

?>
