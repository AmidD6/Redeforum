<?php

function COMMENTS() {
session_start();
global $CONNECT, $Module, $Page, $Param;
if ($_SESSION['USER_LOGIN_IN'] != 1 and $_SESSION['USER_GROUP'] == -1) {
	$Admin = '  <a href="/comments/control/action/delete/id/'.$Row['id'].'" class="lol">        </a>   <a href="/comments/control/action/edit/id/'.$Row['id'].'" class="lol">          </a>';
	echo '<br><br>Залишати комменатріі можуть тільки зареєстровані користувачі.';}
else echo '<form method="POST" action="/comments/add/module/'.$Page.'/id/'.$Param['id'].'">
<div class="col-md-12"><div class="panel"><div class="panel-body purple-border">
<textarea class="form-control" style="background-color: #642a86; color: #fff; height: 100px" rows="2" name="text" placeholder="Текст повідомлення" required></textarea>
<input type="submit" name="enter" value="Надіслати"> <input type="reset" value="Очистити"></div></div></div>
</form>';

echo'<head><link href="/resource/comments.css" rel="stylesheet"></head>';

$ID = ModuleID($Page);
$Count = mysqli_fetch_row(mysqli_query($CONNECT, 'SELECT COUNT(`id`) FROM `comments` WHERE `module` = '.$ID.' AND `material` = '.$Param['id']));




if (!$Param['page']) {
$Param['page'] = 1;
$Result = mysqli_query($CONNECT, 'SELECT `id`, `uuid`, `id_user`, `added`, `date`, `text`, `activecom`, `himm`, `datehim`, `texthim` FROM `comments` WHERE `module` = '.$ID.' AND `material` = '.$Param['id'].' ORDER BY `id` DESC LIMIT 0, 9');

} else {
$Start = ($Param['page'] - 1) * 9;
$Result = mysqli_query($CONNECT, str_replace('START', $Start, 'SELECT `id`, `uuid`, `id_user`, `added`, `date`, `text`, `activecom`, `himm`, `datehim`, `texthim` FROM `comments` WHERE `module` = '.$ID.' AND `material` = '.$Param['id'].'  ORDER BY `id` DESC LIMIT START, 9'));

}
echo '<p style="margin-left: 200px">'. PageSelector("/$Page/$Module/id/$Param[id]/page/", $Param['page'], $Count).'</p>';

while ($Row = mysqli_fetch_assoc($Result)) {
	
if ($_SESSION['USER_GROUP'] == 2 or $_SESSION['USER_GROUP'] == 1) 
{$Admin = ' | <a href="/comments/control/action/delete/id/'.$Row['id'].'" class="lol">Видалити</a> | <a href="/comments/update/action/edit/id/'.$Row['id'].'" class="lol">Редагувати</a> ';}



if ($Row['id'] == $_SESSION['COMMENTS_EDIT']) {

$Row['text'] = '<form method="POST" action="/comments/update">
<div class="col-md-12"><div class="panel"><div class="panel-body">
<textarea class="form-control" style="background-color: #642a86; color: #fff" rows="2" name="text" placeholder="Текст повідомлення" required>'.$Row['text'].'</textarea><br><input type="submit" name="save" value="Зберегти"> <input type="submit" name="cancel" value="Відмінити"> <input type="reset" value="Очистити"><div><div><div></form>';}


if ($Row['id'] == $_SESSION['COMMENTS_EDITM']) {
	
echo '
<div class="ChatBlock"><span> <a href="/user/'.$Row['added'].'" class="lol">'.$Row['added'].'<a> '.$Group.' | '.$Row['date'].$Admin.'</span><br/><div class="ChatBlockAssemble">'.$_SESSION['UCOMM_TEXT'].'</div><br/><form method="POST" action="/comments/enter/module/'.$Page.'/id/'.$Param['id'].'"><textarea class="ChatMessage" name="textcontrol" class="form-control" placeholder="Текст повідомлення"></textarea><br><input type="submit" name="enterm" value="Надіслати"> <input type="reset" value="Очистити"> <input type="submit" name="cancel" value="Відмовити"></form></div>



';}



if ($_SESSION['USER_GROUP'] == 0) {
	if($_SESSION['USER_STORIS'] == 1) $Admin = '  <a href="/comments/control/action/delete/id/'.$Row['id'].'" class="lol">        </a>   <a href="/comments/control/action/edit/id/'.$Row['id'].'" class="lol">          </a> | <a href="/comments/control/action/editm/id/'.$Row['id'].'" class="lol">Відправити</a>';
	if($_SESSION['USER_STORIS'] == 0) $Admin = '  <a href="/comments/control/action/delete/id/'.$Row['id'].'" class="lol">        </a>   <a href="/comments/control/action/edit/id/'.$Row['id'].'" class="lol">          </a> | <a href="/comments/control/action/editm/id/'.$Row['id'].'" class="lol"> </a>';
	}
if ($_SESSION['USER_GROUP'] == -1) $Admin = '  <a href="/comments/control/action/delete/id/'.$Row['id'].'" class="lol">        </a>   <a href="/comments/control/action/edit/id/'.$Row['id'].'" class="lol">          </a>';

if ($Row['activecom'] == 1) {$Masas = '<br/>Цитата від '.$Row['himm'].'<div class="ChatBlockAssemble">'.$Row['texthim'].'</div><br/>';}
if ($Row['activecom'] == 0) $Masas = '';

$Av = mysqli_fetch_array(mysqli_query($CONNECT, "SELECT `avatar` FROM `users` WHERE `id` = '$Row[id_user]'"));

echo '

 <div class="panel-body">
 <!-- Содержание Новостей -->
 <!--===================================================-->
 <div class="media-block">
 <a class="media-left" href="/user/'.$Row['added'].'"><img class="img-circle img-sm" style="border-radius: 25% 10%;" src="/resource/avatar/'.$Av['avatar'].'.jpg"></a>
 <div class="media-body">
 <div class="mar-btm" style="padding-left: 10px">
 <a href="/user/'.$Row['added'].'">'.$Row['added'].'</a>
 <p class="text-muted text-sm"><i class="fa fa-clock-o"></i> - '.$Row['date'].'</p>
 </div>
<p style="overflow-x:hidden;">'.$Row['text'].'</p>
 <div class="pad-ver">
 <!--<div class="btn-group">
 <a class="btn btn-sm btn-default btn-hover-success" href="#"><i class="fa fa-thumbs-up"></i></a>
 <a class="btn btn-sm btn-default btn-hover-danger" href="#"><i class="fa fa-thumbs-down"></i></a>
 </div>
 <a href="/comments/control/action/editm/id/'.$Row['id'].'" class="lol">Відповісти</a>-->
<span> '.$Admin.'</span>
 </div>
 <hr></div>
 '.$Masas.'
 </div>
  </div>
';
}
$_SESSION['COM_UID'] = $Row['uuid'];
$_SESSION['COM_ID'] = $Row['id'];
}
?>
</html>