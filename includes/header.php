<nav class="nav-web-shop">
    <h1><a href="index.php">Web Shop</a></h1>
    <div class="nav-menu">
        <?php
        if (isset($_SESSION["cart_item"])) {
            $cart_count = count($_SESSION["cart_item"]);
            ?><a class="cart-a" href="cart.php"><img src="./imgs/cart.png" alt="Cart"/><span><?php echo $cart_count; ?></span></a><?php
        }
        ?>
        <a href="products.php">Products</a>
        <?php
        if (!isLoggedIn()) {
            echo '<a href="login.php">Login</a>';
        } else {
            echo '<a href="dashboard.php">Dashboard</a>';
        }
        ?>
    </div>
</nav>
