<?php
include 'vendor/autoload.php';
use \App\controllers\AppController;
use \App\controllers\UserController;
class  App
{
    function run()
    {
        include 'bootstrap/Router.php';
        $id = 4;
        $router = new Router();
        $router->get("/",[(new AppController()), 'index']);
        $router->get("/users", [(new UserController()), 'show']);
        $router->get("/user/$id", [(new UserController()), 'show']);
        $router->get("/users/delete/$id", [(new UserController()), 'delete']);
        $router->get("/users/edit/$id", [(new UserController()), 'edit']);
        $router->get("/users/update", [(new UserController()), 'update']);
        $router->post("/users/new", [(new UserController()), 'newUser']);
        $router->post("/users/create", [(new UserController()), 'createUser']);
        $router->run();
        $router->addNotFoundHandler(function () {
            echo 'not found';
        });
    }
}

?>
