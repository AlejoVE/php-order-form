<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);


//we are going to use session variables so we need to enable sessions
session_start();
$_SESSION["email"]=  "";
$_SESSION["street"]= "";
$_SESSION["street_number"]= "";
$_SESSION["city"]= "";
$_SESSION["zip_code"]= "";

//HANDLE SUBMIT
if(isset($_POST['submit'])){
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $street = filter_var($_POST['street'], FILTER_SANITIZE_STRING);
    $street_number= filter_var($_POST['streetnumber'], FILTER_SANITIZE_NUMBER_INT);
    $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
    $zip_code = filter_var($_POST['zipcode'], FILTER_SANITIZE_NUMBER_INT);
    $subject = "Order";

    //SET SESSION VARIABLES
    $_SESSION["email"]=  $email;
    $_SESSION["street"]= $street;
    $_SESSION["street_number"]= $street_number;
    $_SESSION["city"]= $city;
    $_SESSION["zip_code"]= $zip_code;

    if(is_numeric($zip_code) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $to = "luis.alejandro.499be@gmail.com";
        $body = "From: {$email} \l\n Street: {$street} \l\n Steer number: {$street_number} \l\n Zipcode: {$zip_code}";
        mail($to, $subject, $body);
    } else {
        echo '<div class="alert alert-danger" role="alert">
        Please fill out all the fields!
      </div>';
    };

};

// function whatIsHappening() {
//     echo '<h2>$_GET</h2>';
//     var_dump($_GET);
//     echo '<h2>$_POST</h2>';
//     var_dump($_POST);
//     echo '<h2>$_COOKIE</h2>';
//     var_dump($_COOKIE);
//     echo '<h2>$_SESSION</h2>';
//     var_dump($_SESSION);
// };

//your products with their price.
$products = [
    ['name' => 'Margherita', 'price' => 8],
    ['name' => 'Hawaï', 'price' => 8.5],
    ['name' => 'Salami pepper', 'price' => 10],
    ['name' => 'Prosciutto', 'price' => 9],
    ['name' => 'Parmiggiana', 'price' => 9],
    ['name' => 'Vegetarian', 'price' => 8.5],
    ['name' => 'Four cheeses', 'price' => 10],
    ['name' => 'Four seasons', 'price' => 10.5],
    ['name' => 'Scampi', 'price' => 11.5]
];

if(isset($_GET['food'])){
    $value = $_GET['food'];
    $products = get_products($value);
};

function get_products ($value) {
   global $products;
   if ($value == 'drinks') {
        $products = [
            ['name' => 'Water', 'price' => 1.8],
            ['name' => 'Sparkling water', 'price' => 1.8],
            ['name' => 'Cola', 'price' => 2],
            ['name' => 'Fanta', 'price' => 2],
            ['name' => 'Sprite', 'price' => 2],
            ['name' => 'Ice-tea', 'price' => 2.2],
        ];
    } 

    return $products;
};

$totalValue = 0;

require 'form-view.php';