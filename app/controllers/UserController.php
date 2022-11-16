<?php
namespace App\controllers;
class UserController
{
    public function createUser(): void
    {
        if ($_POST['btnAdd'] != null) {
            require "app/views/new.php";
        }
    }

    public function newUser(): void
    {
        if (isset($_POST['btnAdd'])) {
            var_dump($_POST);
        }
        require "app/views/mainPage.php";
    }

    public function show($id): void
    {
        if ($_POST['btnShow'] != null) {
            echo 'show';
            require "app/views/mainPage.php";
        }
    }

    public function edit($id): void
    {
        echo 'edit';
        require "app/views/mainPage.php";
    }

    public function update(): void
    {
        echo 'update';
        if ($_POST['btnUpdate'] != null) {
            echo 'update';
            require "app/views/mainPage.php";
        }
    }

    public function delete($id): void
    {
        echo 'delete';
    }
}

?>
