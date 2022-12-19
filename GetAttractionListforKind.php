<?php
include_once '../config.php';
header('Content-Type: text/html; charset = UTF-8');
header('Content-Type: application/json; charset = utf8');
header('Content-Type: text/html; charset = utf-8');

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("connection failed");

mysqli_query($con, "set names utf8");

$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$kind = $_POST['kind'];

$sql = "SELECT *
FROM (
SELECT *, (6371 * acos(cos(radians(".$latitude.")) * cos(radians(Lat)) * cos(radians(`Long`) - radians(".$longitude.")) + sin(radians(".$latitude.")) * sin(radians(Lat)))) AS distance
FROM Attraction
) DATA
WHERE DATA.distance < 50 AND Kind = '".$kind."'";

$result = mysqli_query($con, $sql);

$rowCnt = mysqli_num_rows($result);

$arr = array();

for($i = 0; $i  < $rowCnt; $i++) {
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $arr[$i] = $row;
}

$jsonData = json_encode(array("GetAttractionList"=>$arr), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
echo "$jsonData";

mysqli_close($con);

?>
