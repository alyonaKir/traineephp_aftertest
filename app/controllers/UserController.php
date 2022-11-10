<?php

function createUser(){
 if($_GET['btnAddNoForm']!=null){
     require "app/views/new.php";
 }
}
function newUser(){
    if(isset($_POST['btnAdd'])){
        var_dump($_POST);
    }
}
?>
