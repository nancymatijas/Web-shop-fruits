<?php
include("./includes/db.php");
include("./includes/functions.php");
startSession();

if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (!empty($_POST["quantity"])) {
                $productById = $spoj->query("SELECT * FROM products WHERE id='" . $_GET["id"] . "'");
                $itemArray = $productById->fetch_assoc();
                if ($itemArray) {
                    if (!empty($_SESSION["cart_item"])) {
                        if (array_key_exists($itemArray["id"], $_SESSION["cart_item"])) {
                            $_SESSION["cart_item"][$itemArray["id"]]["quantity"] = min($_POST["quantity"], $itemArray["quantity"]);
                        } else {
                            $_SESSION["cart_item"][$itemArray["id"]] = array_merge($itemArray, ["quantity" => min($_POST["quantity"], $itemArray["quantity"])]);
                        }
                    } else {
                        $_SESSION["cart_item"][$itemArray["id"]] = array_merge($itemArray, ["quantity" => min($_POST["quantity"], $itemArray["quantity"])]);
                    }
                }
            }
            break;

        case "remove":
            if (!empty($_SESSION["cart_item"])) {
                unset($_SESSION["cart_item"][$_GET["id"]]);
                if (empty($_SESSION["cart_item"])) {
                    unset($_SESSION["cart_item"]);
                }
            }
            break;

        case "empty":
            unset($_SESSION["cart_item"]);
            break;
    }
}

function update_cart() {
    echo "<script>location.reload();</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Cart</title>
    <script>
        function validateQuantity(input) {
            if (input.value <= 0) {
                input.value = 1;
            }
        }
    </script>
</head>
<body>
    <?php include("./includes/header.php"); ?>
    <div class="cart-content">
        <?php
        if (isset($_SESSION["cart_item"])) {
            $total_quantity = 0;
            $total_price = 0;
            ?>
            <table class="tbl-cart" cellpadding="10" cellspacing="1">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Price</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($_SESSION["cart_item"] as $item) {
                        $item_price = $item["quantity"] * $item["price"];
                        ?>
                        <tr>
                            <td><?php echo $item["name"]; ?></td>
                            <td><img src="<?php echo $item["image"]; ?>" height="50" width="50"></td>
                            <td>
                                <form method="post" action="cart.php?action=add&id=<?php echo $item["id"]; ?>">
                                    <input type="number" name="quantity" value="<?php echo $item["quantity"]; ?>" size="2" min="1" onchange="validateQuantity(this); this.form.submit()" />
                                </form>
                            </td>
                            <td><?php echo "€ " . $item["price"]; ?></td>
                            <td><?php echo "€ " . number_format($item_price, 2); ?></td>
                            <td><a href="cart.php?action=remove&id=<?php echo $item["id"]; ?>" class="btnRemoveAction" onclick="update_cart()">Remove</a></td>
                        </tr>
                    <?php
                        $total_quantity += $item["quantity"];
                        $total_price += $item_price;
                    }
                    ?>
                    <tr>
                        <td colspan="2" align="right">Total:</td>
                        <td align="right"><?php echo $total_quantity; ?></td>
                        <td align="right" colspan="2"><strong><?php echo "€ " . number_format($total_price, 2); ?></strong></td>
                    </tr>
                </tbody>
            </table>
        <?php
        } else {
            ?>
            <div class="no-records">Your Cart is Empty</div>
        <?php
        }
        ?>
    </div>
    <div class="cart-nav">
        <a href="cart.php?action=empty" class="btnEmpty">Empty Cart</a>
        <a href="checkout.php" class="btnCheckout">Proceed to Checkout</a>
    </div>
</body>
</html>
