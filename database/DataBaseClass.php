<?php

namespace DataBase;
include 'vendor/autoload.php';

use Models\User;
use PDO;

class DataBaseClass
{
    private static $instance = null;
    private $db;
    private $dbinfo;

    /**
     * connect to the db, db_info input
     */
    private function __construct()
    {
        $this->dbinfo = require 'dbInfo.php';
        $this->db = new PDO('mysql:host=' . $this->dbinfo['host'] . ';dbname=' . $this->dbinfo['base'], $this->dbinfo['user'], $this->dbinfo['password']);
    }

    private function __clone(){}
    private function __wakeup(){}

    public static function getInstance() : DataBaseClass{
            if(self::$instance!=null){
                return self::$instance;
            }
            return new self();
        }

    /**
     * check is db not null
     *
     * @return void
     */
    public static function checkDB() : void
    {
        $users = array();
        $db = self::getInstance();
        $conn = $db->createConnection();
        $db_table = $db->dbinfo['table'];
        $sql = "SELECT * FROM $db_table";
        $log = "";
        if ($result = $conn->query($sql)) {
            $rowsCount = $result->num_rows; // количество полученных строк

            //echo '<pre>';
            foreach ($result as $row) {
                if ($row['email'] == null) {
                    $db->deleteUser($row['id']);
                    continue;
                }
                if ($row['name'] == null) {
                    $db->deleteUser($row['id']);
                    continue;
                }
                if ($row['gender'] == null) {
                    $db->deleteUser($row['id']);
                    continue;
                }
                if ($row['active'] == null) {
                    $db->deleteUser($row['id']);
                }
            }
            $result->free();
        } else {
            $log = "Ошибка: " . $conn->error;
        }
        $conn->close();
        file_put_contents(__DIR__ . 'DB_log.log', $log, 0);
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
        $status = $user->isActive() ? 1 : 0;
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
        $log = "";
        if ($result = $conn->query($sql)) {
            $rowsCount = $result->num_rows;
            foreach ($result as $row) {
                $users[] = new User($row["email"], $row["name"], $row["gender"], $row["active"]);
                $users[count($users) - 1]->setId($row['id']);
            }
            $result->free();
        } else {
            $log = "Ошибка: " . $conn->error;
        }
        $conn->close();
        file_put_contents(__DIR__ . 'DB_log.log', $log, 0);
        return $users;
    }

    /**
     * delete user by id from db
     *
     * @param $id
     * @return void
     */
    public function deleteUser($id) : void
    {
        $conn = $this->createConnection();
        $db_table = $this->dbinfo['table'];
        $sql = "DELETE FROM $db_table WHERE id=$id";
        $log = "";
        if ($conn->query($sql) === TRUE) {
            $log = "Record deleted successfully";
        } else {
            $log = "Error deleting record: " . $conn->error;
        }
        file_put_contents(__DIR__ . 'DB_log.log', $log, 0);
        $conn->close();
    }

    /**
     * get user from db by id
     *
     * @param $id
     * @return User
     */
    public function showByID($id): User
    {
        $conn = $this->createConnection();
        $db_table = $this->dbinfo['table'];
        $sql = "SELECT * FROM $db_table WHERE id=$id";
        $log = "";
        if ($result = $conn->query($sql)) {
            foreach ($result as $row) {
                $user = new User($row["email"], $row["name"], $row["gender"], $row["active"]);
            }
            $result->free();
        } else {
            $log = "Ошибка: " . $conn->error;
        }
        $conn->close();
        file_put_contents(__DIR__ . 'DB_log.log', $log, 0);
        return $user;
    }

    /**
     * change info in db by id
     *
     * @param $id
     * @param $user
     * @return void
     */
    public function editUser($user): void
    {
        $conn = $this->createConnection();
        $db_table = $this->dbinfo['table'];
        $log = "";
        $id = $user->getId();

        $userEmail = $conn->real_escape_string($user->getEmail());
        $userName = $conn->real_escape_string($user->getName());
        $userGender = $conn->real_escape_string($user->getGender());
        $userActive = $conn->real_escape_string($user->isActive()?1:0);

        $sql = "UPDATE $db_table SET email = '$userEmail', name = '$userName', gender = '$userGender', active = '$userActive' WHERE id = $id";

        if ($result = $conn->query($sql)) {
            $log = "Successfully edited";
        } else {
            $log = "Ошибка: " . $conn->error;
        }
        $conn->close();
        file_put_contents(__DIR__ . 'DB_log.log', $log, 0);
    }

    /**
     * check if there are user with this id
     *
     * @param $id
     * @return bool
     */
    public function checkIdInDB($id)
    {
        $conn = $this->createConnection();
        $db_table = $this->dbinfo['table'];
        $sql = "SELECT * FROM $db_table WHERE id=$id";
        $log = "";
        if ($result = $conn->query($sql)) {

            if($result->num_rows==0){
                return false;
            }
            $result->free();
            $conn->close();
            return true;
        } else {
            $conn->close();
            return false;
        }
    }

    public function getRowsNumber(): int{
        $conn = $this->createConnection();
        $total_rows = 0;
        $db_table = $this->dbinfo['table'];
        $sql = "SELECT COUNT(*) FROM $db_table";
        $log = "";
        if ($result = $conn->query($sql)) {
            $total_rows = mysqli_fetch_array($result)[0];
            $result->free();
            return $total_rows;
        } else {
            $log = "Ошибка: " . $conn->error;
        }
        $conn->close();
        file_put_contents(__DIR__ . 'DB_log.log', $log, 0);
        return $total_rows;
    }

}