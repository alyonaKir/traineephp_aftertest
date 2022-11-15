<?php

class UserController
{
    public function createUser(): void
    {
        //require "app/views/new.php";
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
        }
    }

    public function edit($id): void
    {
        echo 'edit';
    }

    public function update(): void
    {
        if ($_POST['btnUpdate'] != null) {
            echo 'update';
        }
    }

    public function delete($id): void
    {
        echo 'delete';
    }
}

?>
