<?php
$Rows = mysqli_fetch_assoc(mysqli_query($CONNECT, 'SELECT `id`, `added`, `date`, `text` FROM `comments` WHERE `id` = '.$Param['id'].''));
session_start();
$_SESSION['regName'] = $Param['id'];
$_SESSION['UCOMM_TEXT'] = $Rows['text'];
$_SESSION['UCOMM_ADDED'] = $Rows['added'];
$_SESSION['UCOMM_AD'] = $Rows['added'];
$_SESSION['UCOMM_ID'] = $Rows['id'];
$_SESSION['UCOMM_DATE'] = $Rows['date'];


if ($Param['action'] == 'delete') {
mysqli_query($CONNECT, "DELETE FROM `comments` WHERE `id` = $Param[id]");
MessageSend(3, 'Коментарій видалено.');
} 


else if ($Param['action'] == 'editm') {
$_SESSION['COMMENTS_EDITM'] = $Param['id'];
mysqli_query($CONNECT, "INSERT INTO `ucomments`  VALUES ('$Param[id]', 0, '$Rows[added]', '$Rows[date]', '$Rows[text]', 0, 0, 0 )");
$Param['id'];

exit(header('location: '.$_SERVER['HTTP_REFERER']));

} 



?>