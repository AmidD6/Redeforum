<?php 
$Param['id'] += 0;
if ($Param['id'] == 0) MessageSend(1, 'URL адреса вказана невірно.', '/maintopic');
session_start();
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, 'SELECT * FROM `forumtopic` WHERE `id` = '.$Param['id']));
$_SESSION['TOPIC_IDCAT'] = $Row['id'];
$_SESSION['TOPIC_ADDED'] = $Row['added'];
$_SESSION['TOPIC_N'] = $Row['topic'];
if (!$Row['topic']) MessageSend(1, 'Такої теми немає.', '/maintopic');
if (!$Row['active'] and $_SESSION['USER_GROUP'] != 2) MessageSend(1, 'Тема очікує активування.', '/maintopic');
mysqli_query($CONNECT, 'UPDATE `forumtopic` SET `read` = `read` + 1 WHERE `id` = '.$Param['id']);

$Sumatop = mysqli_fetch_assoc(mysqli_query($CONNECT, 'SELECT SUM(`messnumber`) AS `resss` FROM `forumtopic` WHERE `id_cat` = '.$_SESSION['cataid']));
mysqli_query($CONNECT, "UPDATE `catagoryforum` SET `messnumber` = $Sumatop[resss] WHERE `id` = $_SESSION[cataid]");

Head('Redeforummain - Форум - '.$_SESSION['namecat'].' - '.$Row['topic']);
?>

<style>

h2 {
	color: #9200c5;
	text-shadow: 1px 1px 10px #4b246a;
	text-align: justify;
}
p {
	color: #fff;
	text-shadow: 1px 1px 10px #000;
	text-align: justify;
	font-size: 120%;
}

.bcolor {
	color: #8916b1;
}
a {
	color: #8f0de1;
}
.bcol{
	color: #8f0de1;
}

li {
	text-align: justify;
}


h1 {
  font-family: 'Anton', sans-serif;
  color: #29AB87;
}

.input-group {
  margin-top: 20px;
  margin-bottom: 10px;
}

.panel {

  background-color: #16233c !important;
  border: 5px solid #421455;
}

.panel-heading {
  background-color: #59176b!important;
}

#accordion_search_bar {
  border: solid 2px #1f052a;
}

.btn-default {
  border: solid 1.5px #1f052a;
}

.fa-search {
  font-size: 1.3em;
}

.fa-paw {
  font-size: 1.4em;
  color: #6B7F7A;
}

</style>

<body>
<?php Menu();
MessageShow() ;

echo '<div style=" margin-right: 15px; margin-top: -25px;"><div class="row" ><div class="col-md">
<br>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb arr-right" style="background-color: #111b2f; margin-top: -8px; margin-left: -2px; margin-right: -15px; box-shadow: 1px 1px 10px #000;">
    <li class="breadcrumb-item "><a href="/" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;">Головна</a></li>
	<li class="breadcrumb-item "><a href="/forummain" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;">Форум</a></li>
	<li class="breadcrumb-item "><a href="/forummain/maintopic/id/'.$_SESSION['cataid'].'" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;">'.$_SESSION['namecat'].'</a></li>
    <li class="breadcrumb-item text-light active" aria-current="page"><b>'.$Row['topic'].'<b></li>
  </ol>
</nav>
</div></div></div>';

echo '<div class="col">
<br>

<div class="container-fluid" style="background-color: #0b111e; border-radius: 6px; box-shadow: 1px 1px 10px #000; padding: 20px;">';
if (!$Row['active']) $Active = '| <a href="/forummain/control/id/'.$Param['id'].'/command/active" class="lol">Активувати тему</a>';
if ($_SESSION['USER_GROUP'] == 2 or $_SESSION['USER_GROUP'] == 1 ) $EDIT = '

| <a href="/forummain/edit/id/'.$Param['id'].'" class="lol"><i class="fa fa-edit"></i> Редагувати тему</a> | 
<a href="/forummain/control/id/'.$Param['id'].'/command/delete" class="lol"><i class="fa fa-trash" aria-hidden="true"></i> Видалити тему</a>'.$Active;


if ($_SESSION['USER_GROUP'] == 0) $EDIT = '  <a href="/forummain/edit/id/'.$Param['id'].'" class="lol">               </a>   <a href="/forummain/control/id/'.$Param['id'].'/command/delete" class="lol">             </a>';


if ($Row['image'] != 0)  $PUBLIC_IMG = '





<div class="panel panel-default" id="collapseTwo_container" style="box-shadow: 1px 1px 10px #000;">
                  <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title" style="padding-bottom: 10px; padding-top: 5px; padding-left: 10px;">
          <a role="button" 
             data-toggle="collapse" 
             data-parent="#accordion" 
			 style="color: #fff; text-shadow: 1px 1px 10px #000;"
             href="#collapseTwo" 
             aria-expanded="true" 
             aria-controls="collapseTwo">
           <i class="fa fa-picture-o" aria-hidden="true"></i>  Зображення
          </a>
        </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
						<div class="text-center">
						<img src="/catalog/img/forummain/'.$Row['image'].'/'.$Param['id'].'.jpg" class="img-fluid" height="422" width="750" alt="Responsive image">
						 </div> 
                    </div>
                  </div>
                </div>

<br>




';


if ($Row['video'] != 0)  $PUBLIC_VIDEO = '



<div class="panel panel-default" id="collapseOne_container" style="box-shadow: 1px 1px 10px #000;">
                  <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title" style="padding-bottom: 10px; padding-top: 5px; padding-left: 10px;">
          <a role="button" 
             data-toggle="collapse" 
             data-parent="#accordion" 
			 style="color: #fff; text-shadow: 1px 1px 10px #000;"
             href="#collapseOne" 
             aria-expanded="true" 
             aria-controls="collapseOne">
           <i class="fa fa-youtube-play" aria-hidden="true"></i>  Відео
          </a>
        </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
					
						  <div class="col col-lg-5" style=" padding: 5px; margin-left: auto; margin-right: auto;">
							  <div class="embed-responsive embed-responsive-16by9">
								<video src="/catalog/video/forummain/'.$Row['video'].'/'.$Param['id'].'.mp4" poster="https://3dnews.ru/assets/external/illustrations/2020/06/08/1012860/sm.3398499-cyberpunk2077-e3thumb-44.750.jpg" controls loop></video>
							  </div>
						  </div>
                    </div>
                  </div>
                </div>
<br>





';



if ($Row['file'] != 0)  $PUBLIC_FIL = '





<div class="panel panel-default" id="collapseTree_container" style="box-shadow: 1px 1px 10px #000;">
                  <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title" style="padding-bottom: 10px; padding-top: 5px; padding-left: 10px;">
          <a role="button" 
             data-toggle="collapse" 
             data-parent="#accordion" 
			 style="color: #fff; text-shadow: 1px 1px 10px #000;"
             href="#collapseTree" 
             aria-expanded="true" 
             aria-controls="collapseTree">
           <i class="fa fa-file-archive-o" aria-hidden="true"></i>  Архів
          </a>
        </h4>
                  </div>
                  <div id="collapseTree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
					<b style="padding: 10px; color: #fff; text-shadow: 1px 1px 10px #000;">Завантажили: '.$Row['download'].'</b>
						<div class="text-center" style="padding: 20px">
						<img src="/resource/img/rar.png" class="rounded mx-auto d-block" height="100" alt="Responsive image">
						<a href="/forummain/download/id/'.$Param['id'].'" class="lol" style="font-size: 120%">'.$Param['id'].'.rar</a>
						 </div> 
                    </div>
                  </div>
                </div>

<br>




';



if ($_SESSION['USER_GROUP'] == 0 or $_SESSION['USER_GROUP'] == 1) $scar = '<form method="post" action="/forummain/sendadminquery"><button type="submit" name="button" class="btn btn-sm btn-purple btn-block " style="background-color: #5d0c72" data-toggle="modal" data-target="#search"><b style="font-size: 120%; text-shadow: 1px 1px 10px #000;">Скарга</b></button></form>';
else $scar = '';




/*echo '
<div style="background-color: #111b2f; padding: 10px; border-radius: 6px; box-shadow: 1px 1px 10px #000; font-size: 100%; width: 230px">

<img src="/resource/img/rar.png" class="img" height="100" alt="Responsive image">
<a style="color: #fff;">Завантажити</a>
</div>


';*/


$Av = mysqli_fetch_array(mysqli_query($CONNECT, "SELECT `avatar` FROM `users` WHERE `id` = '$Row[id_user]'"));

if($Row['added'] == $_SESSION['USER_LOGIN']) echo '<img src="/resource/avatar/'.$Av['avatar'].'.jpg" class="img-circle img-sm" style="border-radius: 25% 10%;" alt="avatar image" height="60">
<b class="bcolor" style="padding-left: 19px"> Добавив: </b><a href="/profile" class="lol">'.$Row['added'].'</a>
<b class="bcolor"> | Переглядів: </b><b class="bcol">'.($Row['read'] + 1).'</b> 
<b class="bcolor"> | Дата: </b><b class="bcol">'.$Row['date'].' </b>
<br>
<hr style="border: 1px solid #5d0c72">

<h2>'.$Row['topic'].'</h2>

<br><p style="text-shadow: 1px 1px 10px #000; overflow-x:hidden;">'.$Row['text'].'</p>
<br>
'.$PUBLIC_IMG.'
 '.$PUBLIC_VIDEO.'
 '.$PUBLIC_FIL.'
<hr style="border: 1px solid #5d0c72"; ><br>
<a href="/forummain/edit/id/'.$Param['id'].'" class="lol"><i class="fa fa-edit"></i> Редагувати тему</a> | 
<a href="/forummain/control/id/'.$Param['id'].'/command/delete" class="lol"><i class="fa fa-trash" aria-hidden="true"></i> Видалити тему</a>

';



else echo ' 
<img src="/resource/avatar/'.$Av['avatar'].'.jpg" class="img-circle img-sm" style="border-radius: 25% 10%;" alt="avatar image" height="60">
<b class="bcolor"> | Добавив:</b> 
<a href="/user/'.$Row['added'].'" class="lol">'.$Row['added'].'</a> 
<b class="bcolor">Переглядів:</b> <b class="bcol">'.($Row['read'] + 1).'</b>
<b class="bcolor">| Дата: </b>
<b class="bcol">'.$Row['date'].'</b> 
<br>
<hr style="border: 1px solid #771790">

<h2>'.$Row['topic'].'</h2>
<br>
<p>'.$Row['text'].'</p>
<br>
'.$PUBLIC_IMG.'
 '.$PUBLIC_VIDEO.'
 '.$PUBLIC_FIL.'
<hr style="border: 1px solid #771790">
<div class="d-flex justify-content-between">

<div class="p-2 bd-highlight">'.$EDIT.'</div>

  <div class="p-2 bd-highlight">'.$scar.'</div>

</div>';














$Nome = $Param['id'];
$Com = mysqli_query($CONNECT, 'SELECT SUM(`one`) AS `num` FROM `comments` WHERE `module` = 1 AND `material` = '.$Nome.'');
$Comres = mysqli_fetch_assoc($Com);
mysqli_query($CONNECT, "UPDATE `forummain` SET `numnews` = '$Comres[num]' WHERE `id` = '$Nome'");
//COMMENTS();
echo '</div><br><br>';
MESSFORUM();
?>
</div>
</body>
</html>