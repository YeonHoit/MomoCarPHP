<?php
include_once '../config.php';
header('Content-Type: text/html; charset = UTF-8');
header('Content-Type: application/json; charset = utf8');
header('Content-Type: text/html; charset = utf-8');

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("connection failed");

mysqli_query($con, "set names utf8");

$Target = $_POST['Target'];
$WriterID = $_POST['WriterID'];
$Star = $_POST['Star'];
$Contents = $_POST['Contents'];
$Photo = $_POST['Photo'];

$sql = "insert into AttractionReview (Target, WriterID, WriteDate, Star, Contents, Photo) values (".$Target.", '".$WriterID."', now(), ".$Star.", '".$Contents."', '".$Photo."')";

$result = mysqli_query($con, $sql);

if ($result) {
  echo "Success";
}
else {
  echo "Failure";
}

mysqli_close($con);

?>
