<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<META NAME="keywords" CONTENT="">
	<link rel="stylesheet" href="assets/css/main.css">
	<title>Document</title>
</head>
<body >

<div class="wrapper">
	<div class="blockAdd">

		<form action='' method="post" id='addSection'>
			<select name="selectSection" id="" class="blockAdd__select">
				<option value="no">Не выбрано</option>
				<?echo renderTemplate('template_select.php',['main_arr'=>$main_arr]);?>
			</select>
			<input type="text" class="blockAdd__name" name='nameSection' placeholder="Введите название раздела">
			<button name='btnAdd' class="btnAdd" value='on'>Добавить</button>
		</form>
	</div>
	<div class="catalog">

		<?echo renderTemplate('template_cat.php',['main_arr'=>$main_arr]);?>
	</div>
</div>

	<script src="plug_ins/jQuery3.3.1/jQuery3.3.1.js"></script>
	<script src="assets/js/main.js"></script>
</body>
</html>



