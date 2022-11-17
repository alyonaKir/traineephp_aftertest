<?php
namespace App\controllers;

class AppController
{
    public function index(): void
    {
        require "app/views/mainPage.php";
    }
}
?>
