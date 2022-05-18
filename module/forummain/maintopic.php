<?php 
$Param['id'] += 0;
if ($Param['id'] == 0) MessageSend(1, 'URL адреса вказана невірно.', '/forummain');
$Resuls = mysqli_query($CONNECT, 'SELECT `id`, `id_catag`, `active`, `name`, `id_user`, `author`, `date`, `topicnumber`, `messnumber`, `last_topic`, `last_mess` FROM `catagoryforum` WHERE `id` = '.$Param['id']);
$Row5 = mysqli_fetch_assoc($Resuls);
if (!$Row5['name']) MessageSend(1, 'Такої теми немає.', '/forummain');
if (!$Row5['active'] and $_SESSION['USER_GROUP'] != 2) MessageSend(1, 'Каталог очікує активування.', '/forummain');

session_start();
$_SESSION['catamain'] = $Row5['id_catag'];
$_SESSION['namecat'] = $Row5['name'];
$_SESSION['cataid'] = $Row5['id'];

$Catag = mysqli_query($CONNECT,'SELECT * FROM `categorymain`');
//if ($Module == 'category' and $Param['id'] != 1 and $Param['id'] != 2 and $Param['id'] != 3 and $Param['id'] != 4 and $Param['id'] != 5 and $Param['id'] != 6) MessageSend(1, 'Такий категорії не існує.', '/forum');
$Param['page'] += 0;


Head('RedeForum - Форум - '.$Row5['name']);

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

echo '
<div style=" margin-right: 15px; margin-top: -25px;"><div class="row"><div class="col-md">

<br>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb arr-right" style="background-color: #111b2f; margin-top: -8px; margin-left: -2px; margin-right: -15px; box-shadow: 1px 1px 10px #000;">
    <li class="breadcrumb-item "><a href="/" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;">Головна</a></li>
	<li class="breadcrumb-item "><a href="/forummain" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;">Форум</a></li>
    <li class="breadcrumb-item text-light active" aria-current="page"><b>'.$Row5['name'].'<b></li>
  </ol>
</nav> 

';
?>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #111b2f; margin-right: -15px; box-shadow: 1px 1px 10px #000;">
    <button class="navbar-toggler btn-block" type="button" data-toggle="collapse" data-target="#catagorynews" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    Параметри</button>  <!--justify-content-center-->
    <div class="collapse navbar-collapse" id="catagorynews">
        <ul class="navbar-nav pull-left">
		
		<?php
		if ($_SESSION['USER_LOGIN_IN']) echo '<li><a class="nav-link" href="/forummain/add"><button type="button" class="btn btn-sm btn-purple btn-block " style="background-color: #5d0c72" data-toggle="modal"><b style="font-size: 120%; text-shadow: 1px 1px 10px #000;">Добавити тему</b></button></a></li>';
		
		echo '<li><a class="nav-link"><button type="button" class="btn btn-sm btn-purple btn-block " style="background-color: #5d0c72" data-toggle="modal" data-target="#searchtopic"><b style="font-size: 120%; text-shadow: 1px 1px 10px #000;">Знайти ...</b></button></a></li>
		';
		if ($_SESSION['USER_GROUP'] == 2 or $_SESSION['USER_GROUP'] == 2) echo '
		<li class="nav-item" style="font-size: 90%; padding-top: 4px; "><a class="nav-link" href="/forummain/editcata/id/'.$_SESSION['cataid'].'"><i class="fa fa-pencil-square-o"></i> Редагувати каталог</a></li>
		<li class="nav-item" style="font-size: 90%; padding-top: 4px; "><a class="nav-link" href="/forummain/controlcat/id/'.$_SESSION['cataid'].'/command/delete"><i class="fa fa-trash-o"></i> Видалити каталог</a></li>
		';
		?>
		
		</ul>
		
    </div>
</nav>
</div></div></div>
<!--                                    Основной блок                                -->
<div class="container-fluid">

<br>
<div class="container-fluid">
<div class="row">
 

	<div class="col-lg" style="word-wrap: break-word;">
	<div class="container-fluid" style="background-color: #0b111e; border-radius: 6px; box-shadow: 1px 1px 10px #000;">
	<h2 style="color: #fff; text-shadow: 1px 1px 10px #000; margin-bottom: 20px">Список тем</h2>
				<?php
if (!$Module or $Module == 'maintopic') {
if ($_SESSION['USER_GROUP'] != 2) $Active = 'AND `active` = 1';
$Param1 = 'SELECT * FROM `forumtopic` WHERE `id_cat` = '.$Param['id'].' '.$Active.' ORDER BY `id` DESC LIMIT 0, 9'; 
$Param2 = 'SELECT * FROM `forumtopic` WHERE `id_cat` = '.$Param['id'].' '.$Active.' ORDER BY `id` DESC LIMIT START, 9';
$Param3 = 'SELECT COUNT(`id`) FROM `forumtopic`';
$Param4 = '/forummain/maintopic/page/';
} 
$a = mysqli_query($CONNECT, $Param3);
$Count = mysqli_fetch_row($a);


//PageSelector($Param4, $Param['page'], $Count);
//$Row2 = mysqli_fetch_assoc($Result1);

		if (!$Param['page']) {
$Param['page'] = 1;
$Result1 = mysqli_query($CONNECT, $Param1);
} else {
$Start = ($Param['page'] - 1) * 9;
$Result1 = mysqli_query($CONNECT, str_replace('START', $Start, $Param2)); 
} 


				if (!$Param['page']) {
					$Param['page'] = 1;
					$Result1 = mysqli_query($CONNECT, $Param1);
					
				} else {
					$Start = ($Param['page'] - 1) * 9;
					$Result1 = mysqli_query($CONNECT, str_replace('START', $Start, $Param2));
					
				} 
if (mysqli_num_rows($Result1)){
while ($Row2 = mysqli_fetch_assoc($Result1)) {
		
			if (!$Row2['active']) $Row2['topic'] .= ' <b style="color: red"> - (Чекає модерації)</b>';
			echo '<nav class="mb-4 navbar navbar-expand-lg" style="background-color: #111b2f; padding: 6px; border-radius: 6px; margin-bottom: 10px; box-shadow: 1px 1px 10px #000; font-size: 120%;">
	
<div class="d-flex flex-row bd-highlight">
<div class="p-2 bd-highlight">
		<img src="/resource/img/forum.png" class="rounded" width="70"></div>
		
		
		<ul class="navbar-nav ml-auto">
		
		<li  class="nav-item">
		<div class="p-2 bd-highlight">
		<a style="padding-left: 5px; color: #5d0c72; font-size: 110%;  text-shadow: 1px 1px 10px #000; text-align: left;" href="/forummain/material/id/'.$Row2['id'].'">'.$Row2['topic'].'</a><br>
		<b style="padding-left: 5px; color:#fff; font-size: 80%; text-shadow: 1px 1px 10px #000; text-align: left;"> Відповідей: '.$Row2['messnumber'].'</b>
		</div></li>
		
		</ul>
		
		
		</div>
		
		
		<div class="d-flex flex-row-reverse bd-highlight">
				 <div class="p-2 bd-highlight">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#forumm'.$Row2['id'].'">
                    <i class="fa fa-th-large" style="font-size: 150%; color: #5d0c73"></i>
                </button></div></div>
                <div class="collapse navbar-collapse" id="forumm'.$Row2['id'].'";>
                     <ul class="navbar-nav ml-auto">
						<li class="nav-item" style="">
						<div style="background-color: #172542; padding: 5px; border-radius: 6px; margin-left: 30px">
							<b style="color: #fff; padding-left: 15px; padding-right: 15px;"><span style="color: #69147f; font-weight: bold; text-shadow: 1px 1px 10px #000;">Дата:</span> '.$Row2['date'].'</b><br>
							<b style="color: #fff; padding-left: 15px; padding-right: 15px;"><span style="color: #69147f; font-weight: bold; text-shadow: 1px 1px 10px #000;">Автор:</span> '.$Row2['added'].'</b>
						
						</div>
						</li>
					</ul>
				</div>
		
		</nav>
		
	';}
}
else echo '<h5 style="color: #ff0000; text-shadow: 1px 1px 10px #000; margin-bottom: 20px; padding-bottom: 10px">Каталог пустий</h5>';	

	?>
	<br>
	</div>
	
	</div>
	
</div>


</div>
</div>

<div class="modal fade" id="searchtopic" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="background-color: #1a263c;">
      <div class="modal-header">
        <h3 class="modal-title" style="color: #8e24aa" id="cataloge">Панель для пошуку каталогів</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php SearchFormTopic();?>
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