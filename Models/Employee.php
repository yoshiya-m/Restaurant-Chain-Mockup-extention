<?php

namespace Models;

use DateTime;
use Interfaces\FileConvertible;
use Models;
use Faker\Factory;
require_once './Interfaces/FileConvertible.php';
require_once './vendor/fakerphp/faker/src/Faker/Factory.php';


class Employee extends User implements FileConvertible {
    private string $jobTitle;
    private float $salary;
    private DateTime $startDate;
    private array $awards;

    // Userクラスのコンストラクタも
    public function __construct(
        string $jobTitle, float $salary, DateTime $startDate, array $awards,
        int $id, string $firstName, string $lastName, string $email,
        string $password, string $phoneNumber, string $address,
        DateTime $birthDate, DateTime $membershipExpirationDate, string $role
        ) {
        $this->jobTitle = $jobTitle;
        $this->salary = $salary;
        $this->startDate = $startDate;
        $this->awards = $awards;

        parent::__construct(
            $id, $firstName, $lastName, $email,
            $password, $phoneNumber, $address,
            $birthDate, $membershipExpirationDate, $role
        );
    }

    // 従業員の職種、給与、就職日、および受賞リストを表示するメソッド

    public function getJobTitle() {
        return $this->jobTitle;
    }
    public function getSalary() {
        return $this->salary;
    } 
    public function getStartDate() {
        return $this->startDate;
    }
    public function getAwards() {
        return $this->awards;
    }
    
    public function toString(): string {
        return sprintf(
            "ID: %d, Job Title: %s, %s %s, Start Date: %s",
            $this->getId(),
            $this->jobTitle,
            $this->getFirstName(),
            $this->getLastName(),
            $this->startDate
        );
    }

    public function toHTML(): string {
        return sprintf("
            <li class='list-group-item'>
                ID: %s,
                Job Title: %s,
                %s %s,
                Start Date: %s
            </li>
            ",
            $this->getId(),
            $this->jobTitle,
            $this->getFirstName(),
            $this->getLastName(),
            $this->startDate->format('Y-m-d')
        );
    }

    public function toMarkdown(): string {
        return "## ID: {$this->getId()}
                 - Job Title: {$this->jobTitle}
                 - First Name: {$this->getFirstName()}
                 - Last Name: {$this->getLastName()}
                 - Start date: {$this->startDate}";
    }

    public function toArray(): array {
        return [
            'id' => $this->getId(),
            'jobTitle' => $this->jobTitle,
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'startDate' => $this->startDate
        ];
    }


    public static function randomGenerator($salaryMin, $salaryMax) {
        $faker = Factory::create();
        $salary = $faker->numberBetween($salaryMin, $salaryMax);
        return new self(
            $faker->jobTitle(),
            $salary,
            new DateTime($faker->date()),
            $faker->words(),
            $faker->randomNumber(),
            $faker->firstName(),    
            $faker->lastName(),    
            $faker->email,   
            $faker->password,     
            $faker->phoneNumber,
            $faker->address,    
            $faker->dateTimeThisCentury,   
            $faker->dateTimeBetween,
            $faker->randomElement     
        );
    }
}

