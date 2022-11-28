<?php
namespace App\controllers;
include 'vendor/autoload.php';

use Models\User;

class UserController
{
    private User $user;

    public function __construct()
    {
        if ($_POST['email'] != null) {
            $email = $this->test_input($_POST["email"]);
            $name = $this->test_input($_POST["name"]);
            $gender = $this->test_input($_POST["gender"]);
            $status = $this->test_input($_POST["status"]);
            $this->user = new User($email, $name, $gender, $status == "active" ? 1 : 0);
        } else {
            $this->user = new User('', '', '', 1);
        }
    }

    public function createUser(): void
    {
        if ($_POST['btnAdd'] != null) {
            require "app/views/new.php";
        }
        if ($_GET['btnMain'] != null) {
            header('Location: http://' . $_SERVER["HTTP_HOST"]);
            exit();
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
        $this->user->addUsertoDB();
        require "app/views/mainPage.php";
    }

    public function showAll(): void
    {
        require "app/views/showAll.php";
        if (isset($_GET['page'])) {
            $pageno = $_GET['page'];
        } else {
            $pageno = 1;
        }
        $size_page = 10;
        $offset = ($pageno - 1) * $size_page;
        $arrUsers = $this->user->showAllUsersFromDB();
        showAll($arrUsers, $pageno, $offset, $this->user->getNumberPages());

        if ($_GET['btnMain'] != null) {
            header('Location: http://' . $_SERVER["HTTP_HOST"]);
            exit();
        }

    }

    public function deleteChecked(){
        if($_POST['btnCheck']!=null) {
            for ($i = 0; $i < count($_POST['users']); $i++) {
                $this->user->deleteUserFromDB($_POST['users'][$i]);
            }
        }
        header('Location: http://' . $_SERVER["HTTP_HOST"] . '/users');
        exit();
    }
    private function getIdFromURL(): int
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $url = $url[0];
        $url = explode('/', $url);
        return $url[count($url) - 1];
    }

    public function showByID(): void
    {
        $id = $_POST['id'] ?? $this->getIdFromURL();
        if ($this->user->checkId($id)) {
            $user = $this->user->showUserByID($id);
            require 'app/views/showByID.php';
            show($user, $id);
        } else {
            header('Location: http://' . $_SERVER["HTTP_HOST"] . '/users');
            exit();
        }
    }

    public function edit(): void
    {
        if ($_POST['btnEdit'] != null) {
            $this->showByID();
        } else {
            $id = $this->getIdFromURL();
            $this->user->setId($id);
            $this->user->editUserInfoInDB($this->user);
            header('Location: http://' . $_SERVER["HTTP_HOST"] . '/users');
            exit();
        }
    }

    public function delete(): void
    {
        $id = $this->getIdFromURL();
        $this->user->deleteUserFromDB($id);

        header('Location: http://' . $_SERVER["HTTP_HOST"] . '/users');
        exit();
    }
}

?>
