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
//        ini_set ('display_errors', 'on');
//        ini_set ('log_errors', 'on');
//        ini_set ('display_startup_errors', 'on');
//        ini_set ('error_reporting', E_ALL);


        DataBaseClass::checkDB();
        //include 'database/testDB.php';
        $router = new Router();
        $router->get("",[new AppController(), 'index']);
        $router->post("",[new AppController(), 'index']);
        $router->post("/users", [new UserController(), 'showAll']);
        $router->get("/users", [new UserController(), 'showAll']);
        $router->post("/user/[0-9]+", [new UserController(), 'showByID']);
        $router->get("/user/[0-9]+", [new UserController(), 'showByID']);
        $router->post("/user/delete/[0-9]+", [new UserController(), 'delete']);

        //$router->delete("https://gorest.co.in/public/v2/users/[0-9]+", function (){ header('Location: http://' . $_SERVER["HTTP_HOST"]);
            //exit();});

        $router->post("/user/edit/[0-9]+", [new UserController(), 'edit']);
        $router->get("/user/delete/[0-9]+", [new UserController(), 'delete']);
        $router->get("/user/edit/[0-9]+", [new UserController(), 'edit']);
        $router->post("/users/new", [new UserController(), 'newUser']);
        $router->post("/users/create", [new UserController(), 'createUser']);
        $router->get("/users/create", [new UserController(), 'createUser']);
        $router->post("/users/deleteChecked", [new UserController(), 'deleteChecked']);
//        $router->post("/users/choose", [new AppController(), 'chooseDB']);
        $router->run();

    }
}

?>
