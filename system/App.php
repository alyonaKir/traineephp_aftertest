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
        $router->get("/", AppController::index());
        $router->get("/users/new", UserController::newUser());
        $router->post("/users/create", UserController::createUser());
        $router->run();
        $router->addNotFoundHandler(function () {
            echo 'not found';
        });
    }
}

?>
