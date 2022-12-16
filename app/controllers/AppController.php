<?php
namespace App\controllers;
use DataBase\RestDBClass;
use Models\User;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

include 'system/curl.php';
session_start();
class AppController
{
    public function index(): void
    {
//        ini_set ('display_errors', 'on');
        if(isset($_POST['database'])) {
            $_SESSION['dbType'] = $_POST['database'];
        }
        else if(!isset($_SESSION['dbType'])) {
            $_SESSION['dbType'] = "db";
        }
        $loader = new FilesystemLoader(__DIR__.'/../views');
        $twig = new Environment($loader);
        echo $twig->render('mainPage.twig', [
            'addForm' => "http://".$_SERVER["HTTP_HOST"]."/users/create",
            'showForm' => "http://".$_SERVER["HTTP_HOST"]."/users",
            'mainPage'=> "http://".$_SERVER["HTTP_HOST"],
            'db'=>$_SESSION['dbType']
        ]);
    }
}
?>
