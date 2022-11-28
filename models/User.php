<?php

namespace Models;
include 'vendor/autoload.php';

use DataBase\DataBaseClass;

class User
{
    private int $id;
    private string $email;
    private string $name;
    private string $gender;
    private bool $active;

    private DataBaseClass $db;

    /**
     * @param string $email
     * @param string $name
     * @param string $gender
     * @param bool $active
     */
    public function __construct(string $email, string $name, string $gender, bool $active)
    {
        $this->email = $email;
        $this->name = $name;
        $this->gender = $gender;
        $this->active = $active;
        $this->db = DataBaseClass::getInstance();
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
        $this->db->addInfo($this);
    }

    public function showAllUsersFromDB(): array
    {
        return $this->db->showInfoDB();
    }

    public function showUserByID($id): User
    {
        return $this->db->showByID($id);
    }

    public function deleteUserFromDB($id): void
    {
        $this->db->deleteUser($id);
    }

    public function editUserInfoInDB($user): void
    {
        $this->db->editUser($user);
    }

    public function checkId($id)
    {
        return $this->db->checkIdInDB($id);
    }
}

?>