<?php
class  App{
     function run(){
         include('bootstrap/routing.php');
         $url = key($_GET);
         echo $url;
         $r = new Router();
         $r->addRoute($url, "app/views/mainPage.html");
         $r->route($url);
//         if(isset($_GET['btnAddNoForm'])) {
//             $r->addRoute($url, "new.html");
//             $r->route($url);
//         }
//         else {
//             $r->addRoute($url, "mainPage.html");
//             $r->route($url);
//         }
         echo "hi";
         include ('app/controllers/UserController.php');
         createUser();

        //TODO run
    }
}
?>


