<?php
class  App
{
    static String $title;
    function run()
    {
        include 'bootstrap/Router.php';
        include 'app/controllers/AppController.php';
        include 'app/controllers/UserController.php';
        $router = new Router();
       // $router->get("/",[AppController::class, 'index']);
        $router->get("/", function (){
            $obj = new AppController();
            $obj->index();
        });
        $router->post("/users/new", function (){
            $obj = new UserController();
            $obj->newUser();
        });
        $router->post("/users/create", function (){
            $obj = new UserController();
            $obj->createUser();
        });
        $router->run();
        $router->addNotFoundHandler(function () {
            echo 'not found';
        });
    }
}

?>
