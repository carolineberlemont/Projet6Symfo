<?php

namespace App\Entity;


class AdSearch {

    /**
    * @var int|null
    */
    private $birthYear;

    /**
    * @var int|null
    */
    private $birthMonth;

    /**
    * @var int|null
    */
    private $birthDay;    

    /**
    * @var string|null
    */
    private $kind;

    /**
    * @var string|null
    */
    private $department;

    /**
    * @var string|null
    */
    private $country;

    /**
    * @return int|null
    */
    public function getBirthYear(): ?int
    {
        return $this->birthYear;
    }

    /*
    *@param int|null $birthYear
    *@return AdSearch
    */
    public function setBirthYear(int $birthYear): AdSearch
    {
        $this->birthYear = $birthYear;

        return $this;
    }

    /*
    *@return int|null
    */
    public function getBirthMonth(): ?int
    {
        return $this->birthMonth;
    }

    /*
    *@param int|null $birthMonth
    *@return AdSearch
    */
    public function setBirthMonth(int $birthMonth): AdSearch
    {
        $this->birthMonth = $birthMonth;

        return $this;
    }

    /*
    *@return int|null
    */
    public function getBirthDay(): ?int
    {
        return $this->birthDay;
    }

    /*
    *@param int|null $birthDay
    *@return AdSearch
    */
    public function setBirthDay(int $birthDay): AdSearch
    {
        $this->birthDay = $birthDay;

        return $this;
    }

    /*
    *@return string|null
    */
    public function getKind(): ?string
    {
        return $this->kind;
    }

    /*
    *@param int|null $kind
    *@return AdSearch
    */
    public function setKind(string $kind): AdSearch
    {
        $this->kind = $kind;

        return $this;
    }

    /*
    *@return string|null
    */
    public function getDepartment(): ?string
    {
        return $this->department;
    }

    /*
    *@param int|null $department
    *@return AdSearch
    */
    public function setDepartment(string $department): AdSearch
    {
        $this->department = $department;

        return $this;
    }

    /*
    *@return string|null
    */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /*
    *@param int|null $country
    *@return AdSearch
    */
    public function setCountry(string $country): AdSearch
    {
        $this->country = $country;

        return $this;
    }
}