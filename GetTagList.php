<?php
include_once '../config.php';
header('Content-Type: text/html; charset = UTF-8');
header('Content-Type: application/json; charset = utf8');
header('Content-Type: text/html; charset = utf-8');

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("connection failed");

mysqli_query($con, "set names utf8");

$json = json_decode(file_get_contents('php://input'), true);

$CommunityNumber = $json['CommunityNumber'];
$User = $json['User'];

$sql_writer = "select NickName from CommunityComments where CommunityNumber = ".$CommunityNumber."";

$result = mysqli_query($con, $sql_writer);

$rowCnt = mysqli_num_rows($result);

$arr = array();

if ($rowCnt > 0) {
  $tagTarget = array();

  for ($i = 0; $i < $rowCnt; $i++) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($User !== $row['NickName']) {
      $tagTarget[] = $row['NickName'];
    }
  }

  if (count($tagTarget) > 0) {
    $sql = "select * from UserInfo where Nickname = '".$tagTarget[0]."'";

    for ($i = 1; $i < count($tagTarget); $i++) {
      $sql += " or Nickname = '".$tagTarget[$i]."'";
    }
    $result = mysqli_query($con, $sql);
    $rowCnt = mysqli_num_rows($result);
    for($i = 0; $i  < $rowCnt; $i++) {
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $arr[$i] = $row;
    }
  }
}

$jsonData = json_encode(array("GetTagList"=>$arr), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
echo "$jsonData";

mysqli_close($con);

?>
