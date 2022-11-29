<?php
namespace App\controllers;
include 'vendor/autoload.php';
use Twig\Loader\FilesystemLoader;

class AppController
{
    public function index(): void
    {
        $loader = new FilesystemLoader('/app/views');
        require "app/views/mainPage.php";
    }
}
?>
