<?php
include_once("./includes/db.php");
include_once("./includes/functions.php");
startSession();
$recentProducts = getProducts(4);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Home - Web Shop</title>
</head>
<body>
    <?php include("./includes/header.php"); ?>
    <div class="featured-img"></div>
    <div class="products-container">
        <?php
        if ($recentProducts->num_rows > 0) {
            while ($product = $recentProducts->fetch_assoc()) {
                echo renderProductCard($product);
            }
        } else {
            echo '<p>Sorry, there are no products available at the moment.</p>';
        }
        $spoj->close();
        ?>
    </div>
</body>
</html>
