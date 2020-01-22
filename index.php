<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Главная</title>
    	<link rel="stylesheet" type="text/css" href="css/style.css" />
  </head>
  <body>
<h3>Сайт по нахождению товара</h3>
    <ul id="navbar">
      <li><a href="">Главная</a></li>
      <li><a href="#">Товары</a>
        <ul>
          <li><a href="search_index.php">Найти</a></li>
        </ul>
      </li>
      <li><a href="email.php">Написать нам</a>
      <li><a href="o_nac.php">О нас</a></li>
    </ul>
    <h1>Добро пожаловать</h1>
    <h4 class="search">Отделы</h4>
    <div class="prokrytka">

    <?php
require_once ("NAXODKA.php");
$link = mysqli_connect($host, $user, $pass, $db);
$sql = mysqli_query($link, 'SELECT * FROM `naxodka_tbl`');
?>
		<?php

  		while ($note = mysqli_fetch_array($sql))
			{
			?>
					<?php
					echo "Дата создания отдела: ", $note ['created'], "<br>";
					echo "Название отдела: ",$note ['name'], "<br>";
          echo "Номер отдела: ",$note ['num_otdel'], "<br>";
					echo "<hr>";

  }
		?>
  </div>
	</body>
</html>
