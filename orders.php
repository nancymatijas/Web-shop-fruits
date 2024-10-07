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

if (isset($_POST['delete-order'])) {
    $order_id = $_POST['delete-order'];
    $sqlOrders = "DELETE FROM `orders` WHERE `id`='$order_id'";
    $sqlOrderItem = "DELETE FROM `ordered_items` WHERE `order_id`='$order_id'";
    $spoj->query($sqlOrders);
    $spoj->query($sqlOrderItem);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style_dashboard.css">
    <title>Orders</title>
</head>

<body>

<?php include("./includes/dashboard_header.php"); ?>
<div class="order-content">
    <?php
    $sqlOrder = "SELECT * FROM orders";
    $resultOrder = $spoj->query($sqlOrder);

    if ($resultOrder->num_rows > 0) {
        while ($row = $resultOrder->fetch_assoc()) {
            $order_id = $row["id"];
            $sqlOrderItem = "SELECT * FROM `ordered_items` WHERE `order_id`='$order_id'";
            $resultOrderItem = $spoj->query($sqlOrderItem);
            $totalPrice = 0;
    ?>
            <div class="order">
                <div class="order-first-section">
                    <h2>Order No. <span><?php echo $order_id; ?></span></h2>
                    <form method="post">
                        <button class="remove-order-btn" type="submit" name="delete-order" value="<?php echo $order_id; ?>">Delete order</button>
                    </form>
                </div>
                <div>
                    <div class="info-order">
                        <p>First Name: <span><?php echo $row["name"]; ?></span></p>
                        <p>Last Name: <span><?php echo $row["surname"]; ?></span></p>
                        <p>Address: <span><?php echo $row["address"]; ?></span></p>
                        <p>E-mail: <a href="mailto:<?php echo $row["email"]; ?>"><?php echo $row["email"]; ?></a></p>
                    </div>
                    <div>
                        <h2 id="order-title">Ordered items: </h2>
                        <div class="ordered-items-container">
                            <?php
                            while ($rowItem = $resultOrderItem->fetch_assoc()) {
                                $item_id = $rowItem["item_id"];
                                $sqlProduct = "SELECT * FROM `products` WHERE `id`='$item_id'";
                                $resultProduct = $spoj->query($sqlProduct);
                                $product = $resultProduct->fetch_assoc();
                                $itemPrice = $product["price"] * $rowItem["quantity"];
                                $totalPrice += $itemPrice;
                            ?>
                                <div class="ordered-item">
                                    <h3><?php echo $product["name"]; ?></h3>
                                    <p> Price: <?php echo $product["price"]; ?>€</p>
                                    <p> Amount: <?php echo $rowItem["quantity"]; ?></p>
                                    <p> Total Price: <?php echo $itemPrice; ?>€</p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <p><b>Total Purchase Price: <?php echo $totalPrice; ?>€</b></p>
                </div>
            </div>
            <hr> 
    <?php
        }
    } else {
        echo '<p id="orders-message">There are no orders!</p>';
    }
    $spoj->close();
    ?>
</div>

</body>

</html>
