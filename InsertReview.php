<?php
include_once '../config.php';
header('Content-Type: text/html; charset = UTF-8');
header('Content-Type: application/json; charset = utf8');
header('Content-Type: text/html; charset = utf-8');

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("connection failed");

mysqli_query($con, "set names utf8");

$NickName = $_POST['NickName'];
$WriterID = $_POST['WriterID'];
$Star = $_POST['Star'];
$Contents = $_POST['Contents'];
$Photo = $_POST['Photo'];

$sql_getid = "select * from UserInfo where Nickname = '".$NickName."'";
$result = mysqli_query($con, $sql_getid);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$Target = $row['ID'];

$sql = "insert into Review (Target, WriterID, WriteDate, Star, Contents, Photo) values ('".$Target."', '".$WriterID."', now(), ".$Star.", '".$Contents."', '".$Photo."')";

$result = mysqli_query($con, $sql);

if ($result) {
  echo "Success";
}
else {
  echo "Failure";
}

mysqli_close($con);

?>
