<?php
include_once '../config.php';
header('Content-Type: text/html; charset = UTF-8');
header('Content-Type: application/json; charset = utf8');
header('Content-Type: text/html; charset = utf-8');

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("connection failed");

// $json = json_decode(file_get_contents('php://input'), true);

$ID = $_POST['ID'];
$Login = $_POST['Login'];

// $ID = $_POST['ID'];
// $Login = $_POST['Login'];

echo $ID;
echo '
';
echo $Login;
?>
