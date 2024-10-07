<?php
include("./includes/db.php");
include("./includes/functions.php");
startSession();
$product_id = $_GET['id'];
$sql = "SELECT * FROM `products` WHERE `id` = " . $product_id;
$result = $spoj->query($sql);
$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title><?php echo $product["name"]; ?></title>
</head>
<body>
    <?php include("./includes/header.php"); ?>
    <div class="product-container">
        <img src="<?php echo $product["image"]; ?>" alt="<?php echo $product["name"]; ?>">
        <h2><?php echo $product["name"]; ?></h2>
        <p><?php echo $product["price"]; ?>€</p>
        <form method="post" action="cart.php?action=add&id=<?php echo $product["id"]; ?>">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="1" min="1" max="<?php echo $product["quantity"]; ?>" />
            <input type="submit" value="Add to Cart" class="btnAddAction" />
        </form>
    </div>
</body>
</html>
