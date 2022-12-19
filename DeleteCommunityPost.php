<?php
include_once '../config.php';
header('Content-Type: text/html; charset = UTF-8');
header('Content-Type: application/json; charset = utf8');
header('Content-Type: text/html; charset = utf-8');

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("connection failed");

mysqli_query($con, "set names utf8");

$CommunityNumber = $_POST['CommunityNumber'];

$sql = "delete from Community where Index_num = ".$CommunityNumber."";

$result = mysqli_query($con, $sql);

$sql2 = "delete from CommunityComments where CommunityNumber = ".$CommunityNumber."";

$result = mysqli_query($con, $sql2);

$sql3 = "delete from LikeInfo where CommunityNumber = ".$CommunityNumber."";

$result = mysqli_query($con, $sql3);

if ($result) {
  echo "Success";
}
else {
  echo "Failure";
}

mysqli_close($con);

?>
