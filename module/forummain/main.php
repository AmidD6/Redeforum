<?php 



$Catag = mysqli_query($CONNECT,'SELECT * FROM `categorymain`');
$Param['id'] += 0;
//if ($Module == 'category' and $Param['id'] != 1 and $Param['id'] != 2 and $Param['id'] != 3 and $Param['id'] != 4 and $Param['id'] != 5 and $Param['id'] != 6) MessageSend(1, 'Такий категорії не існує.', '/forum');
$Param['page'] += 0;





Head('RedeForum -'.F);

?>
<body>

<style>


 a: hover {
		color: red;
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
    <li class="breadcrumb-item "><a href="/" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;"><?php echo L6;?></a></li>
    <li class="breadcrumb-item text-light active" aria-current="page"><b><?php echo F;?><b></li>
  </ol>
</nav> 


<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #111b2f; margin-right: -15px; box-shadow: 1px 1px 10px #000;">
    <button class="navbar-toggler btn-block" type="button" data-toggle="collapse" data-target="#catagorynews" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <?php echo Fil;?></button>  <!--justify-content-center-->
    <div class="collapse navbar-collapse" id="catagorynews">
        <ul class="navbar-nav pull-left">
		<li class="nav-item" style="font-size: 90%; padding-top: 4px; "><a class="nav-link" href="/forummain"><?php echo Cata;?></a></li>

		<?php 
		
		if (($_SESSION['USER_LOGIN_IN'] == 1) and $_SESSION['MU_LAN'] == 'ua') {
			
		while ($Catahead = mysqli_fetch_assoc($Catag)) echo '
		<li class="nav-item" style="font-size: 90%; padding-top: 4px;">
		<a class="nav-link" href="/forummain/category/id/'.$Catahead['id'].'">'.$Catahead['name'].'</a>
		</li>'; 
		}
		else if (($_SESSION['USER_LOGIN_IN'] == 1) and $_SESSION['MU_LAN'] == 'en'){
			
		while ($Catahead = mysqli_fetch_assoc($Catag)) echo '
		<li class="nav-item" style="font-size: 90%; padding-top: 4px;">
		<a class="nav-link" href="/forummain/category/id/'.$Catahead['id'].'">'.$Catahead['name_en'].'</a>
		</li>'; 
		}
		else {
			
		while ($Catahead = mysqli_fetch_assoc($Catag)) echo '
		<li class="nav-item" style="font-size: 90%; padding-top: 4px;">
		<a class="nav-link" href="/forummain/category/id/'.$Catahead['id'].'">'.$Catahead['name'].'</a>
		</li>'; 
		}
		
		
		
		if ($_SESSION['USER_LOGIN_IN']) echo '<li><a class="nav-link" href="/forummain/addtopic"><button type="button" class="btn btn-sm btn-purple btn-block " style="background-color: #5d0c72"><b style="font-size: 120%; text-shadow: 1px 1px 10px #000;">'.Stvor.'</b></button></a></li>
		';
		echo '<li><a class="nav-link"><button type="button" class="btn btn-sm btn-purple btn-block " style="background-color: #5d0c72" data-toggle="modal" data-target="#search"><b style="font-size: 120%; text-shadow: 1px 1px 10px #000;">'.Search.'</b></button></a></li>
		';
		?>
		</ul>
		
    </div>
</nav>
</div></div></div>
<br>	
<?php

if (!$Module or $Module == 'main') {
if ($_SESSION['USER_GROUP'] != 2) $Active = 'WHERE `active` = 1';
$Param1 = 'SELECT * FROM `catagoryforum` '.$Active.' ORDER BY `id` DESC LIMIT 0, 9';
$Param2 = 'SELECT * FROM `catagoryforum` '.$Active.' ORDER BY `id` DESC LIMIT START, 9';
$Param3 = 'SELECT COUNT(`id`) FROM `catagoryforum`';
$Param4 = '/forummain/main/page/';
} else if ($Module == 'category') {
if ($_SESSION['USER_GROUP'] != 2) $Active = 'AND `active` = 1';
$Param1 = 'SELECT * FROM `catagoryforum` WHERE `id_catag` = '.$Param['id'].' '.$Active.' ORDER BY `id` DESC LIMIT 0, 9';
$Param2 = 'SELECT * FROM `catagoryforum` WHERE `id_catag` = '.$Param['id'].' '.$Active.' ORDER BY `id` DESC LIMIT START, 9';
$Param3 = 'SELECT COUNT(`id`) FROM `catagoryforum` WHERE `id_catag` = '.$Param['id'];
$Param4 = '/forummain/category/id/'.$Param['id'].'/page/';
}

$Count = mysqli_fetch_row(mysqli_query($CONNECT, $Param3));

echo '<div class="container-fluid"><div class="container-fluid" style="background-color: #0b111e; border-radius: 6px; box-shadow: 1px 1px 10px #000;">
<h2 style="color: #fff; text-shadow: 1px 1px 10px #000; margin-bottom: 20px">'.FCat.'</h2>
';



PageSelector($Param4, $Param['page'], $Count);
echo '<div style="height: 10px"></div>';



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

?>

<!--                                    Основной блок                                -->
<!--Основний блок-->

		<?php 
if (mysqli_num_rows($Result)){
	while ($Row = mysqli_fetch_assoc($Result)) {
		
		
		$Numtop = mysqli_fetch_assoc(mysqli_query($CONNECT, 'SELECT SUM(`active`) AS `numm` FROM `forumtopic` WHERE `id_cat` ='.$Row['id']));
		mysqli_query($CONNECT,"UPDATE `catagoryforum` SET `topicnumber` = $Numtop[numm] WHERE `id` = $Row[id]");
		
		
		$Sumatop = mysqli_fetch_assoc(mysqli_query($CONNECT, 'SELECT SUM(`messnumber`) AS `resss` FROM `forumtopic` WHERE `id_cat` = '.$Row['id']));
mysqli_query($CONNECT, "UPDATE `catagoryforum` SET `messnumber` = $Sumatop[resss] WHERE `id` = $Row[id]");


		if (!$Row['active']) $Row['name'] .= ' <b style="color: red"> - '.Moder.'</b>  <a href="/forummain/controlcat/id/'.$Row['id'].'/command/active" style="color: #0eec49"><i class="fa fa-check-square-o"></i></a>';

		echo '<nav class="mb-4 navbar navbar-expand-lg" style="background-color: #111b2f; padding: 6px; border-radius: 6px; margin-bottom: 10px; box-shadow: 1px 1px 10px #000;">
		
		
<div class="d-flex flex-row bd-highlight">
<div class="p-2 bd-highlight">
		<img src="/resource/img/catalogmain.png" class="rounded" width="70"></div>
		

		<ul class="navbar-nav ml-auto">
		
		<li class="nav-item">
		<div class="p-2 bd-highlight" style="font-size: 120%;">
		<a style="padding-left: 3px; color: #5d0c72;  text-shadow: 1px 1px 10px #000; text-align: left;" href="/forummain/maintopic/id/'.$Row['id'].'">'.$Row['name'].'</a><br>
		<b style="padding-left: 5px; color:#fff; font-size: 80%; text-shadow: 1px 1px 10px #000; text-align: left;">'.Topics.' '.$Row['topicnumber'].',  '.Vidpov.' '.$Row['messnumber'].'</b>
		</div></li>
		
		</ul>
		</div>
		
		
		
		<div class="d-flex flex-row-reverse bd-highlight">
				 <div class="p-2 bd-highlight">
				 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#forumm'.$Row['id'].'">
                    <i class="fa fa-th-large" style="font-size: 150%; color: #5d0c73"></i>
                </button></div></div>
                <div class="collapse navbar-collapse" id="forumm'.$Row['id'].'";>
                     <ul class="navbar-nav ml-auto">
						<li class="nav-item">
						<div style="background-color: #172542; padding: 5px; border-radius: 6px; font-size: 120%; margin-left: 30px">
							<b style="color: #fff; padding-left: 15px; padding-right: 15px;"><span style="color: #69147f; font-weight: bold; text-shadow: 1px 1px 10px #000;">'.Date.'</span> '.$Row['date'].'</b><br>
							<b style="color: #fff; padding-left: 15px; padding-right: 15px;"><span style="color: #69147f; font-weight: bold; text-shadow: 1px 1px 10px #000;">'.Author.'</span> '.$Row['author'].'</b>
						
						</div>
						</li>
					</ul>
					
				</div>


		</nav>
		
	';
	}
}
else echo '<h5 style="color: #ff0000; text-shadow: 1px 1px 10px #000; margin-bottom: 20px; padding-bottom: 10px">'.FBottom.'</h5>';
	/*
	<div style="width: 100px; height: 30px; background-color: red">
						</div>
	<ul class="navbar-nav ">
                        <li class="nav-item" style="margin-top: 1px;"><div>
                            <b class="nav-link" style="color: #fff; text-shadow: 1px 1px 10px #000; font-size: 80%;"><b style="color: #69147f; text-shadow: 1px 1px 10px #000; font-size: 100%;">Дата:</b>  '.$Row['date'].'</b>
                        </div></li>
						 <li class="nav-item" style="margin-top:1px">
                            <b class="nav-link" style="color: #fff; text-shadow: 1px 1px 10px #000; font-size: 80%;"><b style="color: #69147f; text-shadow: 1px 1px 10px #000; font-size: 100%;">Автор:</b> '.$Row['author'].'</b>
                        </li>
						 <li class="nav-item" style="margin-top:1px">
                            <b class="nav-link" style="color: #fff; text-shadow: 1px 1px 10px #000; font-size: 80%;"><b style="color: #69147f; text-shadow: 1px 1px 10px #000; font-size: 100%;">Остання тема:</b> '.$Row['last_topic'].'</b>
                        </li>
                        <li class="nav-item" style="margin-top: 1px">
                            <b class="nav-link" style="color: #fff; text-shadow: 1px 1px 10px #000; font-size: 80%;"><b style="color: #69147f; text-shadow: 1px 1px 10px #000; font-size: 100%;">Форум</b> '.$Row['last_mess'].'</b>
                        </li>
					</ul>*/
	
	
	/*	while ($Row = mysqli_fetch_assoc($Result)) {
		if (!$Row['active']) $Row['name'] .= ' <b style="color: red"> - (Чекає модерації)</b>';
		echo '<div style="background-color: #111b2f; padding: 6px; border-radius: 6px; margin-bottom: 10px;">
		<img src="/resource/img/forum.png" class="rounded" width="80">
		<a class="nav-link" style="color: #5d0c72; text-shadow: 1px 1px 10px #4b246a; text-align: justify;" href="/forummain/maintopic/id/'.$Row['id'].'">'.$Row['name'].'</a>
		<b style="color: #fff; font-size: 110%"><span>Добавив: '.$Row['added'].' | '.$Row['date'].'</span></b><br>
		<p style="color: #fff; text-align: justify; text-shadow: 1px 1px 10px #000; font-size: 120%;">'.substr($Row['text'],0,600).'...</p>
	</div>
		
	';}*/

	

echo '<br></div></div>';


?>


</div>
</div>

<div class="modal fade" id="cataloge" tabindex="-1" role="dialog" aria-labelledby="cataloge" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content" style="background-color: #1a263c;">
				<div class="modal-header">
					<h1 class="modal-title" style="color: #8e24aa" id="cataloge">Панель для створення каталога</h1>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
				<form method="POST" action="">
				<input type="text" name="name" placeholder="Назва каталога" style="color: #fff" required>
				<label style="color: #fff; font-size: 110%; text-shadow: 1px 1px 10px #000;">Виберіть розділ</label><select size="1" name="cat" class="form-control form-control-chosen" style="background-color: #81219a; color: #fff; text-shadow: 1px 1px 10px #000; cursor: pointer">
				<?php 
				$Catag = mysqli_query($CONNECT,'SELECT * FROM `categorymain`');
				while ($Catahead = mysqli_fetch_assoc($Catag)) echo '<option value="'.$Catahead['id'].'">'.$Catahead['name'].'</option>'; 
				?>
				</select>
				</div>
				<div class="modal-footer">
				<button class="btn btn-md btn-secondary" data-dismiss="modal">Закрити</button>
				<input type="reset" class="btn btn-md btn-purple" value="Очистити">
				<input type="submit" name="enter" class="btn btn-md btn-purple" value="Створити">
				</div></form>
			</div>
		</div>
</div>


<div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="background-color: #1a263c;">
      <div class="modal-header">
        <h3 class="modal-title" style="color: #8e24aa" id="cataloge">Панель для пошуку каталогів</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php SearchFormForum();?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
    </div>
  </div>
</div>

<?php Footer() ?>
</body>
</html>