<?php

namespace DataBase;

use Models\User;

class RestDBClass
{
    private static $instance = null;
    private $dataCount;
    private $lastUser;
    private $headers = array();

    public function __construct()
    {
        $this->headers[] = 'Accept: application/json';
        $this->headers[] = 'Content-Type: application/json';
        $this->headers[] = 'Authorization: Bearer 9793ead2cc8ff849a69a00ffe49b8abc391f4de0398a79ce9bdccd8beef30cb6';
    }

    private function __clone(){}

    public function __wakeup(){}

    public static function getInstance(): RestDBClass
    {
        if (self::$instance != null) {
            return self::$instance;
        }
        return new self();
    }


    public function getUserById($id): User
    {
        $ch = curl_init('https://gorest.co.in/public/v2/users/' . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        $user = curl_exec($ch);
        curl_close($ch);

        $jsonArray = json_decode($user, true);
        $userObj = new User($jsonArray['email'], $jsonArray['name'], $jsonArray['gender'], $jsonArray['status'], "rest_api");
        $userObj->setId($id);
        return $userObj;
    }


    public function showAllUsers($pageno, $size_page): array
    {
        $users = array();
        $ch = curl_init('https://gorest.co.in/public/v2/users?page=' . $pageno . '&per_page=' . $size_page);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        $allData = curl_exec($ch);
        curl_close($ch);
        $jsonArray = json_decode($allData, true);

        for ($i = 0; $i < count($jsonArray); $i++) {
            $users[] = new User($jsonArray[$i]["email"], $jsonArray[$i]["name"], $jsonArray[$i]["gender"], $jsonArray[$i]["status"], "rest_api");
            $users[count($users) - 1]->setId($jsonArray[$i]['id']);
            $this->lastUser = $jsonArray[$i]['id'];
        }
        return $users;
    }

    public function deleteUserById($id)
    {

        $ch = curl_init('https://gorest.co.in/public/v2/users/' . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_exec($ch);
        curl_close($ch);
    }

    public function editUserById(User $user): bool
    {
        $data = array(
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'status' => "active"
        );
        $data_json = json_encode($data);
        try {
            $curl = curl_init('https://gorest.co.in/public/v2/users/' . $user->getId());
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_json);

            curl_exec($curl);
            curl_close($curl);
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }

    public function addUser(User $user): void
    {
        $data = array(
            "name" => $user->getName(),
            "gender" => $user->getGender(),
            "email" => $user->getEmail(),
            "status" => $user->isActive() ? "active" : "inactive"
        );
        $ch1 = curl_init('https://gorest.co.in/public/v2/users');
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch1, CURLOPT_HTTPHEADER, $this->headers);
        curl_exec($ch1);
        curl_close($ch1);
    }

    public function countPages(): int
    {
        $headers = get_headers('https://gorest.co.in/public/v2/users');
        $str = $headers[17];
        $count = "";
        for ($i = 20; $i < strlen($str); $i++) {
            $count .= $str[$i];
        }
        return $count;
    }

    public function getLastUser() : int{
        $users = array();
        $ch = curl_init('https://gorest.co.in/public/v2/users');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        $allData = curl_exec($ch);
        curl_close($ch);
        $jsonArray = json_decode($allData, true);
        
        return $jsonArray[0]['id'];
    }

}