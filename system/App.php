<?php
namespace System;
include 'vendor/autoload.php';
use App\controllers\AppController;
use App\controllers\UserController;
use Bootstrap\Router;
use DataBase\DataBaseClass;

class  App
{
    public function run() : void
    {
        $db = new DataBaseClass();
        $db->checkDB();
        $router = new Router();
        $router->get("",[new AppController(), 'index']);
//        $router->post("",[new AppController(), 'index']);
        $router->post("/users", [new UserController(), 'showAll']);
        $router->get("/users", [new UserController(), 'showAll']);
        $router->post("/user/[0-9]+", [new UserController(), 'showByID']);
        $router->get("/user/[0-9]+", [new UserController(), 'showByID']);
        $router->post("/user/delete/[0-9]+", [new UserController(), 'delete']);
        $router->post("/user/edit/[0-9]+", [new UserController(), 'edit']);
        $router->get("/user/delete/[0-9]+", [new UserController(), 'delete']);
        $router->get("/user/edit/[0-9]+", [new UserController(), 'edit']);
        $router->post("/users/new", [new UserController(), 'newUser']);
        $router->post("/users/create", [new UserController(), 'createUser']);
        $router->get("/users/create", [new UserController(), 'createUser']);
        $router->run();
    }
}

?>
