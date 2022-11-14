<?php
class UserController
{
    static function createUser(): void
    {
        if ($_GET['btnAddNoForm'] != null) {

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
