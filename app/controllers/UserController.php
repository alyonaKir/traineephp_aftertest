<?php

class UserController
{
    public function createUser(): void
    {
        //require "app/views/new.php";
        if ($_POST['btnAddNoForm'] != null) {
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
        echo 'show';
    }

    public function edit($id): void
    {
        echo 'edit';
    }

    public function update(): void
    {
        echo 'update';
    }

    public function delete($id): void
    {
        echo 'delete';
    }
}

?>
