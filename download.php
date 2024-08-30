<?php
require_once 'vendor/autoload.php';
require_once 'Models/User.php';
require_once 'Models/Employee.php';
require_once 'Interfaces/FileConvertible.php';
require_once 'RandomGenerator.php';
require_once 'Companies/Company.php';
require_once 'Companies/Restaurants/RestaurantChain.php';
require_once 'Companies/Restaurants/RestaurantLocation.php';
// require 'vendor/autoload.php'; // Composer のオートローダーを読み込む

use Companies\Restaurants\RestaurantChain;
use generator\RandomGenerator;

// POSTリクエストからパラメータを取得
$employeeCount = $_POST['employee-count'] ?? 5;
$salaryMin = $_POST['salary-min'] ?? 1;
$salaryMax = $_POST['salary-max'] ?? 10;
$locationCount = $_POST['location-count'] ?? 3;
$zipCodeMin = $_POST['zipcode-min'] ?? 1;
$zipCodeMax = $_POST['zipcode-max'] ?? 90000;
$format = $_POST['format'] ?? 'html';

$count = $_POST['count'] ?? 5;
// パラメータが正しい形式であることを確認
$employeeCount = (int)$employeeCount;
$salaryMin = (int)$salaryMin;
$salaryMax = (int)$salaryMax;
$locationCount = (int)$locationCount;
$zipCodeMin = (int)$zipCodeMin;
$zipCodeMax = (int)$zipCodeMax;

$intParameters = [$employeeCount, $salaryMin, $salaryMax, $locationCount, $zipCodeMin, $zipCodeMax];

foreach ($intParameters as $parameter) {
    $parameter = (int)$parameter;
    if (is_null($parameter)) exit('Missing parameters.');

}
// 検証
if (is_null($format)) {
    exit('Missing parameters.');
}

if (!is_numeric($employeeCount) || $employeeCount < 1 || $employeeCount > 10) {
    exit('Invalid number of employees. Must be a number between 1 and 10.');
}
if (!is_numeric($salaryMin) || $salaryMin < 1 || $salaryMin > 10) {
    exit('Invalid number of minimum salary. Must be a number between 1 and 10.');
}
if (!is_numeric($salaryMax) || $salaryMax < 1 || $salaryMax > 10) {
    exit('Invalid number of minimum salary. Must be a number between 1 and 10.');
}
if ($salaryMax < $salaryMin) {
    exit('Minimum salary must not be larger than max salary');
}

if (!is_numeric($locationCount) || $locationCount < 1 || $locationCount > 5) {
    exit('Invalid number of restaurant locations. Must be a number between 1 and 5.');
}
if (!is_numeric($zipCodeMin) || $zipCodeMin < 1 || $zipCodeMin > 90000) {
    exit('Invalid number of restaurant locations. Must be a number between 1 and 5.');
}
if (!is_numeric($zipCodeMax) || $zipCodeMin < 1 || $zipCodeMin > 90000) {
    exit('Invalid number of restaurant locations. Must be a number between 1 and 5.');
}
if ($zipCodeMax < $zipCodeMin) {
    exit('ZIP Code minimum must not be larger than ZIP Code max');
}

$allowedFormats = ['json', 'txt', 'html', 'markdown'];
if (!in_array($format, $allowedFormats)) {
    exit('Invalid type. Must be one of: ' . implode(', ', $allowedFormats));
}

// レストランチェーンを作成
// 指定できる引数だけ受け付ける zipcode,salaryなど。それ以外はrandomのまま
$restaurantChain = RestaurantChain::randomGenerator($employeeCount, $salaryMin, $salaryMax, $locationCount, $zipCodeMin, $zipCodeMax);


// 値を引数で渡す必要あり

// ユーザーを作成
$users = RandomGenerator::users($count, $count);

if ($format === 'markdown') {
    header('Content-Type: text/markdown');
    header('Content-Disposition: attachment; filename="users.md"');
    // foreach ($users as $user) {
    //     echo $user->toMarkdown();
    // }
    echo $restaurantChain->toMarkdown();
} elseif ($format === 'json') {
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="users.json"');
    // $usersArray = array_map(fn($user) => $user->toArray(), $users);
    echo json_encode($restaurantChain->toArray());
} elseif ($format === 'txt') {
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="users.txt"');
    // foreach ($users as $user) {
    //     echo $user->toString();
    // }
    echo $restaurantChain->toString();
} else {
    // HTML をデフォルトに
    header('Content-Type: text/html');
    $output = '
    <!DOCTYPE html>
    <html lang="ja">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    </head>

    <body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>

    </html><div class="container">' . 
    $restaurantChain->toHTML() . "</div>";
    // foreach ($users as $user) {
    //     echo $user->toHTML();
    // }
    echo $output;
}


?>

