<?php
include("./includes/db.php");
include("./includes/functions.php");
startSession();
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'asc';
$allProducts = getProductsSortedByPrice($sort);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Web Shop</title>
</head>
<body>
    <?php include("./includes/header.php"); ?>
    <div class="sort-products">
        <label for="sort">Sort by Price:</label>
        <select id="sort" onchange="sortProducts(this.value)">
            <option value="asc" <?php if ($sort == 'asc') echo 'selected'; ?>>Low to High</option>
            <option value="desc" <?php if ($sort == 'desc') echo 'selected'; ?>>High to Low</option>
        </select>
    </div>
    <div class="products-container">
        <?php
        if ($allProducts->num_rows > 0) {
            while ($product = $allProducts->fetch_assoc()) {
                echo renderProductCard($product);
            }
        } else {
            echo '<p>Sorry, there are no products available at the moment.</p>';
        }
        $spoj->close();
        ?>
    </div>
    <script>
        function sortProducts(order) {
            window.location.href = 'products.php?sort=' + order;
        }
    </script>
</body>
</html>
