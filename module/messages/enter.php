<?php
ULogin(1);
$_SESSION['COMMENTS_EDITM'] = $Param['id'];
session_start();
$regValue = $_GET['regName'];
if ($_POST['enterm'] and $_POST['textcontrol']) {
$_POST['textcontrol'] = FormChars($_POST['textcontrol']);

$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, 'SELECT `id` FROM `forumtopic` WHERE `id` = '.$Param['id']));
if (!$Row['id']) MessageSend(1, 'Матеріал не найден.', '/forumtopic');
if ($_SESSION['USER_GROUP'] == -1) MessageSend(2, 'Адміністратор вас заблокувар. У вас немає можливості довавити коментарій.');
else {
mysqli_query($CONNECT, "DELETE FROM `ucomments` WHERE `id_uc` = $_SESSION[regName]");
mysqli_query($CONNECT, "INSERT INTO `messages`  VALUES ('', $_SESSION[regName], '$_SESSION[UCOMM_CATAG]', '$_SESSION[UCOMM_CATAL]', '$_SESSION[UCOMM_TOPIC]',  '$_SESSION[USER_ID]', '$_SESSION[USER_LOGIN]', '$_POST[textcontrol]', NOW(), 0, 0, 0, 0, 1, '$_SESSION[UCOMM_AD]', '$_SESSION[UCOMM_DATE]', '$_SESSION[UCOMM_TEXT]', 1, '$_SESSION[UCOMM_IMG]', '$_SESSION[UCOMM_VIDEO]', '$_SESSION[UCOMM_FILE]', 0, '', '')");
unset($_SESSION['COMMENTS_EDIT']);
MessageSend(3, 'Коментар доданий.', '/forummain/material/id/'.$Param['id']);

}	
}

if ($_POST['cancel']) {
mysqli_query($CONNECT, "DELETE FROM `ucomments` WHERE `id_uc` = $_SESSION[regName]");
unset($_SESSION['COMMENTS_EDITM']);
MessageSend(3, 'Відмінено коментар.');
}

?>