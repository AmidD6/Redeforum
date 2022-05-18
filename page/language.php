<?php

if ($_POST['lang'] and $_POST['lanu']){
	$_POST['lanu'] += 0;
	if ($_POST['lanu'] == 1) {mysqli_query($CONNECT, "UPDATE `users` SET `language` = 'ua' WHERE `id` = '$_SESSION[USER_ID]'");
	MessageSend(2, 'Веб-форум змінено на українську мову', '/');
	}
	if ($_POST['lanu'] == 2) {mysqli_query($CONNECT, "UPDATE `users` SET `language` = 'en' WHERE `id` = '$_SESSION[USER_ID]'");
	MessageSend(2, 'Веб-форум змінено на англійську мову', '/');
	}
	
	
}

?>