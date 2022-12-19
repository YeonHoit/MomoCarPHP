<?php
include_once '../config.php';
header('Content-Type: text/html; charset = UTF-8');
header('Content-Type: application/json; charset = utf8');
header('Content-Type: text/html; charset = utf-8');

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("connection failed");

mysqli_query($con, "set names utf8");

$Title = $_POST['Title'];
$Contents = $_POST['Contents'];
$AlertType = $_POST['AlertType'];
$FromUser = $_POST['FromUser'];
$ToUser = $_POST['ToUser'];
$Target_num = $_POST['Target_num'];

$sql = "insert into Alert (Title, Contents, AlertDate, AlertType, FromUser, ToUser, Target_num) values ('".$Title."', '".$Contents."', now(), '".$AlertType."', '".$FromUser."', '".$ToUser."', ".$Target_num.")";

$result = mysqli_query($con, $sql);

if ($result) {
  echo "Success";
}
else {
  echo "Failure";
}

mysqli_close($con);

?>
