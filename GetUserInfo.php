<?php
include_once '../config.php';
header('Content-Type: text/html; charset = UTF-8');
header('Content-Type: application/json; charset = utf8');
header('Content-Type: text/html; charset = utf-8');

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("connection failed");

mysqli_query($con, "set names utf8");

$ID = $_POST['ID'];
$Login = $_POST['Login'];

if (!file_exists("../img/".$ID."/")) {
  mkdir("../img/".$ID."");
}

$sql_select = "select * from UserInfo where ID = ".$ID."";

$result = mysqli_query($con, $sql_select);

$rowCnt = mysqli_num_rows($result);

if ($rowCnt == 0) {
  $sql_insert = "insert into UserInfo (ID, Login, Nickname, UserCar, Photo, Email, Phone, NoticeAlert, CommentAlert, LikeAlert, TagAlert, UserCarType) values ('".$ID."', '".$Login."', '', '', '', '', '', true, true, true, true, '')";
  mysqli_query($con, $sql_insert);
  $result = mysqli_query($con, $sql_select);
  $rowCnt = mysqli_num_rows($result);
}

$arr = array();

for($i = 0; $i  < $rowCnt; $i++) {
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $arr[$i] = $row;
}

$jsonData = json_encode(array("GetUserInfo"=>$arr), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
echo "$jsonData";

mysqli_close($con);

?>
