<?php

namespace Models\User;

class User
{
    private string $email;
    private string $name;
    private string $gender;
    private bool $active;

    public function __construct()
    {
        echo 'created';
    }

    public function __toString(): string
    {
        return $this->email . " " . $this->name . " " . $this->gender . " " . $this->active;
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


}

?>