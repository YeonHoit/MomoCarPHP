<?php
include_once '../config.php';
header('Content-Type: text/html; charset = UTF-8');
header('Content-Type: application/json; charset = utf8');
header('Content-Type: text/html; charset = utf-8');

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("connection failed");

mysqli_query($con, "set names utf8");

$UserID = $_POST['UserID'];
$UserNickname = $_POST['UserNickname'];
$OpponentID = $_POST['OpponentID'];
$Message = $_POST['Message'];
$Photo = $_POST['Photo'];

$sql_select = "select Nickname from UserInfo where ID = '".$OpponentID."'";

$result = mysqli_query($con, $sql_select);

$rowCnt = mysqli_num_rows($result);

if ($rowCnt > 0) {
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $OpponentNickname = $row['Nickname'];
  $sql_insert = "insert into Chatting (SendUserID, SendUserNickName, ReceiveUserID, ReceiveUserNickName, SendDate, ReadCheck, Message, Photo) values ('".$UserID."', '".$UserNickname."', '".$OpponentID."', '".$OpponentNickname."', now(), false, '".$Message."', '".$Photo."')";
  $result = mysqli_query($con, $sql_insert);
}

if ($result) {
  echo "Success";
}
else {
  echo "Failure";
}

mysqli_close($con);

?>
