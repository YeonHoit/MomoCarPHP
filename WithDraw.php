<?php
include_once '../config.php';
header('Content-Type: text/html; charset = UTF-8');
header('Content-Type: application/json; charset = utf8');
header('Content-Type: text/html; charset = utf-8');

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("connection failed");

mysqli_query($con, "set names utf8");

$ID = $_POST['ID'];
$Nickname = $_POST['Nickname'];

$sql_count_update = "update WithDrawCount set count = count - 1";
mysqli_query($con, $sql_count_update);

$sql_count = "select * from WithDrawCount";
$result = mysqli_query($con, $sql_count);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = $row['count'];

$sql_UserInfo = "update UserInfo set ID = '".$count."', Login = '', Nickname = '알 수 없음', Photo = '', Email = '', Phone = '' where Nickname = '".$Nickname."'";
mysqli_query($con, $sql_UserInfo);

$sql_Community = "update Community set NickName = '알 수 없음' where NickName = '".$Nickname."'";
mysqli_query($con, $sql_Community);

$sql_CommunityComments = "update CommunityComments set NickName = '알 수 없음' where NickName = '".$Nickname."'";
mysqli_query($con, $sql_CommunityComments);

$sql_Chatting_Send = "update Chatting set SendUserID = '".$count."', SendUserNickName = '알 수 없음' where SendUserNickName = '".$Nickname."'";
mysqli_query($con, $sql_Chatting_Send);

$sql_Chatting_Receive = "update Chatting set ReceiveUserID = '".$count."', ReceiveUserNickName = '알 수 없음' where ReceiveUserNickName = '".$Nickname."'";
mysqli_query($con, $sql_Chatting_Receive);

$sql_Alert_From = "update Alert set FromUser = '알 수 없음' where FromUser = '".$Nickname."'";
mysqli_query($con, $sql_Alert_From);

$sql_Alert_To = "update Alert set ToUser = '알 수 없음' where ToUser = '".$Nickname."'";
mysqli_query($con, $sql_Alert_To);

$sql_LikeInfo = "update LikeInfo set ID = '".$count."' where ID = '".$ID."'";
mysqli_query($con, $sql_LikeInfo);

mysqli_close($con);

?>
