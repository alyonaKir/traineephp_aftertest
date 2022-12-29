<?php
include 'vendor/autoload.php';
use System\App;
session_start();
(new App())->run();
?>
