<?php
enum Gender{
    case male;
    case female;
}

class User{
    private String $emal;
    private String $name;
    private Gender $gender;
    private bool $active;

    /**
     * @return String
     */
    public function getEmal(): string
    {
        return $this->emal;
    }

    /**
     * @param String $emal
     */
    public function setEmal(string $emal): void
    {
        $this->emal = $emal;
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
     * @return Gender
     */
    public function getGender(): Gender
    {
        return $this->gender;
    }

    /**
     * @param Gender $gender
     */
    public function setGender(Gender $gender): void
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