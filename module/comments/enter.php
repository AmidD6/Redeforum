<?php
ULogin(1);
$_SESSION['COMMENTS_EDITM'] = $Param['id'];
session_start();
$regValue = $_GET['regName'];
if ($_POST['enterm'] and $_POST['textcontrol']) {
$_POST['textcontrol'] = FormChars($_POST['textcontrol']);
$ID = ModuleID($Param['module']);
if ($ID == 1) $Table = 'forum';
else if ($ID == 2) $Table = 'loads';
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, 'SELECT `id` FROM `'.$Table.'` WHERE `id` = '.$Param['id']));
if (!$Row['id']) MessageSend(1, 'Матеріал не найден.', '/'.$Param['module']);
if ($_SESSION['USER_GROUP'] == -1) MessageSend(2, 'Адміністратор вас заблокувар. У вас немає можливості довавити коментарій.');
else {
mysqli_query($CONNECT, "DELETE FROM `ucomments` WHERE `id_uc` = $_SESSION[regName]");
mysqli_query($CONNECT, "INSERT INTO `comments`  VALUES ('', $_SESSION[regName], $Param[id], $ID,  '$_SESSION[USER_ID]', '$_SESSION[USER_LOGIN]', '$_POST[textcontrol]', NOW(), 1, '$_SESSION[UCOMM_AD]', '$_SESSION[UCOMM_DATE]', '$_SESSION[UCOMM_TEXT]', 1)");
unset($_SESSION['COMMENTS_EDIT']);
MessageSend(3, 'Коментар доданий.', '/'.$Param['module'].'/material/id/'.$Param['id']);

}	
}

if ($_POST['cancel']) {
mysqli_query($CONNECT, "DELETE FROM `ucomments` WHERE `id_uc` = $_SESSION[regName]");
unset($_SESSION['COMMENTS_EDITM']);
MessageSend(3, 'Відмінено коментар.');
}

?>