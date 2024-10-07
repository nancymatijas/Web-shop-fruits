<?php
include("./includes/db.php");
include("./includes/functions.php");
startSession();

if (!isset($_SESSION['cart_item']) || empty($_SESSION['cart_item'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $spoj->real_escape_string($_POST['name']);
    $surname = $spoj->real_escape_string($_POST['surname']);
    $address = $spoj->real_escape_string($_POST['address']);
    $email = $spoj->real_escape_string($_POST['email']);

    $total = 0;
    foreach ($_SESSION["cart_item"] as $item) {
        $total += $item["price"] * $item["quantity"];
    }

    $stmt = $spoj->prepare("INSERT INTO orders (name, surname, address, email, total) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssd", $name, $surname, $address, $email, $total);
    $stmt->execute();
    $lastInsertId = $stmt->insert_id;
    $stmt->close();

    if (!empty($lastInsertId)) {
        $stmtItems = $spoj->prepare("INSERT INTO ordered_items (order_id, item_id, quantity) VALUES (?, ?, ?)");
        $stmtUpdate = $spoj->prepare("UPDATE products SET quantity = quantity - ? WHERE id = ?");
        
        foreach ($_SESSION["cart_item"] as $item) {
            $stmtItems->bind_param("iii", $lastInsertId, $item["id"], $item["quantity"]);
            $stmtItems->execute();
            
            $stmtUpdate->bind_param("ii", $item["quantity"], $item["id"]);
            $stmtUpdate->execute();
        }
        
        $stmtItems->close();
        $stmtUpdate->close();
    }
    
    unset($_SESSION["cart_item"]);
    header("Location: placeorder.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Checkout</title>
</head>
<body>
    <?php include("./includes/header.php"); ?>
    <div class="checkout-content">
        <h2 class="form-title">Checkout</h2>
        <form method="post">
            <input type="text" id="name" name="name" placeholder="First Name" required><br>
            <input type="text" id="surname" name="surname" placeholder="Last Name" required><br>
            <input type="text" id="address" name="address" placeholder="Address" required ><br>
            <input type="email" id="email" name="email" placeholder="E-mail" required><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
