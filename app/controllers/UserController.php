<?php
namespace App\controllers;

use DataBaseClass;
use User;

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
            $db = new DataBaseClass();
            $user = new User($_POST['email'], $_POST['name'], $_POST['gender'], $_POST['status'] == "active");
            $db->addInfo($user);
            require "app/views/mainPage.php";
        }
    }

    public function showAll(): void
    {
        require "app/views/showAll.php";
        $db = new DataBaseClass();
        $db->showInfoDB();
    }
    public function showByID($id): void
    {
        $id = 1;
        require "app/views/showAll.php";
        $db = new DataBaseClass();
        $db->showByID($id);
    }

    public function edit($id): void
    {
        echo 'edit';
        require "app/views/mainPage.php";
    }

    public function update(): void
    {
        if ($_POST['btnUpdate'] != null) {
            echo 'update';
            $db = new DataBaseClass();
            $db->UpdateDB();
        }
    }

    public function delete($id): void
    {
        $id=4;
        echo 'delete';
        $db = new DataBaseClass();
        $db->DeleteUser($id);
    }
}

?>
