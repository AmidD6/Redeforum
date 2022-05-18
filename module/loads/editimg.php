<?php 

$Param['id'] += 0;
if (!$Param['id']) MessageSend(1, 'Не вказаний ID матеріалу', '/loads');
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `cat`, `name`, `text`, `dfile`, `dimg`, `dvideo` FROM `loads` WHERE `id` = $Param[id]"));
if (!$Row['name']) MessageSend(1, 'Матеріал не знайдено.', '/loads');
if ($_POST['enter'] and $_POST['text'] and $_POST['name'] and $_POST['cat']) {
$_POST['name'] = FormChars($_POST['name']);
$_POST['text'] = FormChars($_POST['text']);
$_POST['cat'] += 0;
if ($_FILES['file']['tmp_name']) move_uploaded_file($_FILES['file']['tmp_name'], 'catalog/file/'.$Row['dfile'].'/'.$Param['id'].'.rar');
if ($_FILES['video']['tmp_name']) move_uploaded_file($_FILES['video']['tmp_name'], 'catalog/video/'.$Row['dvideo'].'/'.$Param['id'].'.mp4');
if ($_FILES['img']['tmp_name']) move_uploaded_file($_FILES['img']['tmp_name'], 'catalog/img/'.$Row['dimg'].'/'.$Param['id'].'.jpg');
mysqli_query($CONNECT, "UPDATE `loads` SET `name` = '$_POST[name]', `cat` = $_POST[cat], `text` = '$_POST[text]' WHERE `id` = $Param[id]");
MessageSend(2, 'Матеріал відредагований.', '/loads/material/id/'.$Param['id']);
}



Head('Редагувати матеріал') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() 
?>
<div class="Page">
<?php
echo '<form method="POST" action="/loads/edit/id/'.$Param['id'].'" enctype="multipart/form-data">
<input type="text" name="name" placeholder="Назва матеріалу" maxlength="20" value="'.$Row['name'].'" required>
<br><select size="1" name="cat">'.str_replace('value="'.$Row['cat'], 'selected value="'.$Row['cat'], '<option value="1">Категорія 1</option><option value="2">Категорія 2</option><option value="3">Категорія 3</option>').'</select>
<br><br><input type="file" name="file"> (Файл)
<br><br><input type="file" name="video"> (Відеоролик)
<br><br><input type="file" name="img"> (Зображення для відеоролику)
<br><br><textarea class="Add_L" name="text" required>'.str_replace('<br>', '', $Row['text']).'</textarea>
<br><input type="submit" name="enter" value="Зберегти"> <input type="reset" value="Знищити">
</form>'
?>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>