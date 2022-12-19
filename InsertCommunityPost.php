<?php
include_once '../config.php';
header('Content-Type: text/html; charset = UTF-8');
header('Content-Type: application/json; charset = utf8');
header('Content-Type: text/html; charset = utf-8');

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("connection failed");

mysqli_query($con, "set names utf8");

$BoardName = $_POST['BoardName'];
$NickName = $_POST['NickName'];
$Title = $_POST['Title'];
$Contents = $_POST['Contents'];
$Photo = $_POST['Photo'];
$Price = $_POST['Price'];

$sql = "insert into Community (BoardName, NickName, Title, Contents, WriteDate, Views, Photo, Price) values ('".$BoardName."', '".$NickName."', '".$Title."', '".$Contents."', now(), 0, '".$Photo."', '".$Price."')";

$result = mysqli_query($con, $sql);

if ($result) {
  echo "Success";
}
else {
  echo "Failure";
}

mysqli_close($con);

?>
