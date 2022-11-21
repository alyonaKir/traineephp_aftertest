<?php

namespace DataBase;
include 'vendor/autoload.php';

use Models\User;
use PDO;

class DataBaseClass
{
    private $db;
    private $dbinfo;

    /**
     * connect to the db, db_info input
     */
    public function __construct()
    {
        $this->dbinfo = require 'dbInfo.php';
        $this->db = new PDO('mysql:host=' . $this->dbinfo['host'] . ';dbname=' . $this->dbinfo['base'], $this->dbinfo['user'], $this->dbinfo['password']);
        //$this->db = $this->createConnection();
    }

    private function createConnection()
    {
        $conn = new \mysqli($this->dbinfo['host'], $this->dbinfo['user'], $this->dbinfo['password'], $this->dbinfo['base']);
        if ($conn->connect_error) {
            die("Ошибка: " . $conn->connect_error);
        }
        return $conn;
    }

    /**
     * added user into DataBase
     *
     * @param User $user
     * @return void
     */
    public function addInfo(User $user)
    {
        $this->user = $user;
        $email = $user->getEmail();
        $name = $user->getName();
        $gender = $user->getGender();
        $status = $user->isActive();
        $log = "";
        $db_table = $this->dbinfo['table'];
        try {

            $this->db->exec("set names utf8");
            $data = array('email' => $email, 'name' => $name, 'gender' => $gender, 'status' => $status);
            $query = ($this->db)->prepare("INSERT INTO $db_table(email, name, gender, active) values(:email, :name, :gender, :status)");
            $query->execute($data);
            $result = true;
        } catch (\PDOException $e) {
            $log = "Error: " . $e->getMessage() . "<br/>";
        }

        if ($result) {
            $log = 'We added information into database!';
        }
        file_put_contents(__DIR__ . 'DB_log.log', $log, 0);
    }


    /**
     * show all database contains
     *
     * @return void
     */
    public function showInfoDB(): array
    {
        $users = array();
        $conn = $this->createConnection();
        $db_table = $this->dbinfo['table'];
        $sql = "SELECT * FROM $db_table";
        if ($result = $conn->query($sql)) {
            $rowsCount = $result->num_rows; // количество полученных строк

            //echo '<pre>';
            foreach ($result as $row) {
                $users[] = new User($row["email"], $row["name"], $row["gender"], $row["active"]);
            }
            $result->free();
        } else {
            echo "Ошибка: " . $conn->error;
        }
        $conn->close();
        return $users;
    }

    public function updateDB()
    {
        $conn = $this->createConnection();
        $db_table = $this->dbinfo['table'];
        $sql = "SELECT * FROM $db_table ORDER BY NEWID()";
        $conn->query($sql);
        if ($conn->query($sql) === TRUE) {
            echo "Successful query";
        } else {
            echo "Error query: " . $conn->error;
        }

        $conn->close();
    }

    public function deleteUser($id)
    {
        $conn = $this->createConnection();
        $db_table = $this->dbinfo['table'];
        $sql = "DELETE FROM $db_table WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }

        $conn->close();
    }

    public function showByID($id): User
    {
        $conn = $this->createConnection();
        $db_table = $this->dbinfo['table'];
        $sql = "SELECT * FROM $db_table WHERE id=$id";
        if ($result = $conn->query($sql)) {
            foreach ($result as $row) {
                $user = new User($row["email"], $row["name"], $row["gender"], $row["active"]);
            }
            $result->free();
        } else {
            echo "Ошибка: " . $conn->error;
        }
        $conn->close();
        return $user;

    }

    public function editUser($id, $user)
    {
        $conn = $this->createConnection();
        $db_table = $this->dbinfo['table'];

        $userEmail = $conn->real_escape_string($user->getEmail());
        $userName = $conn->real_escape_string($user->getName());
        $userGender = $conn->real_escape_string($user->getGender());
        $userActive = $conn->real_escape_string($user->isActive());

        $sql = "UPDATE $db_table SET email = '$userEmail', name = '$userName', gender = '$userGender', active = '$userActive' WHERE id = $id";

        if ($result = $conn->query($sql)) {
            //$result->free();
        } else {
            echo "Ошибка: " . $conn->error;
        }
        $conn->close();
    }


}