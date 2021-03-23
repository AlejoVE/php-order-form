<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);

//we are going to use session variables so we need to enable sessions
session_start();

//Get array of products
$products = getProducts();

function getProducts () {
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

    if(isset($_GET['food']) && $_GET["food"] == 'drinks'){
            $products = [
                ['name' => 'Water', 'price' => 1.8],
                ['name' => 'Sparkling water', 'price' => 1.8],
                ['name' => 'Cola', 'price' => 2],
                ['name' => 'Fanta', 'price' => 2],
                ['name' => 'Sprite', 'price' => 2],
                ['name' => 'Ice-tea', 'price' => 2.2],
            ];
    };

    return $products;
};


//HANDLE SUBMIT
if(isset($_POST['submit'])){
    global $products;
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $street = filter_var($_POST['street'], FILTER_SANITIZE_STRING);
    $streetNumber= filter_var($_POST['streetnumber'], FILTER_SANITIZE_NUMBER_INT);
    $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
    $zipCode = filter_var($_POST['zipcode'], FILTER_SANITIZE_NUMBER_INT);
    $subject = "Order";
    
    if(!is_numeric($street) && !is_numeric($city) && is_numeric($zipCode) && filter_var($email, FILTER_VALIDATE_EMAIL)){

        // SET SESSION VARIABLES
        $_SESSION["email"]=  $email;
        $_SESSION["street"]= $street;
        $_SESSION["streetNumber"]= $streetNumber;
        $_SESSION["city"]= $city;
        $_SESSION["zipCode"]= $zipCode;



        $totalValue = setTotalValue($products);
        setcookie("total_spend", "{$totalValue}", time() + 3600);
       
        //send email
        $to = "luis.alejandro.499be@gmail.com";
        $body = "From: {$email} \l\n Street: {$street} \l\n Steer number: {$streetNumber} \l\n Zipcode: {$zipCode}";
        mail($to, $subject, $body);


        //display to user
        if(isset($_POST["express_delivery"])){
            echo '<div class="alert alert-success" role="alert">
            Your order has been  sent, your food will arrive in 30 minutes, thank you!
          </div>';

        } else {
            echo '<div class="alert alert-success" role="alert">
            Your order has been  sent, your food will arrive in 1 hour, thank you!
          </div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">
        Please fill out all the fields!
      </div>';
    };

};

function setTotalValue($products) {
    if(isset($_COOKIE['total_spend'])) {
        $totalValue = (float)$_COOKIE['total_spend'];
    } else {
        $totalValue = 0;
    }

    foreach ($products AS $i => $product){
        if(isset($_POST["product-{$i}"])){
            $price = $product["price"];
            $totalValue += $price;
        };
    };
    
  return $totalValue;
};


require 'form-view.php';