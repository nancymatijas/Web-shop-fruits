<?php
session_start();
include("./includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_email = $spoj->real_escape_string($_POST['email']);
    $admin_password = hash('sha256', $_POST['password']);

    $stmt = $spoj->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->bind_param("s", $admin_email);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin_data = $result->fetch_assoc();
    $stmt->close();

    if ($admin_data && $admin_password == $admin_data['password']) {
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $admin_email;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: dashboard.php");
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
    <title>Login</title>
</head>
<body>
<nav class="nav-web-shop">
    <h1><a href="index.php">Web Shop</a></h1>
</nav>
<div class="login-form">
        <form action="" method="post">
            <h2 class="text-center">Log in</h2>
            <?php if (isset($error)) { echo '<div class="error">'.$error.'</div>'; } ?>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="E-mail" required="required" name="email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" required="required" name="password">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Log in</button>
            </div>
        </form>
    </div>
</body>
</html>
