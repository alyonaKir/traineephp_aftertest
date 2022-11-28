<?php

use Models\User;

$users = [new User("winter@game.com", "John", "male", 1),
    new User("spring@site.com", "Mary", "female", 1),
    new User("summer@hot.com", "Brenden", "male", 0),
    new User("autum@sad.com", "Karol", "female", 0)
];

for ($i = 0; $i < count($users); $i++) {
    $users[$i]->addUsertoDB();
}
?>