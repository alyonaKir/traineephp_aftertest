<?php

namespace DataBase;

use Models\User;

class RestDBClass
{
    private $dataCount;

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


    public function showAllUsers($pageno, $size_page): array
    {
        $users = array();

        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Bearer 9793ead2cc8ff849a69a00ffe49b8abc391f4de0398a79ce9bdccd8beef30cb6';


        $ch = curl_init('https://gorest.co.in/public/v2/users?page='.$pageno.'&per_page='.$size_page);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $allData = curl_exec($ch);
        curl_close($ch);
        $jsonArray = json_decode($allData, true);

        echo count($jsonArray);
        for($i=0; $i < count($jsonArray); $i++) {
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

    public function editUserById(User $user):void
    {
        $data = array(
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'status' =>"active"
        );
        $data_json =  json_encode($data);
        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Content-Length: ' . strlen($data_json);
        $headers[] = 'Authorization: Bearer 3ed62aaac5b04a7c41a8003628aded79288ebd8ea58eaf42dbc5323b9aba57be';

        $curl = curl_init('https://gorest.co.in/public/v2/users/'.$user->getId());
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_json);

        curl_exec($curl);
        curl_close($curl);
    }

    public function addUser(User $user): void
    {
        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Bearer 9793ead2cc8ff849a69a00ffe49b8abc391f4de0398a79ce9bdccd8beef30cb6';
        $data = array(
            "name" => $user->getName(),
            "gender" => $user->getGender(),
            "email" => $user->getEmail(),
            "status" => $user->isActive()?"active":"inactive"
        );
        $ch1 = curl_init('https://gorest.co.in/public/v2/users');
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
        curl_exec($ch1);
        curl_close($ch1);
    }

}