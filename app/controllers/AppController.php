<?php
namespace App\controllers;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class AppController
{
    public function index(): void
    {
        ini_set('display_startup_errors', 1);
        ini_set('display_errors', 1);
        error_reporting(-1);
        $loader = new FilesystemLoader(__DIR__.'/../views');
        $twig = new Environment($loader);
        $tmp = "http://".$_SERVER["HTTP_HOST"]."/users/create";
        $tmp1 = "http://".$_SERVER["HTTP_HOST"]."/users";
        echo $twig->render('mainPage.twig', ['addForm' => $tmp, 'showForm' => $tmp1]);

        //require "app/views/mainPage.php";
    }
}
?>
