<?php
namespace App\controllers;
include 'vendor/autoload.php';

use Models\User;

class UserController
{

    private User $user;

    public function __construct()
    {
        $this->user = new User('', '', '', 1);
    }

    public function createUser(): void
    {
        if ($_POST['btnAdd'] != null) {
            require "app/views/new.php";
        }
    }

    private function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function newUser(): void
    {
        if (isset($_POST['btnAdd'])) {
            $email = $this->test_input($_POST["email"]);
            $name = $this->test_input($_POST["name"]);
            $gender = $this->test_input($_POST["gender"]);
            $status = $this->test_input($_POST["status"]);
            $this->user = new User($_POST['email'], $_POST['name'], $_POST['gender'], $_POST['status'] == "active");
            $this->user->addUsertoDB();
            require "app/views/mainPage.php";
        }
    }

    public function showAll(): void
    {
        require "app/views/showAll.php";
        $this->user->showAllUsersFromDB();
    }

    private function getIdFromURL(): int
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $url = $url[0];
        $url = explode('/', $url);
        return $url[count($url) - 1];
    }

    public function showByID($id): void
    {
        $id = $this->getIdFromURL();
        $this->user->showUserByID($id);
        require "app/views/showByID.php";
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
            $this->user->updateUsers();
        }
    }

    public function delete($id): void
    {
        $id = 3;
        echo 'delete';
        $this->user->deleteUserFromDB($id);
    }
}

?>
