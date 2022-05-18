<?php 
$Catag = mysqli_query($CONNECT,'SELECT * FROM `categorymain`');
if ($Module == 'category' and $Param['id'] != 1 and $Param['id'] != 2 and $Param['id'] != 3 and $Param['id'] != 4 and $Param['id'] != 5 and $Param['id'] != 6) MessageSend(1, 'Такої категорії не існує.', '/forum');
$Param['page'] += 0;
Head('RedeForum - Новини');
?>
<body>

<style>
.form_radio_group {
	overflow: hidden;
}
.form_radio_group-item {
	display: inline-block;
	   
}
.form_radio_group input[type=radio] {
	display: none;
}
.form_radio_group label {
	display: inline-block;
	cursor: pointer;
	color: #000;
	padding: 0px 15px;
	line-height: 30px;
	border: 3px solid #600876;
	user-select: none;
	background: #7804a4;
	border-radius: 3px 3px 3px 3px;
	font-size: 110%
}
 
/* Checked */
.form_radio_group input[type=radio]:checked + label {
	background: #600876;
	border-radius: 3px 3px 3px 3px;
	width: auto;
	color: #fff;
}

.form_radio_group label:hover {
	color: #fff;

.form_radio_group input[type=radio]:disabled + label {
	background: #7804a4;
	
	color: #666;
}



</style>

<?php 
Menu($m3);
MessageShow();
?>
<link rel="stylesheet" href="https://cdn.rawgit.com/InventPartners/Checkbox2Button/master/css/checkbox2button.css" /> 
<script src="https://cdn.rawgit.com/InventPartners/Checkbox2Button/master/js/checkbox2button.min.js"></script>
<div style=" margin-right: 15px; margin-top: -25px;"><div class="row"><div class="col-md">

<br>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb arr-right" style="background-color: #111b2f; margin-top: -8px; margin-left: -2px; margin-right: -15px; box-shadow: 1px 1px 10px #000;">
    <li class="breadcrumb-item "><a href="/" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;">Головна</a></li>
    <li class="breadcrumb-item text-light active" aria-current="page"><b>Новини<b></li>
  </ol>
</nav> 


<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #111b2f; margin-right: -15px; box-shadow: 1px 1px 10px #000;">
    <button class="navbar-toggler btn-block" type="button" data-toggle="collapse" data-target="#catagorynews" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    Вибрати категорію</button>  <!--justify-content-center-->
    <div class="collapse navbar-collapse" id="catagorynews">
        <ul class="navbar-nav pull-left">
		<li class="nav-item" style="font-size: 90%; padding-top: 4px; "><a class="nav-link" href="/forum"><div">Усі категорії</a></li>
		<?php while ($Catahead = mysqli_fetch_assoc($Catag)) echo '<li class="nav-item" style="font-size: 90%; padding-top: 4px;"><a class="nav-link" href="/forum/category/id/'.$Catahead['id'].'">'.$Catahead['name'].'</a></li>'; 
		if ($_SESSION['USER_LOGIN_IN']) echo '<li><a class="nav-link" href="/forum/add"><button type="button" class="btn btn-sm btn-purple btn-block " style="background-color: #5d0c72"><b style="text-shadow: 1px 1px 10px #000;">Добавити новину<b></button></a></li>
		';
		?>
		</ul>
		<?php 
		echo '<ul class="navbar-nav ml-auto">'.SearchFormForum().'</ul>';
		?>
    </div>
</nav>
</div></div></div>
<!--                                    Основной блок                                -->
<div class="container-fluid">

<br>
<div class="container-fluid">
<div class="row">
 
	<!--<div class="col-lg-3" style="word-wrap: break-word;">
		<div class="container-fluid" style="background-color: #131a29; padding: 10px; border-radius: 6px; opacity: 0.8;">
		<nav class="navbar navbar-expand-lg navbar-dark unique-color-dark" style="background-color: #1c2331; border-radius: 6px;">
			<button class="navbar-toggler btn-block" type="button" data-toggle="collapse" data-target="#filtrs" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
			Параметри</button>
			
		<div class="collapse navbar-collapse" id="filtrs">
		
		<div class="form_radio_group">
		<br><?php SearchForm()?>
		<br><hr style="border: 1px solid; color: #fff">
		<h2 style="color: #fff; text-shadow: 1px 1px 10px #000;">Сортування</h2><br>
			<form method="post">
			<div class="form_radio_group-item">
				<input id="radio-1" type="radio" name="radio" value="1">
				<label for="radio-1"><b>По даті: з верху до ниху</b></label>
			</div><<br><br>
			<div class="form_radio_group-item">
				<input id="radio-2" type="radio" name="radio" value="2">
				<label for="radio-2"><b>По даті: з низу до верху</b></label>
			</div><br><br>
			<div class="form_radio_group-item">
				<input id="radio-3" type="radio" name="radio" value="3">
				<label for="radio-3"><b>З найкращих до найгірших</b></label>
			</div><br><br>
			<div class="form_radio_group-item">
				<input id="radio-4" type="radio" name="radio" value="4">
				<label for="radio-4"><b>З найгірших до найкращих</b></label>
			</div><br><br>
			<button type="submit" class="btn btn-sm btn-purple btn-block " data-toggle="modal"><h6>Сортувати</h6></button>
		</form>
		</div>	
		
</div>		
</nav>
		</div><br>
	</div>-->
	<div class="col-lg-8" style="word-wrap: break-word;">
		<?php
	
/*if( isset( $_POST['radio'] ) ){
	switch ($_POST['radio']) {
	
		case '1':
				if (!$Module or $Module == 'main') {
if ($_SESSION['USER_GROUP'] != 2) $Active = 'WHERE `active` = 1';
$Param1 = 'SELECT `id`, `name`, `added`, `text`, `date`, `active` FROM `forum` '.$Active.' ORDER BY `date` DESC LIMIT 0, 5';
$Param2 = 'SELECT `id`, `name`, `added`, `text`, `date`, `active` FROM `forum` '.$Active.' ORDER BY `date` DESC LIMIT START, 5';
$Param3 = 'SELECT COUNT(`id`) FROM `forum`';
$Param4 = '/forum/main/page/';
} else if ($Module == 'category') {
if ($_SESSION['USER_GROUP'] != 2) $Active = 'AND `active` = 1';
$Param1 = 'SELECT `id`, `name`, `added`, `text`, `date`, `active` FROM `forum` WHERE `cat` = '.$Param['id'].' '.$Active.' ORDER BY `date` DESC LIMIT 0, 5';
$Param2 = 'SELECT `id`, `name`, `added`, `text`, `date`, `active` FROM `forum` WHERE `cat` = '.$Param['id'].' '.$Active.' ORDER BY `date` DESC LIMIT START, 5';
$Param3 = 'SELECT COUNT(`id`) FROM `forum` WHERE `cat` = '.$Param['id'];
$Param4 = '/forum/category/id/'.$Param['id'].'/page/';
}

$Count = mysqli_fetch_row(mysqli_query($CONNECT, $Param3));


PageSelector($Param4, $Param['page'], $Count);


		if (!$Param['page']) {
$Param['page'] = 1;
$Result = mysqli_query($CONNECT, $Param1);
} else {
$Start = ($Param['page'] - 1) * 5;
$Result = mysqli_query($CONNECT, str_replace('START', $Start, $Param2));
}


				if (!$Param['page']) {
					$Param['page'] = 1;
					$Result = mysqli_query($CONNECT, $Param1);
				} else {
					$Start = ($Param['page'] - 1) * 5;
					$Result = mysqli_query($CONNECT, str_replace('START', $Start, $Param2));
				}
		while ($Row = mysqli_fetch_assoc($Result)) {
		if (!$Row['active']) $Row['name'] .= ' <b style="color: red"> - (Чекає модерації)</b>';
		echo '<div class="container-fluid" style="background-color: #131a29; padding: 10px; border-radius: 6px; opacity: 0.8;">
		<h3 style="color: #9200c5; text-shadow: 1px 1px 10px #4b246a; text-align: justify;">'.$Row['name'].'</h3>
		<b style="color: #fff; font-size: 110%"><span>Добавив: '.$Row['added'].' | '.$Row['date'].'</span></b><br>
		<p style="color: #fff; text-align: justify; text-shadow: 1px 1px 10px #000; font-size: 120%;">'.substr($Row['text'],0,600).'...</p>
		<a style="font-size: 120%;" class="nav-link" href="/forum/material/id/'.$Row['id'].'"><button type="button" class="btn btn-sm btn-purple btn-block" style="background-color: #9200c5" data-toggle="modal"><b style="font-size: 140%; text-shadow: 1px 1px 10px #000;">Читати далі</b></button></a></div><br>
		
		';}
		break;
		case '2': 
						if (!$Module or $Module == 'main') {
if ($_SESSION['USER_GROUP'] != 2) $Active = 'WHERE `active` = 1';
$Param1 = 'SELECT `id`, `name`, `added`, `text`, `date`, `active` FROM `forum` '.$Active.' ORDER BY `date` LIMIT 0, 5';
$Param2 = 'SELECT `id`, `name`, `added`, `text`, `date`, `active` FROM `forum` '.$Active.' ORDER BY `date` LIMIT START, 5';
$Param3 = 'SELECT COUNT(`id`) FROM `forum`';
$Param4 = '/forum/main/page/';
} else if ($Module == 'category') {
if ($_SESSION['USER_GROUP'] != 2) $Active = 'AND `active` = 1';
$Param1 = 'SELECT `id`, `name`, `added`, `text`, `date`, `active` FROM `forum` WHERE `cat` = '.$Param['id'].' '.$Active.' ORDER BY `date` LIMIT 0, 5';
$Param2 = 'SELECT `id`, `name`, `added`, `text`, `date`, `active` FROM `forum` WHERE `cat` = '.$Param['id'].' '.$Active.' ORDER BY `date` LIMIT START, 5';
$Param3 = 'SELECT COUNT(`id`) FROM `forum` WHERE `cat` = '.$Param['id'];
$Param4 = '/forum/category/id/'.$Param['id'].'/page/';
} 


$Count = mysqli_fetch_row(mysqli_query($CONNECT, $Param3));


PageSelector($Param4, $Param['page'], $Count);


		if (!$Param['page']) {
$Param['page'] = 1;
$Result = mysqli_query($CONNECT, $Param1);
} else {
$Start = ($Param['page'] - 1) * 5;
$Result = mysqli_query($CONNECT, str_replace('START', $Start, $Param2));
}


				if (!$Param['page']) {
					$Param['page'] = 1;
					$Result = mysqli_query($CONNECT, $Param1);
				} else {
					$Start = ($Param['page'] - 1) * 5;
					$Result = mysqli_query($CONNECT, str_replace('START', $Start, $Param2));
				}
		while ($Row = mysqli_fetch_assoc($Result)) {
		if (!$Row['active']) $Row['name'] .= ' <b style="color: red"> - (Чекає модерації)</b>';
		echo '<div class="container-fluid" style="background-color: #131a29; padding: 10px; border-radius: 6px; opacity: 0.8;">
		<h3 style="color: #9200c5; text-shadow: 1px 1px 10px #4b246a; text-align: justify;">'.$Row['name'].'</h3>
		<b style="color: #fff; font-size:110%"><span>Добавив: '.$Row['added'].' | '.$Row['date'].'</span></b><br>
		<p style="color: #fff; text-align: justify; font-size: 120%;">'.substr($Row['text'],0,600).'...</p>
		<a class="nav-link" href="/forum/material/id/'.$Row['id'].'"><button type="button" class="btn btn-sm btn-purple btn-block" style="background-color: #9200c5" data-toggle="modal"><b style="font-size: 140%; text-shadow: 1px 1px 10px #000;">Читати далі</b></button></a></div><br>
		
		';}
		break;
		
		
	
	}		
}else {*/
	if (!$Module or $Module == 'main') {
if ($_SESSION['USER_GROUP'] != 2 or $_SESSION['USER_GROUP'] != 1) $Active = 'WHERE `active` = 1';
$Param1 = 'SELECT `id`, `name`, `added`, `text`, `date`, `active` FROM `forum` '.$Active.' ORDER BY `id` DESC LIMIT 0, 9';
$Param2 = 'SELECT `id`, `name`, `added`, `text`, `date`, `active` FROM `forum` '.$Active.' ORDER BY `id` DESC LIMIT START, 9';
$Param3 = 'SELECT COUNT(`id`) FROM `forum`';
$Param4 = '/forum/main/page/';
} else if ($Module == 'category') {
if ($_SESSION['USER_GROUP'] != 2 or $_SESSION['USER_GROUP'] != 1) $Active = 'AND `active` = 1';
$Param1 = 'SELECT `id`, `name`, `added`, `text`, `date`, `active` FROM `forum` WHERE `cat` = '.$Param['id'].' '.$Active.' ORDER BY `id` DESC LIMIT 0, 9';
$Param2 = 'SELECT `id`, `name`, `added`, `text`, `date`, `active` FROM `forum` WHERE `cat` = '.$Param['id'].' '.$Active.' ORDER BY `id` DESC LIMIT START, 9';
$Param3 = 'SELECT COUNT(`id`) FROM `forum` WHERE `cat` = '.$Param['id'];
$Param4 = '/forum/category/id/'.$Param['id'].'/page/';
}

$Count = mysqli_fetch_row(mysqli_query($CONNECT, $Param3));


PageSelector($Param4, $Param['page'], $Count);


		if (!$Param['page']) {
$Param['page'] = 1;
$Result = mysqli_query($CONNECT, $Param1);
} else {
$Start = ($Param['page'] - 1) * 9;
$Result = mysqli_query($CONNECT, str_replace('START', $Start, $Param2));
}


				if (!$Param['page']) {
					$Param['page'] = 1;
					$Result = mysqli_query($CONNECT, $Param1);
				} else {
					$Start = ($Param['page'] - 1) * 9;
					$Result = mysqli_query($CONNECT, str_replace('START', $Start, $Param2));
				}
		while ($Row = mysqli_fetch_assoc($Result)) {
		if (!$Row['active']) $Row['name'] .= ' <b style="color: red"> - (Чекає модерації)</b>';
		echo '<div class="container-fluid" style="background-color: #111b2f; box-shadow: 1px 1px 10px #000; padding: 10px; border-radius: 6px; ">
		<h3 style="color: #9200c5; text-shadow: 1px 1px 10px #000; text-align: justify; ">'.$Row['name'].'</h3>
		<b style="color: #fff; font-size: 110%"><span>Добавив: '.$Row['added'].' | '.$Row['date'].'</span></b><br><br>
		<p style="color: #fff; text-align: justify; text-shadow: 1px 1px 10px #000; font-size: 110%;">'.mb_substr($Row['text'],0,600,'UTF-8').'...</p>
		<a class="nav-link" href="/forum/material/id/'.$Row['id'].'" style="font-size: 120%"><button type="button" class="btn btn-sm btn-purple btn-block" style="background-color: #5d0c72" data-toggle="modal"><b style="font-size: 140%; text-shadow: 1px 1px 10px #000;">Читати далі</b></button></a></div><br>
		
		';}
	
//}

	?>
	</div>
<!--	<div class="col-lg-4" style="word-wrap: break-word;">
	<?php 
	$Resulttrend = mysqli_query($CONNECT, 'SELECT * FROM `forum` WHERE ');
	
	
	echo' <div style="display: block; background-color: #5e0b8e; padding: 5px; border-top-left-radius: 6px; border-top-right-radius: 6px;"><h3 style="text-align: center; color: #000">Популярна новина</h3></div>
			<div class="container-fluid" style="background-color: #131a29; padding: 10px; border-radius: 6px; opacity: 0.8;">';
						
		/*	$Roww = mysqli_query($CONNECT, "SELECT * FROM `forum` ORDER BY `numnews`");
			while ($Pop =  mysql_fetch_row($Roww)) {

		echo '
		<h3 style="color: #9200c5; text-shadow: 1px 1px 10px #4b246a; text-align: justify; ">'.$Pop['name'].'</h3>
		<b style="color: #fff; font-size: 110%"><span>Добавив: '.$Pop['added'].' | '.$Pop['date'].'</span></b><br>
		<p style="color: #fff; text-align: justify; text-shadow: 1px 1px 10px #000; font-size: 120%;">'.substr($Pop['text'],0,600).'...</p>
		<a class="nav-link" href="/forum/material/id/'.$Pop['id'].'" style="font-size: 120%"><button type="button" class="btn btn-sm btn-purple btn-block" style="background-color: #9200c5" data-toggle="modal"><b style="font-size: 140%; text-shadow: 1px 1px 10px #000;">Читати далі</b></button></a></div><br>';
}*/
 ?>
			</div>
	</div>
	
</div>-->


</div>
</div>
<?php Footer() ?>
</body>
</html>