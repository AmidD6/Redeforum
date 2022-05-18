<?php
function COMMENTS() {
global $CONNECT, $Module, $Page, $Param;
if ($_SESSION['USER_LOGIN_IN'] != 1) echo '<br><br>Залишати комменатріі можуть тільки зареєстровані користувачі.';
else echo '<br><br><form method="POST" action="/comments/add/module/'.$Page.'/id/'.$Param['id'].'">
<textarea class="ChatMessage" name="text" placeholder="Текст повідомлення" required></textarea>
<br><input type="submit" name="enter" value="Надіслати"> <input type="reset" value="Очистити">
</form>';

$ID = ModuleID($Page);
$Count = mysqli_fetch_row(mysqli_query($CONNECT, 'SELECT COUNT(`id`) FROM `comments` WHERE `module` = '.$ID.' AND `material` = '.$Param['id']));

if (!$Param['page']) {
$Param['page'] = 1;
$Result = mysqli_query($CONNECT, 'SELECT `id`, `added`, `date`, `text` FROM `comments` WHERE `module` = '.$ID.' AND `material` = '.$Param['id'].' ORDER BY `id` DESC LIMIT 0, 5');
} else {
$Start = ($Param['page'] - 1) * 5;
$Result = mysqli_query($CONNECT, str_replace('START', $Start, 'SELECT `id`, `added`, `date`, `text` FROM `comments` WHERE `module` = '.$ID.' AND `material` = '.$Param['id'].' ORDER BY `id` DESC LIMIT START, 5'));
}

PageSelector("/$Page/$Module/id/$Param[id]/page/", $Param['page'], $Count);



while ($Row = mysqli_fetch_assoc($Result)) {
if ($_SESSION['USER_GROUP'] == 2 or $_SESSION['USER_GROUP'] == 1) $Admin = ' | <a href="/comments/control/action/delete/id/'.$Row['id'].'" class="lol">Видалити</a> | <a href="/comments/control/action/edit/id/'.$Row['id'].'" class="lol">Редагувати</a> | <a href="/comments/addm/action/editmessage/id/'.$Row['id'].'" class="lol">Відповісти</a> ';
if ($Row['id'] == $_SESSION['COMMENTS_EDIT']) $Row['text'] = '<form method="POST" action="/comments/control"><textarea class="ChatMessage" name="text" placeholder="Текст повідомлення" required>'.$Row['text'].'</textarea><br><input type="submit" name="save" value="Зберегти"> <input type="submit" name="cancel" value="Відмінити"> <input type="reset" value="Очистити"></form>';

if ($_SESSION['USER_GROUP'] == 0 or $_SESSION['USER_GROUP'] == -1) $Admin = ' | <a href="/comments/main/action/editmessage/id/'.$Row['id'].'" class="lol">Відповісти</a>  <a href="/comments/control/action/delete/id/'.$Row['id'].'" class="lol">        </a>   <a href="/comments/control/action/edit/id/'.$Row['id'].'" class="lol">          </a>';

if($Row['added'] == $_SESSION['USER_LOGIN']) echo '<div class="ChatBlock"><span> <a href="/profile" class="lol">'.$Row['added'].'<a> '.$Group.' | '.$Row['date'].$Admin.'</span>'.$Row['text'].'</div>';
else echo '<div class="ChatBlock"><span> <a href="/user/'.$Row['added'].'" class="lol">'.$Row['added'].'<a> '.$Group.' | '.$Row['date'].$Admin.'</span>'.$Row['text'].'</div>';
}

}
?>