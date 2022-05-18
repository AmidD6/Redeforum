<?php

if ($Param['action'] == 'edit') {
$_SESSION['COMMENTS_EDIT'] = $Param['id'];
exit(header('location: '.$_SERVER['HTTP_REFERER']));

}
else if ($_POST['save']) {
	
	$ID = ModuleID($Param['module']);
if ($ID == 1) $Table = 'forum';
else if ($ID == 2) $Table = 'loads';

$Us = mysqli_fetch_assoc(mysqli_query($CONNECT, 'SELECT * FROM `comments` WHERE `id` = '.$_SESSION['COMMENTS_EDIT']));
mysqli_query($CONNECT, "UPDATE `comments` SET `text` = '$_POST[text]' WHERE `id` = $_SESSION[COMMENTS_EDIT]");
unset($_SESSION['COMMENTS_EDIT']);

SendNotice();

MessageSend(3, 'Коментар відредагований.');	

}

 else if ($_POST['cancel']) {
unset($_SESSION['COMMENTS_EDIT']);
MessageSend(3, 'Редагування скасований.');
exit(header('location: '.$_SERVER['HTTP_REFERER']));
}

?>