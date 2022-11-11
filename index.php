<?php
include 'bootstrap/Router.php';
include 'app/controllers/AppController.php';
include 'app/controllers/UserController.php';
$router = new Router();
$router->get("/", index());
$router->get("/users/new", newUser());
$router->post("/users/create", createUser());
$router->run();
$router->addNotFoundHandler(function (){
    echo 'not found';
});
//include 'system/App.php';
//(new App())->run();



?>
