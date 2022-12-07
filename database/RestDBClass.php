<?php

namespace DataBase;

use Models\User;

class RestDBClass
{
    //private $allData;

    public function __construct()
    {
        //$allData = file_get_contents("https://gorest.co.in/public/v2/users");
    }

    public function getUserById($id) : User
    {
        $user = file_get_contents("https://gorest.co.in/public/v2/users/" . $id);
        $jsonArray = json_decode($user, true);
        $userObj = new User($jsonArray['email'], $jsonArray['name'], $jsonArray['gender'], $jsonArray['status'], "rest_api");
        $userObj->setId($id);
        return $userObj;
    }

    public function showAllUsers($offset, $size_page): array
    {
        $users = array();
        $allData = file_get_contents("https://gorest.co.in//public/v2/users?page=".($offset+1)."&per_page=".$size_page);
        $jsonArray = json_decode($allData, true);
        for($i=0; $i<count($jsonArray); $i++) {
            $users[] = new User($jsonArray[$i]["email"], $jsonArray[$i]["name"], $jsonArray[$i]["gender"], $jsonArray[$i]["status"], "rest_api");
            $users[count($users) - 1]->setId($jsonArray[$i]['id']);
        }
       return $users;
    }

    public function deleteUserById($id)
    {
        $user = file_get_contents("https://gorest.co.in/public/v2/users/" . $id);
        return json_decode($user, true);
    }

}