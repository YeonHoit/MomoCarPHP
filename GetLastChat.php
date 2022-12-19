<?php
include_once '../config.php';
header('Content-Type: text/html; charset = UTF-8');
header('Content-Type: application/json; charset = utf8');
header('Content-Type: text/html; charset = utf-8');

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("connection failed");

mysqli_query($con, "set names utf8");

$UserID = $_POST['UserID'];
$OpponentNickName = $_POST['OpponentNickName'];

$sql_findID = "select * from UserInfo where Nickname = '".$OpponentNickName."'";

$result = mysqli_query($con, $sql_findID);

$user_row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$OpponentID = $user_row['ID'];

$sql = "select * from Chatting where (SendUserID = ".$UserID." and ReceiveUserID = ".$OpponentID.") or (SendUserID = ".$OpponentID." and ReceiveUserID = ".$UserID.") order by Index_num desc";

$result = mysqli_query($con, $sql);

$rowCnt = mysqli_num_rows($result);

$arr = array();

for($i = 0; $i  < $rowCnt; $i++) {
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $arr[$i] = $row;
}

$jsonData = json_encode(array("GetLastChat"=>$arr), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
echo "$jsonData";

mysqli_close($con);

?>
