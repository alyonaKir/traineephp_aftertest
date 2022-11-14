<?php

function createUser(): void
{
    if ($_GET['btnAddNoForm'] != null) {

        require "app/views/new.php";

    }
}

function newUser(): void
{
    if (isset($_POST['btnAdd'])) {
        var_dump($_POST);
    }
}

?>
