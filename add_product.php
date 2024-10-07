<?php
session_start();
include("./includes/db.php");

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

if (isset($_POST['log-out'])) {
    session_destroy();
    header("location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add-product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $_POST['image'];

    $sql = "INSERT INTO `products` (name, price, quantity, image) VALUES (?, ?, ?, ?)";
    $stmt = $spoj->prepare($sql);
    $stmt->bind_param('sdis', $name, $price, $quantity, $image);
    $stmt->execute();
    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style_dashboard.css">
    <title>Add Product</title>
</head>

<body>
    <?php include("./includes/dashboard_header.php"); ?>
    <form class="product-form" method="post">
        <h2 class="form-title">Add New Product</h2>
        <input type="text" id="name" name="name" placeholder="Name" required>
        <input type="number" id="price" name="price" step="0.01" placeholder="Price" min="0" required>
        <input type="number" id="quantity" name="quantity" placeholder="Quantity" required>
        <input type="text" id="image" name="image" placeholder="Image URL" required>
        <input type="submit" name="add-product" value="Add Product">
    </form>
</body>

</html>
