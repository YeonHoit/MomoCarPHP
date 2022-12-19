<?php
include_once '../config.php';
header('Content-Type: text/html; charset = UTF-8');
header('Content-Type: application/json; charset = utf8');
header('Content-Type: text/html; charset = utf-8');

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("connection failed");

mysqli_query($con, "set names utf8");

$Token = $_POST['Token'];
$ID = $_POST['ID'];

$sql_select = "select * from DeviceInfo where Token = '".$Token."'";

$result = mysqli_query($con, $sql_select);

$rowCnt = mysqli_num_rows($result);

if ($rowCnt == 0) {
  $sql_insert = "insert into DeviceInfo (Token, ID) values ('".$Token."', '".$ID."')";
  $result = mysqli_query($con, $sql_insert);
}
else {
  $sql_update = "update DeviceInfo set ID = '".$ID."' where Token = '".$Token."'";
  $result = mysqli_query($con, $sql_update);
}

if ($result) {
  echo "Success";
}
else {
  echo "Failure";
}

mysqli_close($con);

?>
