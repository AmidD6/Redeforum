<?php 
if ($Module) {
$Module = FormChars($Module);
$Info = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id`, `name`, `email`, `country`, `regdate`, `group` FROM `users` WHERE `login` = '$Module'"));
if (!$Info['id']) MessageSend(1, 'Користувач не знайдено.', '/user');

$Avatar = "$Info[id]";
echo '<div class="userdialog"><?php SearchFormUser()?> <a style="margin-right: 5px; float: right;" href="/pm/dialog" class="button ProfileB">Мої діалоги</a></div><br/>';
$Query1 = mysqli_query($CONNECT, 'SELECT `id`, `cat`, `dimg`, `name`, `added`, `iduser` FROM `loads` WHERE `iduser` = '.$Info['id'].' ORDER BY `date` DESC'); 
while ($Row1 = mysqli_fetch_assoc($Query1)) $Men .= '<a href="/loads/material/id/'.$Row1['id'].'"><img src="/catalog/mini/'.$Row1['dimg'].'/'.$Row1['id'].'.jpg" class="lm" alt="'.$Row1['name'].'" title="'.$Row1['name'].'"></a>';
$zdorov=$Info['id'];

$Draw = '
<img src="/resource/avatar/'.$Avatar.'.jpg" width="120" height="120" alt="Аватар" align="left">
<div class="Block">
<b>Логін:</b> '.$Module.'  <b style="float: right;">('.UserGroup($Info['group']).')</b>
<br><b>Ім`я</b> '.$Info['name'].'
<br><b>Почта:</b> '.HideEmail($Info['email']).'
<br><b>Країна:</b> '.UserCountry($Info['country']).'
<br><b>Дата регістрації:</b> '.$Info['regdate'].'
</div>
<a href="/pm/send?result=' . $zdorov .'" class="button ProfileB">Написати</a><br><br>
<div class="ProfileEdit">
</div>
<h2> Проекти від '.$Module.':</h2><br/> 
'.$Men.'
';

} else {

$Query = mysqli_query($CONNECT, 'SELECT `id`, `login`, `name`, `email`, `country`, `group`, `regdate` FROM `users` WHERE `id` != '.$_SESSION['USER_ID'].' ORDER BY `id` DESC');
while ($Row = mysqli_fetch_assoc($Query)) {
$zdorov1=$Row['id'];
	$Draw .= '
<img src="/resource/avatar/'.$Row['id'].'.jpg" width="120" height="120" alt="Аватар" align="left">
<div class="Block">
<b>Логін:</b> <a href="/user/'.$Row['login'].'" class="lol">'.$Row['login'].'</a> <b style="float: right;">'.UserGroup($Row['group']).'</b>
<br><b>Ім`я:</b> '.$Row['name'].'
<br><b>Почта:</b> '.HideEmail($Row['email']).'
<br><b>Країна:</b> '.UserCountry($Row['country']).'
<br><b>Дата регістрації:</b> '.$Row['regdate'].'
</div>
<a href="/pm/send?result=' . $zdorov1 .'" class="button ProfileB">Написати</a><br><br>
<div class="ProfileEdit">
</div>';
}




}


Head('Користувачі') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow();
?>

<div class="Page">
<?php 
SearchFormUser(); 
echo '<a style="float: right; margin-right: 6px; width: 150px;" href="/pm/dialog" class="button ProfileB">Вихід із профіля</a>';
echo $Draw ;?>

</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>