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

if(!isset($_GET['id'])) {
    exit('No product ID provided.');
}

$id = $_GET['id'];

$sql = "SELECT * FROM `products` WHERE id=?";
$stmt = $spoj->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $_POST['image'];

    $sql = "UPDATE `products` SET name=?, price=?, quantity=?, image=? WHERE id=?";
    $stmt = $spoj->prepare($sql);
    $stmt->bind_param('sdisd', $name, $price, $quantity, $image, $id);
    $stmt->execute();
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete-product'])) {
    $sql = "DELETE FROM `products` WHERE id=?";
    $stmt = $spoj->prepare($sql);
    $stmt->bind_param('i', $id);
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
    <title>Edit Product</title>
</head>

<body>
    <?php include("./includes/dashboard_header.php"); ?>
    <form class = "product-form" method="post">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>" required>

        <label for="price">Price</label>
        <input type="number" id="price" name="price" step="0.01" value="<?php echo $product['price']; ?>" required>

        <label for="quantity">Quantity</label>
        <input type="number" id="quantity" name="quantity" value="<?php echo $product['quantity']; ?>" required>

        <label for="image">Image URL</label>
        <input type="text" id="image" name="image" value="<?php echo $product['image']; ?>" required>

        <input type="submit" name="update-product" value="Update Product">
        <input type="submit" name="delete-product" value="Delete Product">
    </form>
</body>

</html>
