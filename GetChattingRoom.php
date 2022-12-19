<?php
include_once '../config.php';
header('Content-Type: text/html; charset = UTF-8');
header('Content-Type: application/json; charset = utf8');
header('Content-Type: text/html; charset = utf-8');

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("connection failed");

mysqli_query($con, "set names utf8");

$User = $_POST['User'];
$Opponent = $_POST['Opponent'];

$sql_update = "update Chatting set ReadCheck = true where SendUserID = '".$Opponent."' and ReceiveUserNickName = '".$User."'";

mysqli_query($con, $sql_update);

$sql = "select * from Chatting where (SendUserNickName = '".$User."' and ReceiveUserID = '".$Opponent."') or (SendUserID = '".$Opponent."' and ReceiveUserNickName = '".$User."')";

$result = mysqli_query($con, $sql);

$rowCnt = mysqli_num_rows($result);

$arr = array();

for($i = 0; $i  < $rowCnt; $i++) {
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $arr[$i] = $row;
}

$jsonData = json_encode(array("GetChattingRoom"=>$arr), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
echo "$jsonData";

mysqli_close($con);

?>
