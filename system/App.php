<?php
include 'vendor/autoload.php';

class  App
{
    static String $title;
    function run()
    {
        include 'bootstrap/Router.php';
        $id = 4;

        $router = new Router();
        $router->get("/",[(new \App\controllers\AppController()), 'index']);
        $router->get("/users", function(){
            echo 'users';
        });
        $router->get("/user/$id", [(new \App\controllers\UserController()), 'show']);
        $router->get("/users/$id", [(new \App\controllers\UserController()), 'delete']);
        $router->get("/users/edit/$id", [(new \App\controllers\UserController()), 'edit']);
        $router->get("/users/update", [(new \App\controllers\UserController()), 'update']);
        $router->post("/users/new", [(new \App\controllers\UserController()), 'newUser']);
        $router->post("/users/create", [(new \App\controllers\UserController()), 'createUser']);
        $router->run();
        $router->addNotFoundHandler(function () {
            echo 'not found';
        });
    }
}

?>
