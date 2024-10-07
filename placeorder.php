<?php
session_start();
include("./includes/functions.php");
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Successful order</title>
</head>

<body>
    <?php include("./includes/header.php"); ?>     
    <div class="successful-order-content">
        <img id="successful-order-logo" src="./imgs/pngegg.png" />
        <div class="order-outcome-content">
            <h2>Order Successful!</h2>
            <p>Thank you for your order.</p>
            <a href="index.php">Go back to home page</a>
        </div>
    </div>
</body>

</html>
