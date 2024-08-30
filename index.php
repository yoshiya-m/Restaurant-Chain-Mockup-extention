<?php

require_once 'Models/User.php';
require_once 'Models/Employee.php';
require_once 'Companies/Restaurants/RestaurantChain.php';
require_once 'vendor/autoload.php';

use Faker\Factory;
use Models\User;
use Models\Employee;
use Companies\Restaurants\RestaurantChain;

$faker = Factory::create();
$numOfRestaurantChain = $faker->numberBetween(2, 5);
$restaurantChains = [];

for ($i = 0; $i < $numOfRestaurantChain; $i++) {
    array_push($restaurantChains, RestaurantChain::randomGenerator());
}


?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <?php 
            for ($i = 0; $i < $numOfRestaurantChain; $i++) {
                echo $restaurantChains[$i]->toHTML();
            }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>