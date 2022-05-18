<?php 
ULogin(1);

if ($Module == 'delete' and $Param['id']) {
$Param['id'] += 0;
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `uid` FROM `notice` WHERE `id` = $Param[id]"));
if (!$Row['uid']) MessageSend(1, 'Повідомлення не знайдено.', '/profile');
else if ($Row['uid'] != $_SESSION['USER_ID']) MessageSend(1, 'Доступ заборонений.', '/notice');
mysqli_query($CONNECT, "DELETE FROM `notice` WHERE `id` = $Param[id]");
MessageSend(1, 'Повідомлення видалено.', '/notice');
}
else if ($Module == 'deleteall'){
	mysqli_query($CONNECT, "DELETE FROM `notice` WHERE `uid` = $_SESSION[USER_ID]");
	MessageSend(1, 'Повідомлення усі видалені.', '/notice');
}

Head('Redeforum - Повідомлення') ?>
<body><video id="myvid" src="/resource/img/mainlogo/play.mp4" autoplay muted loop></video>

<?php Menu();
MessageShow() 
?>

<div style=" margin-right: 15px; margin-top: -25px;"><div class="row"><div class="col-md" style="background-color: #0e1621">

<br>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb arr-right" style="background-color: #111b2f; margin-top: -8px; margin-left: -2px; margin-right: -15px; box-shadow: 1px 1px 10px #000;">
    <li class="breadcrumb-item "><a href="/" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;">Головна</a></li>
    <li class="breadcrumb-item text-light active" aria-current="page"><b>Повідомлення<b></li>
  </ol>
</nav> 
</div></div></div>

<div class="col">
<br><br><br><br><br>
<div class="container" style="background-color: #0b111e;  border-radius: 6px; box-shadow: 1px 1px 10px #000;">

<div style="background-color: #6b1781; padding: 20px; border-radius: 6px; box-shadow: 1px 1px 10px #000;">
<h3 style="text-align: center; color: #000; font-weight: bold; text-shadow: 1px 1px 1px #000;">Недавні повідомлення</h3></div>





<?php 
$Count = mysqli_fetch_row(mysqli_query($CONNECT, "SELECT COUNT(`id`) FROM `notice` WHERE `uid` = $_SESSION[USER_ID]"));


if (!$Module) {
$Module = 1;
$Result = mysqli_query($CONNECT, "SELECT `id`, `status`, `date`, `text`, `ssilka` FROM `notice` WHERE `uid` = $_SESSION[USER_ID] ORDER BY `id` DESC LIMIT 0, 9");
} else {
$Start = ($Module - 1) * 9;
$Result = mysqli_query($CONNECT, str_replace('START', $Start, "SELECT `id`, `status`, `date`, `text`, `ssilka` FROM `notice` WHERE `uid` = $_SESSION[USER_ID] ORDER BY `id` DESC LIMIT START, 9"));
}


PageSelector('/notice/', $Module, $Count);


if (mysqli_num_rows($Result)){
	echo '<br><a href="/notice/deleteall/id/'.$Row['id'].'" style="font-size: 130%; color: #bf0a30"><i class="fa fa-trash-o"></i> Очистити все</a><br>';
while ($Row = mysqli_fetch_assoc($Result)) {
if ($Row['status']) $Status = '<b style="color: #246dff; font-size: 120%">Прочитано</b>';
else $Status = '<b style="color: #ff0000; font-size: 120%">Не прочитано</b>';
//if ();
echo '
<br>
<div class="container-fluid" style="background-color: #111b2f">
<div class="d-flex justify-content-between">
<div class="p-2 bd-highlight">'.$Status.' <p style="color: #fff; font-size: 90%;">'.$Row['date'].'</p></div> 

<div class="p-2 bd-highlight"><a href="/notice/delete/id/'.$Row['id'].'" style="font-size: 130%; color: #bf0a30"><i class="fa fa-trash-o"></i></a></div>
</div>
<p style="color: #fff; margin-top: -10px; padding-bottom: 20px; text-shadow: 1px 1px 10px #000; padding-left: 8px">'.$Row['text'].'</p>


</div>





-';
}
}
else echo '<h5 style="color: #ff0000; text-shadow: 1px 1px 10px #000; margin-bottom: 20px; padding-bottom: 10px; padding-top: 20px">Повідомлень немає</h5>';

mysqli_query($CONNECT, "UPDATE `notice` SET `status` = 1 WHERE `uid` = $_SESSION[USER_ID] AND `status` = 0");
?>


</div>
</div>

<?php Footer() ?>

</body>
</html>