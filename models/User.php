<?php

namespace Models;
include 'vendor/autoload.php';

use DataBase\DataBaseClass;
use DataBase\RestDBClass;

class User
{
    private int $id;
    private string $email;
    private string $name;
    private string $gender;
    private bool $active;

    private string $dbType;

    private DataBaseClass $db;
    private RestDBClass $rest;

    /**
     * @param string $email
     * @param string $name
     * @param string $gender
     * @param bool $active
     */
    public function __construct(string $email, string $name, string $gender, bool $active, $dbType)
    {
        $this->email = $email;
        $this->name = $name;
        $this->gender = $gender;
        $this->active = $active;
        $this->dbType = $dbType;
        $this->db = DataBaseClass::getInstance();
        $this->rest = new RestDBClass();
    }

    public function __toString(): string
    {
        return $this->email . " " . $this->name . " " . $this->gender . " " . $this->active;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    /**
     * @return String
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param String $email
     */
    public function setEmal(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return String
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param String $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return String
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param String $gender
     */
    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function addUsertoDB(): void
    {
        if ($this->dbType == "db") {
            $this->db->addInfo($this);
        }
        else {
            $this->rest->addUser($this);
        }
    }

    public function showAllUsersFromDB($offset, $size_page): array
    {
        if ($this->dbType == "db") {
            return $this->db->showInfoDB($offset, $size_page);
        } else {
            return $this->rest->showAllUsers($offset, $size_page);
        }
    }

    public function showUserByID($id): User
    {
        if ($this->dbType == "db") {
            return $this->db->showByID($id);
        } else {
            return $this->rest->getUserById($id);
        }
    }

    public function deleteUserFromDB($id): void
    {
        if ($this->dbType == "db") {
            $this->db->deleteUser($id);
        }else{
            $this->rest->deleteUserById($id);
        }
    }

    public function editUserInfoInDB($user): void
    {
        if ($this->dbType == "db"){
        $this->db->editUser($user);
        }
        else{
            echo "user model";
            $this->rest->editUserById($user);
        }
    }

    public function checkId($id)
    {
        if ($this->dbType == "db") {
        return $this->db->checkIdInDB($id);
        }
        else{
            return true;
        }
    }

    public function getNumberPages(): int
    {
        if ($this->dbType == "db") {
            if ($this->db->getRowsNumber() % 10 != 0) {
                return (int)($this->db->getRowsNumber() / 10 + 1);
            } else {
                return (int)($this->db->getRowsNumber() / 10);
            }
        }
        else{
            return 54;
        }
    }

    public function isUserExist(): bool
    {
        return $this->db->isUserInDB($this);
    }

    public function clearUsers()
    {
        $this->db->clearDB();
    }
}

?>