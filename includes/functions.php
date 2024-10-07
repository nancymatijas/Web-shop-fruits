<?php
function startSession() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

function getProducts($limit = 0) {
    global $spoj;
    $sql = "SELECT * FROM `products`";
    if ($limit > 0) {
        $sql .= " ORDER BY id DESC LIMIT $limit";
    }
    return $spoj->query($sql);
}

function getProductsSortedByPrice($order) {
    global $spoj;
    $sql = "SELECT * FROM `products` ORDER BY price $order";
    return $spoj->query($sql);
}

function renderProductCard($product) {
    return '
    <div class="product-card">
        <img src="' . $product["image"] . '" alt="' . $product["name"] . '">
        <div class="product-info">
            <h3>' . $product["name"] . '</h3>
            <div class="product-details">
                <span class="product-price">' . $product["price"] . '€</span>
                <a href="product.php?id=' . $product["id"] . '" class="btnAddAction">View More</a>
            </div>
        </div>
    </div>';
}

function isLoggedIn() {
    return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
}
?>
