<?php
namespace App\controllers;

use DataBaseClass;
use User;

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
        $this->user->showAllUsers();
    }

    public function showByID($id): void
    {
        //$id = 1;
        echo $id;
        require "app/views/showByID.php";
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
        $id = 3;
        echo 'delete';
        $db = new DataBaseClass();
        $db->DeleteUser($id);
    }
}

?>
