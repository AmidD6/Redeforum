<?php

if ($Param['action'] == 'edit') {
$_SESSION['COMMENTS_EDIT'] = $Param['id'];
exit(header('location: '.$_SERVER['HTTP_REFERER']));

}
else if ($_POST['save']) {
mysqli_query($CONNECT, "UPDATE `messages` SET `text` = '$_POST[text]' WHERE `id` = '$_SESSION[COMMENTS_EDIT]'");
unset($_SESSION['COMMENTS_EDIT']);
MessageSend(3, 'Коментар відредагований.');	

}

 else if ($_POST['cancel']) {
unset($_SESSION['COMMENTS_EDIT']);
MessageSend(3, 'Редагування скасований.');
exit(header('location: '.$_SERVER['HTTP_REFERER']));
}

?>