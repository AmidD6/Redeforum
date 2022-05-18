<?php 
function Popukars(){	
			$Popp = mysqli_query($CONNECT, 'SELECT * FROM `forum` WHERE ORDER BY `numnews` DESC LIMIT 0, 1');
			while ($Pop = mysqli_fetch_assoc($Popp)) {
		if (!$Row['active']) $Row['name'] .= ' <b style="color: red"> - (Чекає модерації)</b>';
		echo '
		<h3 style="color: #9200c5; text-shadow: 1px 1px 10px #4b246a; text-align: justify; ">'.$Pop['name'].'</h3>
		<b style="color: #fff; font-size: 110%"><span>Добавив: '.$Pop['added'].' | '.$Pop['date'].'</span></b><br>
		<p style="color: #fff; text-align: justify; text-shadow: 1px 1px 10px #000; font-size: 120%;">'.substr($Pop['text'],0,600).'...</p>
		<a class="nav-link" href="/forum/material/id/'.$Pop['id'].'" style="font-size: 120%"><button type="button" class="btn btn-sm btn-purple btn-block" style="background-color: #9200c5" data-toggle="modal"><b style="font-size: 140%; text-shadow: 1px 1px 10px #000;">Читати далі</b></button></a></div><br>';
}
}?>