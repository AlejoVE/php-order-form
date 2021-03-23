<?php require_once 'index.php' ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>Order Pizzas & drinks</title>
</head>
<body>
<div class="main-container">
    <h1>La Pizzeria D'Alessandro</h1>
    <!-- <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="?food=pizzas">Order pizzas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?food=drinks">Order drinks</a>
            </li>
        </ul>
    </nav> -->
    
    <form class="form-container" method="post">
            <div class="top-container">
                <div class="email-container">
                    <label for="email"><h4>Email:</h4></label>
                    <input type="text" id="email" name="email" class="form-control email-input" value="<?= $_SESSION['email'] ?? ""?>" required/>
                </div>
                
                        <fieldset class="address-container">
                <h4>Address</h4>
                <div class="sub-container">
                    <div>
                        <label for="street">Street:</label>
                        <input type="text" name="street" id="street" class="form-control" value="<?= $_SESSION['street'] ?? ""?>" required>
                    </div>
                    <div>
                        <label for="streetnumber">Street number:</label>
                        <input type="text" id="streetnumber" name="streetnumber" class="form-control" value="<?= $_SESSION['streetNumber'] ?? ""?>" required>
                    </div>
                </div>
                <div class="sub-container">
                    <div>
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" class="form-control" value="<?= $_SESSION['city'] ?? ""?>" required>
                    </div>
                    <div>
                        <label for="zipcode">Zipcode</label>
                        <input type="text" id="zipcode" name="zipcode" class="form-control" value="<?= $_SESSION['zipCode'] ?? ""?>" required>
                    </div>
                </div>
                        </fieldset>
            </div>

        <fieldset class="products-container">
            <h4>Our menu</h4>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link btn btn-primary" href="?food=pizzas">Order pizzas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-secondary" href="?food=drinks">Order drinks</a>
                </li>
            </ul>
            <table class="table">
                     <tr>
                        <th>Order</th>
                        <th>Product</th>
                        <th>Price</th>
                    </tr>
                
             <?php foreach ($products AS $i => $product): ?>
                 <tr>
                    <td><input type="checkbox" value="<?= $product['price'] ?>" name="product-<?php echo $i ?>"/></td>
                    <td><?php echo $product['name'] ?></td>
                    <td>&euro; <?php echo number_format($product['price'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
            </table>
        <label class="express">
            <input type="checkbox" name="express_delivery"  value="5" /> 
            Express delivery (+ 5 EUR) 
        </label>
        </fieldset>
        
            
        <button type="submit" class="btn btn-success" name='submit'>Order!</button>
    </form>

    <footer>You already ordered <strong>&euro; <?= $_COOKIE["total_spend"] ?? 0 ?></strong> in pizza(s) and drinks.</footer>
</div>

<style>
    footer {
        text-align: center;
    }
</style>
</body>
</html>
