<?php
include_once '../config.php';
header('Content-Type: text/html; charset = UTF-8');
header('Content-Type: application/json; charset = utf8');
header('Content-Type: text/html; charset = utf-8');

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("connection failed");

mysqli_query($con, "set names utf8");

$CommunityNumber = $_POST['CommunityNumber'];
$BoardName = $_POST['BoardName'];
$Title = $_POST['Title'];
$Contents = $_POST['Contents'];
$Photo = $_POST['Photo'];
$Price = $_POST['Price'];

$sql = "update Community set BoardName = '".$BoardName."', Title = '".$Title."', Contents = '".$Contents."', Photo = '".$Photo."', Price = '".$Price."' where Index_num = ".$CommunityNumber."";

$result = mysqli_query($con, $sql);

if ($result) {
  echo "Success";
}
else {
  echo "Failure";
}

mysqli_close($con);

?>
