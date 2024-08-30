<?php

namespace Companies\Restaurants;
require_once './Interfaces/FileConvertible.php';
use Interfaces\FileConvertible;
use Models\Employee;
use Faker\Factory;

class RestaurantLocation implements FileConvertible {
    private string $name;
    private string $address;
    private string $city;
    private string $state;
    private string $zipCode;
    private array $employees;
    private bool $isOpen;
    private bool $hasDriveThru;
    private static int $itemCount = 0;

    public function __construct(
        string $name, string $address, string $city, string $state,
        string $zipCode, array $employees, bool $isOpen, bool $hasDriveThru
    ) {
            $this->name = $name;
            $this->address = $address;
            $this->city = $city;
            $this->state = $state;
            $this->zipCode = $zipCode;
            $this->employees = $employees;
            $this->isOpen = $isOpen;
            $this->hasDriveThru = $hasDriveThru;
    }
    // 場所の名前、住所、市区町村、州、郵便番号、および現在開いているかどうかを表示するメソッド
    public function getName() {
        return $this->name;
    }
    public function getAddress() {
        return $this->address;
    }
    public function getCity() {
        return $this->city;
    }
    public function getState() {
        return $this->state;
    }
    public function getZipCode() {
        return $this->zipCode;
    }
    public function getIsOpen() {
        return $this->isOpen;
    }
    public function getEmployees() {
        return $this->employees;
    }

    public function toString(): string {
        return sprintf(
            "Company Name: %s, Address: %s, %s, %s, ZipCode: %s",
            $this->name,
            $this->address,
            $this->city,
            $this->state,
            $this->zipCode
        );
    }

    public function toHTML(): string {

        $employeesInfo = "";

        for ($i = 0; $i < count($this->employees); $i++) {
            $employeesInfo .= $this->employees[$i]->toHTML();
        }
        
        self::$itemCount += 1;
        $itemCount = self::$itemCount;
        return sprintf("
            <!-- accordion item -->
            <div class='accordion-item'>
                <h2 class='accordion-header'>
                    <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#collapse$itemCount' aria-expanded='false' aria-controls='collapse$itemCount'>
                        %s
                    </button>
                </h2>
                <div id='collapse$itemCount' class='accordion-collapse collapse' data-bs-parent='#accordionExample'>
                    <div class='accordion-body'>
                        <p>Company Name: %s Address: %s, %s, %s ZipCode: %s</p>
                        <hr class='my-12'>
                        <p><strong>Employees:</strong></p>
                        <ul class='list-group'>
                            %s
                        </ul>
                    </div>
                </div>
            </div>
            ",
            $this->name,
            $this->name,
            $this->address,
            $this->city,
            $this->state,
            $this->zipCode,
            $employeesInfo
        );
    }

    public function toMarkdown(): string {
        return "## Company Name: {$this->name}
                 - Address: {$this->address}
                 - City: {$this->city}
                 - State: {$this->state}
                 - ZipCode: {$this->zipCode}";
    }

    public function toArray(): array {
        return [
            'companyName' => $this->name,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'zipCode' => $this->zipCode
        ];
    }

    public static function randomGenerator($salaryMin, $salaryMax, $zipCode, $totalEmployees) {
        $faker = Factory::create();
        $employees = [];
        // 1～10でemployee作成
        for ($i = 0; $i < $totalEmployees; $i++) {
            array_push($employees, Employee::randomGenerator($salaryMin, $salaryMax));
        }

        return new self(
            $faker->company(),
            $faker->address(),
            $faker->city(),
            $faker->state(),
            $zipCode,
            $employees,
            $faker->boolean(),
            $faker->boolean()
        );
    }



}