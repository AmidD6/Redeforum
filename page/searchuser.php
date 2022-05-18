<?php 
if (!in_array($Module, array('user'))) MessageSend(1, 'Модуль не знайдено.', '/');


if ($_POST['enter']) {
$_SESSION['SEARCH'] = FormChars($_POST['text']);
exit(header('location: /searchuser/'.$Module));
}


if (!$_SESSION['SEARCH']) MessageSend(1, 'Слово для пошуку не вказано.', '/');
Head('Чат');
?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() 
?>
<div class="Page">


<?php  
$Count = mysqli_fetch_row(mysqli_query($CONNECT, "SELECT COUNT(`id`) FROM `users` WHERE `login` LIKE '%$_SESSION[SEARCH]%' "));


if ($Count[0]) {
if (!$Param['page']) {
$Param['page'] = 1;
$Result = mysqli_query($CONNECT, "SELECT `id`, `login`, `name`, `email`, `country`, `group`, `regdate` FROM `users` WHERE `login` LIKE '%$_SESSION[SEARCH]%' ORDER BY `id` DESC LIMIT 0, 5");
} else {
$Start = ($Param['page'] - 1) * 5;
$Result = mysqli_query($CONNECT, str_replace('START', $Start, "SELECT `id`, `login`, `name`, `email`, `country`, `group`, `regdate` FROM `users` WHERE `login` LIKE '%$_SESSION[SEARCH]%' ORDER BY `id` DESC LIMIT START, 5"));
}


PageSelector("/search/$Module/page/", $Param['page'], $Count);
while ($Row = mysqli_fetch_assoc($Result)) {
$zdorov1=$Row['id'];
	$Draw .= '
<img src="/resource/avatar/'.$Row['avatar'].'/'.$Row['id'].'.jpg" width="120" height="120" alt="Аватар" align="left">
<div class="Block">
ID '.$Row['id'].' ('.UserGroup($Row['group']).') <b style="float: right;">Логін: '.$Row['login'].'</b>
<br>Ім`я '.$Row['name'].'
<br>Почта: '.HideEmail($Row['email']).'
<br>Країна: '.UserCountry($Row['country']).'
<br>Дата регістрації: '.$Row['regdate'].'
</div>
<a href="/pm/send?result=' . $zdorov1 .'" class="button ProfileB">Написати</a><br><br>
<div class="ProfileEdit">
</div>';
echo $Draw ;	
}
PageSelector("/search/$Module/page/", $Param['page'], $Count);
} else echo 'Нічого не знайдено.';
?>



</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>