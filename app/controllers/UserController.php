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
    }
}

?>
