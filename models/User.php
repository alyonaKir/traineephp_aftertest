<?php

namespace Models;
include 'vendor/autoload.php';

use DataBase\DataBaseClass;
use DataBase\RestDBClass;

/**
 * @OA\Schema(
 *   schema="User"
 * )
 */
class User implements IUser
{
    /**
     * @OA\Property(
     *     type="integer",
     *     format="int64",
     *     example=5444
     * )
     */
    private int $id;

    /**
     * @OA\Property(
     *     type="string",
     *     example="john@email.com"
     * )
     */
    private string $email;

    /**
     * @OA\Property(
     *     type="string",
     *     example="John"
     * )
     */
    private string $name;

    /**
     * @OA\Property(
     *     type="string",
     *     description="User gender",
     *     example="male",
     *     enum={"male", "female"}
     * )
     */
    private string $gender;

    /**
     * @OA\Property(
     *     type="string",
     *     description="User status",
     *     example="active",
     *     enum={"active", "inactive"}
     * )
     */
    private bool $active;

    private string $dbType;

    private DataBaseClass $db;
    private RestDBClass $rest;


    public function __construct(string $email, string $name, string $gender, bool $active, $dbType)
    {
        $this->email = $email;
        $this->name = $name;
        $this->gender = $gender;
        $this->active = $active;
        $this->dbType = $dbType;
        $this->db = DataBaseClass::getInstance();
        $this->rest = RestDBClass::getInstance();
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
    public function setEmail(string $email): void
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

    public function addUserToDB(): void
    {
        if ($this->dbType == "db") {
            $this->db->addInfo($this);
        } else {
            $this->rest->addUser($this);
        }
    }

    public function showAllUsersFromDB($offset, $size_page): array
    {
        if ($this->dbType == "db") {
            try {
                return $this->db->showInfoDB($offset, $size_page);
            } catch (\Exception $e) {

            }
            return array();
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
        } else {
            $this->rest->deleteUserById($id);
        }
    }

    public function editUserInfoInDB($user): void
    {
        if ($this->dbType == "db") {
            $this->db->editUser($user);
        } else {
            $this->rest->editUserById($user);
        }
    }

    public function checkId($id)
    {
        if ($this->dbType == "db") {
            return $this->db->checkIdInDB($id);
        } else {
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
        return $this->rest->countPages();
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