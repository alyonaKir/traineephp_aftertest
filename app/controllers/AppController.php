<?php
function index(){
    include('bootstrap/routing.php');
    $url = key($_GET);
    echo $url;
    $r = new Router();
    $r->addRoute($url, "app/views/mainPage.html");
    $r->route($url);
}
?>
