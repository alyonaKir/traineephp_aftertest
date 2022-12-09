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
        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Bearer 9793ead2cc8ff849a69a00ffe49b8abc391f4de0398a79ce9bdccd8beef30cb6';

        $ch = curl_init('https://gorest.co.in/public/v2/users/'.$id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_exec($ch);
        curl_close($ch);
    }

    public function editUserById(User $user)
    {
        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Bearer 9793ead2cc8ff849a69a00ffe49b8abc391f4de0398a79ce9bdccd8beef30cb6';
        $data = array(
            "email" => $user->getEmail(),
            "name" => $user->getName(),
            "gender" => $user->getGender(),
            "status" => $user->isActive()
        );
        $ch = curl_init('https://gorest.co.in/public/v2/users/'.$user->getId());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_exec($ch);
        curl_close($ch);
    }

    public function addUser(User $user)
    {
        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Bearer 9793ead2cc8ff849a69a00ffe49b8abc391f4de0398a79ce9bdccd8beef30cb6';
        $data = array(
            "email" => $user->getEmail(),
            "name" => $user->getName(),
            "gender" => $user->getGender(),
            "status" => $user->isActive()
        );
        $ch = curl_init('https://gorest.co.in/public/v2/users/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_exec($ch);
        curl_close($ch);
    }

}