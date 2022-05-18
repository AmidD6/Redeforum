<?php 
$Cata = mysqli_query($CONNECT,'SELECT * FROM `categorymain`');;

if ($_POST['enter']) {
$_SESSION['SEARCH'] = FormChars($_POST['text']);
exit(header('location: /searchtopic/main'));
}


if (!$_SESSION['SEARCH']) MessageSend(1, 'Слово для пошуку не вказано.', '/');
Head('RedeForum - Форум - Пошук тем');
?>
<body>
<?php Menu();
MessageShow() ;
echo '
<div style=" margin-right: 15px; margin-top: -25px;"><div class="row"><div class="col-md">

<br>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb arr-right" style="background-color: #111b2f; margin-top: -8px; margin-left: -2px; margin-right: -15px; box-shadow: 1px 1px 10px #000;">
    <li class="breadcrumb-item "><a href="/" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;">Головна</a></li>
	<li class="breadcrumb-item "><a href="/forummain" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;">Форум</a></li>
    <li class="breadcrumb-item text-light active" aria-current="page"><b>'.$_SESSION['namecat'].'<b></li>
  </ol>
</nav> ';
?>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #111b2f; margin-right: -15px; box-shadow: 1px 1px 10px #000;">
    <button class="navbar-toggler btn-block" type="button" data-toggle="collapse" data-target="#catagorynews" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    Вибрати категорію</button>  <!--justify-content-center-->
    <div class="collapse navbar-collapse" id="catagorynews">
        <ul class="navbar-nav pull-left">
		
			<?php
		if ($_SESSION['USER_LOGIN_IN']) echo '<li><a class="nav-link" href="/forummain/add"><button type="button" class="btn btn-sm btn-purple btn-block " style="background-color: #5d0c72" data-toggle="modal"><b style="font-size: 120%; text-shadow: 1px 1px 10px #000;">Добавити тему</b></button></a></li>';
		
		echo '<li><a class="nav-link"><button type="button" class="btn btn-sm btn-purple btn-block " style="background-color: #5d0c72" data-toggle="modal" data-target="#searchtopic"><b style="font-size: 120%; text-shadow: 1px 1px 10px #000;">Знайти ...</b></button></a></li>
		';
		if ($_SESSION['USER_GROUP'] == 2 or $_SESSION['USER_GROUP'] == 2) echo '
		<li class="nav-item" style="font-size: 90%; padding-top: 4px; "><a class="nav-link" href="/forummain"><i class="fa fa-pencil-square-o"></i> Редагувати каталог</a></li>
		<li class="nav-item" style="font-size: 90%; padding-top: 4px; "><a class="nav-link" href="/forummain"><i class="fa fa-trash-o"></i> Видалити каталог</a></li>
		';
		?>
    </div>
</nav>
</div></div></div>


<?php  
echo '<br><div class="container-fluid"><div class="container-fluid" style="background-color: #0b111e; border-radius: 6px; box-shadow: 1px 1px 10px #000;">
<h2 style="color: #fff; text-shadow: 1px 1px 10px #000; margin-bottom: 20px">Список тем</h2>';
$Count = mysqli_fetch_row(mysqli_query($CONNECT, "SELECT COUNT(`id`) FROM `forumtopic` WHERE `topic` LIKE '%$_SESSION[SEARCH]%' AND `id_cat` = '$_SESSION[cataid]'"));


if ($Count[0]) {
if (!$Param['page']) {
$Param['page'] = 1;
$Result = mysqli_query($CONNECT, "SELECT * FROM `forumtopic` WHERE `topic` LIKE '%$_SESSION[SEARCH]%' AND `id_cat` = '$_SESSION[cataid]' ORDER BY `id` DESC LIMIT 0, 9");
} else {
$Start = ($Param['page'] - 1) * 9;
$Result = mysqli_query($CONNECT, str_replace('START', $Start, "SELECT * FROM `forumtopic` WHERE `topic` LIKE '%$_SESSION[SEARCH]%' AND `id_cat` = '$_SESSION[cataid]' ORDER BY `id` DESC LIMIT START, 9"));
}


PageSelector("/searchtopic/forumtopic/page/", $Param['page'], $Count);
while ($Row2 = mysqli_fetch_assoc($Result)) 
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
		
	';

} else echo '<b style="color: red; font-size: 110%">Нічого не знайдено.</b><br>';
?>

<br>
</div></div>

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