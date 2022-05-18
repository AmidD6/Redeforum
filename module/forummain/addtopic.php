<?php 
if ($_SESSION['USER_GROUP'] ==-1 ) MessageSend(2, L4, '/forummain');

if ($_SESSION['USER_GROUP'] == 2 or $_SESSION['USER_GROUP'] == 1) $Active = 1;
else $Active = 0;
if ($_POST['enter'] and $_POST['name'] and $_POST['cat']) {
$_POST['name'] = FormChars($_POST['name']);
$_POST['cat'] += 0;
mysqli_query($CONNECT, "INSERT INTO `catagoryforum`  VALUES ('', $_POST[cat], $Active, '$_POST[name]', '$_SESSION[USER_ID]', '$_SESSION[USER_LOGIN]', NOW(), 0, 0, 0, 0)");

MessageSend(2, L5, '/forummain	');
}
Head('Redeforum - Створення каталога') ?>
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
<form method="POST" action="/forummain/addtopic">

<?php
if ($_SESSION['MU_LAN'] == 'ua') echo '<input type="text" name="name" maxlength="30" placeholder="Назва каталога" style="color: #fff" required>';

if ($_SESSION['MU_LAN'] == 'en') echo '<input type="text" name="name" maxlength="30" placeholder="Catalog name" style="color: #fff" required>';

?>


<br><br><label style="color: #fff; font-size: 110%; text-shadow: 1px 1px 10px #000;"><?php echo L8; ?></label><select size="1" name="cat" class="form-control form-control-chosen" style="background-color: #81219a; color: #fff; text-shadow: 1px 1px 10px #000; cursor: pointer">
<?php 
if ($_SESSION['MU_LAN'] == 'ua'){
$Cat = mysqli_query($CONNECT,'SELECT * FROM `categorymain`');

while ($Row = mysqli_fetch_assoc($Cat)) echo '<option value="'.$Row['id'].'">'.$Row['name'].'</option>'; 
}
if ($_SESSION['MU_LAN'] == 'en'){
$Cat = mysqli_query($CONNECT,'SELECT * FROM `categorymain`');

while ($Row = mysqli_fetch_assoc($Cat)) echo '<option value="'.$Row['id'].'">'.$Row['name_en'].'</option>'; 
}
?>
</select>

<br>
<?php
if ($_SESSION['MU_LAN'] == 'ua') echo '<input type="submit" style="text-shadow: 1px 1px 10px #000;" name="enter" value="Добавити"> <a href="#"style="float: right; color: #fff; text-shadow: 1px 1px 10px #ff0000;">'.L9.'</a>';

if ($_SESSION['MU_LAN'] == 'en') echo '<input type="submit" style="text-shadow: 1px 1px 10px #000;" name="enter" value="Add"> <a href="#"style="float: right; color: #fff; text-shadow: 1px 1px 10px #ff0000;">'.L9.'</a>';

?>
</form>
<br>
</div>
</div>

<?php Footer() ?>

</body>
</html>