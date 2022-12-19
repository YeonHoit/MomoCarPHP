<?php
include_once '../config.php';
header('Content-Type: text/html; charset = UTF-8');
header('Content-Type: application/json; charset = utf8');
header('Content-Type: text/html; charset = utf-8');

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("connection failed");

mysqli_query($con, "set names utf8");

$ID = $_POST['ID'];
$target = $_POST['target'];
$value = $_POST['value'];
$before = $_POST['before'];

$sql = "update UserInfo set ".$target." = '".$value."' where ID = '".$ID."'";

$result = mysqli_query($con, $sql);

if ($target === 'Nickname') {
	$sql_alert_fromuser = "update Alert set FromUser = '".$value."' where FromUser = '".$before."'";
	$result = mysqli_query($con, $sql_alert_fromuser);

	$sql_alert_touser = "update Alert set ToUser = '".$value."' where ToUser = '".$before."'";
	$result = mysqli_query($con, $sql_alert_touser);

	$sql_chatting_sendusernickname = "update Chatting set SendUserNickName = '".$value."' where SendUserNickName = '".$before."'";
	$result = mysqli_query($con, $sql_chatting_sendusernickname);

	$sql_chatting_receiveusernickname = "update Chatting set ReceiveUserNickName = '".$value."' where ReceiveUserNickName = '".$before."'";
	$result = mysqli_query($con, $sql_chatting_receiveusernickname);

	$sql_community = "update Community set NickName = '".$value."' where NickName = '".$before."'";
	$result = mysqli_query($con, $sql_community);

	$sql_communitycomments = "update CommunityComments set NickName = '".$value."' where NickName = '".$before."'";
	$result = mysqli_query($con, $sql_communitycomments);
}

if($result){
	echo 'Success';
}
else {
	echo 'Failure';
}

mysqli_close($con);

?>
