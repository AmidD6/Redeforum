<?php 
if ($_SESSION['USER_LOGIN'] == $_SESSION['TOPIC_ADDED']) UAccess(0);
else UAccess(1);

$iii = mysqli_query($CONNECT, "SELECT * FROM `catagoryforum` WHERE `id` = '$_SESSION[cataid]'");
$Row1 = mysqli_fetch_assoc($iii);
session_start();
$_SESSION['TOPIC_VID'] = $Row['video'];
$_SESSION['TOPIC_IMG'] = $Row['image'];
$_SESSION['TOPIC_FIL'] = $Row['file'];


if (!$Row1['name']) MessageSend(1, 'Каталог не знайдений', '/forummain');

if ($_POST['enter'] and $_POST['name'] and $_POST['cat']) {
$_POST['name'] = FormChars($_POST['name']);
$_POST['cat'] += 0;



mysqli_query($CONNECT, "UPDATE `catagoryforum` SET `name` = '$_POST[name]', `id_catag` = '$_POST[cat]' WHERE `id` = $_SESSION[cataid]");

SendNotice($Row1['author'], 'Ваш каталог '.$Row1['name'].' був відредагований', '/forummain/maintopic/id/'.$_SESSION['cataid']);

MessageSend(2, 'Каталог відредагована.', '/forummain/maintopic/id/'.$_SESSION['cataid']);
}

Head('Редагування теми') ?>
<body><video id="myvid" src="/resource/img/mainlogo/background.mp4" autoplay muted loop></video>

<?php Menu();
MessageShow()
?>
<div style=" margin-right: 15px; margin-top: -30px;"><div class="row" ><div style="" class="col-md">
<br><nav aria-label="breadcrumb">
  <ol class="breadcrumb arr-right" style="background-color: #111b2f; margin-top: -8px; margin-left: -2px; margin-right: -15px; ">
    <li class="breadcrumb-item "><a href="/" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;"><?php echo L6; ?></a></li>
	<li class="breadcrumb-item "><a href="/forummain" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;"><?php echo L1; ?></a></li>
    <li class="breadcrumb-item text-light active" aria-current="page"><b><?php echo L7; ?><b></li>
  </ol>
</nav> 
</div></div></div>

<div class="col align-self-center">
<br><br>
<div class="container " style="background-color: #131a29; border-radius: 6px; box-shadow: 1px 1px 10px #000;">
<br>
<form method="POST" action="/forummain/editcata">

<?php
if ($_SESSION['MU_LAN'] == 'ua') echo '<input type="text" name="name" maxlength="30" placeholder="Назва каталога" value="'.$Row1['name'].'"  style="color: #fff" required>';

if ($_SESSION['MU_LAN'] == 'en') echo '<input type="text" name="name" maxlength="30" placeholder="Catalog name" value="'.$Row1['name'].'" style="color: #fff" required>';

?>


<br><br><label style="color: #fff; font-size: 110%; text-shadow: 1px 1px 10px #000;"><?php echo L8; ?></label><select size="1" name="cat" class="form-control form-control-chosen" style="background-color: #81219a; color: #fff; text-shadow: 1px 1px 10px #000; cursor: pointer">
<?php 
if ($_SESSION['MU_LAN'] == 'ua'){
$Cat = mysqli_query($CONNECT,'SELECT * FROM `categorymain`');

while ($Row = mysqli_fetch_assoc($Cat)) echo ''.str_replace('value="'.$Row1['id_catag'], 'selected value="'.$Row1['id_catag'], '<option value="'.$Row['id'].'">'.$Row['name'].'</option>');
}
if ($_SESSION['MU_LAN'] == 'en'){
$Cat = mysqli_query($CONNECT,'SELECT * FROM `categorymain`');

while ($Row = mysqli_fetch_assoc($Cat)) echo ''.str_replace('value="'.$Row1['id_catag'], 'selected value="'.$Row1['id_catag'], '<option value="'.$Row['id'].'">'.$Row['name_en'].'</option>'); 
}
?>
</select>

<br>
<?php
if ($_SESSION['MU_LAN'] == 'ua') echo '<input type="submit" style="text-shadow: 1px 1px 10px #000;" name="enter" value="Змінити"> <a href="#"style="float: right; color: #fff; text-shadow: 1px 1px 10px #ff0000;">'.L9.'</a>';

if ($_SESSION['MU_LAN'] == 'en') echo '<input type="submit" style="text-shadow: 1px 1px 10px #000;" name="enter" value="Change"> <a href="#"style="float: right; color: #fff; text-shadow: 1px 1px 10px #ff0000;">'.L9.'</a>';

?>
</form>
<br>
</div>
</div>
</body>
</html>