<?php 
$Param['id'] += 0;
if ($Param['id'] == 0) MessageSend(1, 'URL адреса вказана невірно.', '/forum');
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, 'SELECT `name`, `added`, `date`, `read`, `text`, `active` FROM `forum` WHERE `id` = '.$Param['id']));
if (!$Row['name']) MessageSend(1, 'Такої новини немає.', '/forum');
if (!$Row['active'] and $_SESSION['USER_GROUP'] != 2) MessageSend(1, 'Новина очікує активування.', '/forum');
mysqli_query($CONNECT, 'UPDATE `forum` SET `read` = `read` + 1 WHERE `id` = '.$Param['id']);
Head('Новини - '.$Row['name']);
?>

<style>

h2 {
	color: #9200c5;
	text-shadow: 1px 1px 10px #4b246a;
	text-align: justify;
}
p {
	color: #fff;
	text-shadow: 1px 1px 10px #000;
	text-align: justify;
	font-size: 120%;
}

.bcolor {
	color: #8916b1;
}
a {
	color: #8f0de1;
}
.bcol{
	color: #8f0de1;
}

li {
	text-align: justify;
}

</style>

<body><video id="myvid" src="/resource/img/mainlogo/background.mp4" autoplay muted loop></video>
<?php Menu();
MessageShow() ;

echo '<div style=" margin-right: 15px; margin-top: -25px;"><div class="row" ><div class="col-md" style="background-color: #0e1621">
<br>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb arr-right" style="background-color: #111b2f; margin-top: -8px; margin-left: -2px; margin-right: -15px; box-shadow: 1px 1px 10px #000;">
    <li class="breadcrumb-item "><a href="/" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;">Головна</a></li>
	<li class="breadcrumb-item "><a href="/forum" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;">Новини</a></li>
    <li class="breadcrumb-item text-light active" aria-current="page"><b>'.$Row['name'].'<b></li>
  </ol>
</nav>
</div></div></div>';

echo '<div class="col">
<br><br>
<div class="container" style="background-color: #111b2f; border-radius: 10px; padding: 20px; opacity: 0.9;">';
if (!$Row['active']) $Active = '| <a href="/forum/control/id/'.$Param['id'].'/command/active" class="lol">Активувати тему</a>';
if ($_SESSION['USER_GROUP'] == 2 or $_SESSION['USER_GROUP'] == 1) $EDIT = '| <a href="/forum/edit/id/'.$Param['id'].'" class="lol">Редагувати тему</a> | <a href="/forum/control/id/'.$Param['id'].'/command/delete" class="lol">Видалити тему</a>'.$Active;
if ($_SESSION['USER_GROUP'] == 0) $EDIT = '  <a href="/forum/edit/id/'.$Param['id'].'" class="lol">               </a>   <a href="/forum/control/id/'.$Param['id'].'/command/delete" class="lol">             </a>';
if($Row['added'] == $_SESSION['USER_LOGIN']) echo '<b class="bcolor">Переглядів: </b><b class="bcol">'.($Row['read'] + 1).'</b> <b class="bcolor">| Добавив: </b><a href="/profile" class="lol">'.$Row['added'].'<a><b class="bcolor"> | Дата: </b><b class="bcol">'.$Row['date'].' </b>'.$EDIT.'<br><hr style="border: 1px solid #771790"><br><h2>'.$Row['name'].'</h2><br><p>'.$Row['text'].'</p><br><hr style="border: 1px solid #771790">';
else echo '<b class="bcolor">Переглядів:</b> <b class="bcol">'.($Row['read'] + 1).'</b><b class="bcolor"> | Добавив:</b> <a href="/user/'.$Row['added'].'" class="lol">'.$Row['added'].'<a> <b class="bcolor">| Дата: </b><b class="bcol">'.$Row['date'].'</b> '.$EDIT.' <a style="float: right;color:" href="/sendadmin">Скарга</a><br><hr style="border: 1px solid #771790"><br><h2>'.$Row['name'].'</h2><br><p>'.$Row['text'].'</p><br><hr style="border: 1px solid #771790">';



$Nome = $Param['id'];
$Com = mysqli_query($CONNECT, 'SELECT SUM(`one`) AS `num` FROM `comments` WHERE `module` = 1 AND `material` = '.$Nome.'');
$Comres = mysqli_fetch_assoc($Com);
mysqli_query($CONNECT, "UPDATE `forum` SET `numnews` = '$Comres[num]' WHERE `id` = '$Nome'");
if ($Comres['num'] == 0) echo '<h3 style="color: #fff; text-shadow: 1px 1px 10px #000;">Відсутні коментарі</h3>';
else echo '<h4 style="color: #fff; text-shadow: 1px 1px 10px #000;">Коментарів ('.$Comres['num'].')</h4>';
COMMENTS();
echo '</div></div>';
?>
</body>
</html>