<?php
include 'vendor/autoload.php';
use \App\controllers\AppController;
use \App\controllers\UserController;

class  App
{
    function run()
    {
        include 'bootstrap/Router.php';
        include 'models/User.php';
        include 'database/DataBaseClass.php';
        $id = 4;
        $router = new Router();
        $router->get("/",[(new AppController()), 'index']);
        $router->post("/",[(new AppController()), 'index']);
        $router->post("/users", [(new UserController()), 'showAll']);
        $router->post("/user/$id", [(new UserController()), 'showByID']);
        $router->get("/users/delete/$id", [(new UserController()), 'delete']);
        $router->get("/users/edit/$id", [(new UserController()), 'edit']);
        $router->post("/users/update", [(new UserController()), 'update']);
        $router->post("/users/new", [(new UserController()), 'newUser']);
        $router->post("/users/create", [(new UserController()), 'createUser']);
        $router->run();
        $router->addNotFoundHandler(function () {
            echo 'not found';
        });
    }
}

?>
