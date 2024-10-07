<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webshop_lv4";

$spoj = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($spoj->connect_error) {
    die("Došlo je do greške: " . $spoj->connect_error);
}
?>
