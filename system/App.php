<?php
class  App
{
    static String $title;
    function run()
    {
        include 'bootstrap/Router.php';
        //include 'vendor/autoload.php';
        include 'app/controllers/AppController.php';
        include 'app/controllers/UserController.php';
        $id = 4;
        $router = new Router();
        $router->get("/",[(new AppController()), 'index']);
        $router->get("/users", function(){
            echo 'users';
        });
        $router->get("/user/$id", [(new UserController()), 'show']);
        $router->get("/users/$id", [(new UserController()), 'delete']);
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
