<?php
namespace App\controllers;
use Models\User;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class AppController
{
    public function index(): void
    {
        $loader = new FilesystemLoader(__DIR__.'/../views');
        $twig = new Environment($loader);
        echo $twig->render('mainPage.twig', [
            'addForm' => "http://".$_SERVER["HTTP_HOST"]."/users/create",
            'showForm' => "http://".$_SERVER["HTTP_HOST"]."/users",
            'mainPage'=> "http://".$_SERVER["HTTP_HOST"],
            'db'=>$_POST['database']
        ]);
        $ourData = file_get_contents("https://gorest.co.in/public/v2/users");
      //User::$dbType = $_POST['database'];
    }
}
?>
