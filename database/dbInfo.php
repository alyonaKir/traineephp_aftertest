<?php
//return [
//    "host" => "localhost",
//    "user" => "root",
//    "password" => "mynewpassword",
//    "base" => 'Users',
//    "table" => 'user'
//];

return [
    "host" => $_ENV["MYSQL_HOST"],
    "user" => $_ENV["MYSQL_USER"],
    "password" => $_ENV["MYSQL_PASSWORD"],
    "base" => $_ENV["MYSQL_DATABASE"],
    "table" => "user"
];