<?php

namespace Companies\Restaurants;

require_once './Interfaces/FileConvertible.php';
require_once 'RestaurantLocation.php';
require_once './Companies/Company.php';

use Companies\Restaurants;
use Faker\Factory;
use Interfaces\FileConvertible;

class RestaurantChain extends Company implements FileConvertible
{
    private int $chainId;
    private array $restaurantLocations;
    private string $cuisineType;
    private int $numberOfLocations;
    private string $parentCompany;

    public function __construct(
        int $chainId,
        string $cuisineType,
        int $numberOfLocations,
        string $parentCompany,
        string $name,
        int $foundingYear,
        string $description,
        string $website,
        string $phone,
        string $industry,
        string $ceo,
        bool $isPubliclyTraded,
        string $country,
        string $founder,
        int $totalEmployees,
        int $salaryMin, 
        int $salaryMax, 
        int $zipCode
    ) {
        $this->chainId = $chainId;
        $restaurantLocations = [];
        for ($i = 0; $i < $numberOfLocations; $i++) {
            array_push($restaurantLocations, RestaurantLocation::randomGenerator($salaryMin, $salaryMax, $zipCode, $totalEmployees));
        }
        $this->restaurantLocations = $restaurantLocations;
        $this->cuisineType = $cuisineType;
        $this->numberOfLocations = $numberOfLocations;
        $this->parentCompany = $parentCompany;
        parent::__construct(
            $name,
            $foundingYear,
            $description,
            $website,
            $phone,
            $industry,
            $ceo,
            $isPubliclyTraded,
            $country,
            $founder,
            $totalEmployees
        );
    }

    // チェーンに新しいレストランの場所を追加するメソッド、

    public function addRestaurantLocation(RestaurantLocation $restaurantLocation)
    {
        array_push($this->restaurantLocations, $restaurantLocation);
        // レストランの数を追加
        $this->numberOfLocations += 1;
    }
    // チェーン内のすべてのレストランの場所を表示するメソッド、
    public function getAllRestaurantsAddress()
    {
        $addresses = [];
        for ($i = 0; $i < $this->numberOfLocations; $i++) {
            $restaurant = $this->restaurantLocations[$i];
            array_push($addresses, $restaurant);
        }
        return $addresses;
    }
    // およびチェーンに関する情報を表示するメソッド（Company から継承）が必要 -> 仕様３で利用

    // ランダムな値を使ってそのクラスのオブジェクトを生成する
    public static function randomGenerator($employeeCount, $salaryMin, $salaryMax, $locationCount, $zipCodeMin, $zipCodeMax)
    {
        $faker = Factory::create();
        $restaurantLocations = [];
        for ($i = 0; $i < $locationCount; $i++) {
            $zipCode = $faker->numberBetween($zipCodeMin, $zipCodeMax);
            array_push($restaurantLocations, RestaurantLocation::randomGenerator($salaryMin, $salaryMax, $zipCode, $employeeCount));
        }

        return new self(
            $faker->numberBetween(0, 100),
            $faker->word(),
            $locationCount,
            $faker->company(),
            $faker->company(),
            $faker->year(),
            $faker->text(),
            $faker->domainName(),
            $faker->phoneNumber(),
            'Food and Beverage',
            $faker->firstName() . " " . $faker->lastName(),
            $faker->boolean(),
            $faker->countryISOAlpha3(),
            $faker->firstName() . " " . $faker->lastName(),
            $employeeCount,
            $salaryMin, 
            $salaryMax, 
            $zipCode
        );
    }

    public function toString(): string
    {
        return sprintf(
            "chain ID:%s\nCuisine type: %s\nNumber of locations: %s\nCompany name: %s\nParent company: %s\nFounding year%s\nDescription: %s\nWebsite: %s\nphone number: %s\nIndestry: %s\nCEO: %s\nPubliclyTraded: %s\nCountry: %s\nFounder: %s\nTotal employees: %s\n",
        $this->chainId,
        $this->cuisineType,
        $this->numberOfLocations,
        $this->parentCompany,
        $this->getName(),
        $this->getFoundingYear(),
        $this->getDescription(),
        $this->getWebsite(),
        $this->getPhone(),
        $this->getIndustry(),
        $this->getCeo(),
        $this->getIsPubliclyTraded(),
        $this->getCountry(),
        $this->getFounder(),
        $this->getTotalEmployees()
        );
        
    }    
    public function toHTML(): string
    {

        $restaurants = "";
        for ($i = 0; $i < $this->numberOfLocations; $i++) {
            $restaurants .= $this->restaurantLocations[$i]->toHTML();
        }

        $container = sprintf("
        <div class='m-5'>
            <h1>Restaurant Chain %s</h1>
            <div class='card'>
                <div class='card-header'>
                    Restaurant Chain Information
                </div>
                <div class='card-body'>
                    <!-- accordion menu -->
                    <div class='accordion accordion-flush'>
                        $restaurants
                    </div>
                </div>
            </div>
        </div>
        ",
        $this->getName());

        return $container;
    }
    public function toMarkdown(): string
    {
        return "
        ## Company Name: {$this->getName()}
        - chain ID: {$this->chainId},
        - Cuisine type: {$this->cuisineType},
        - Number of locations: {$this->numberOfLocations},
        - Parent company: {$this->parentCompany},
        - Company name: {$this->getName()},
        - Founding year: {$this->getFoundingYear()},
        - Description: {$this->getDescription()},
        - Website: {$this->getWebsite()},
        - Phone number: {$this->getPhone()},
        - Industry: {$this->getIndustry()},
        - CEO: {$this->getCeo()},
        - PuliciclyTraded: {$this->getIsPubliclyTraded()},
        - Country: {$this->getCountry()},
        - Founder: {$this->getFounder()},
        - Total employees: {$this->getTotalEmployees()},
        ";
    }

    public function toArray(): array
    {
        return [
            'chainId' => $this->chainId,
            'cuisineType' => $this->cuisineType,
            'numberOfLocations' => $this->numberOfLocations,
            'parentCompany' => $this->parentCompany,
            'company' => $this->getName(),
            'foundingYear' => $this->getFoundingyear(),
            'description' => $this->getDescription(),
            'website' => $this->getWebsite(),
            'phoneNumber' => $this->getPhone(),
            'industry' => $this->getIndustry(),
            'CEO: ' => $this->getCeo(),
            'puliclyTraded' => $this->getIsPubliclyTraded(),
            'country' => $this->getCountry(),
            'founder' => $this->getFounder(),
            'totalEmployees' => $this->getTotalEmployees()

        ];
    }
}
