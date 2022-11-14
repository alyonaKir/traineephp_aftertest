<?php

class UserController
{
    static function createUser(): void
    {
        //require "app/views/new.php";
        if ($_POST['btnAddNoForm'] != null) {
            require "app/views/new.php";
        }
    }

    static function newUser(): void
    {
        if (isset($_POST['btnAdd'])) {
            var_dump($_POST);
        }
    }
}

?>
