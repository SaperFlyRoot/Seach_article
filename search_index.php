<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html">
  <meta charset="utf-8">
  <title>Поиск</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/search.js"></script>
</head>

<body>
  <ul id="navbar">
    <li><a href="index.php">Главная</a></li>
    <li><a href="#">Товары</a>
      <ul>
        <li><a href="search_index.php">Найти</a></li>
      </ul>
    </li>
    <li><a href="email.php">Написать нам</a>
    <li><a href="o_nac.php">О нас</a></li>
  </ul>
  <div id="search">
		<h1><i>Поиск товара...</i></h1>
		<form method="get">
		<input type="text" name="usersearch" id="usersearch" />
</form>
</div>
<?php
require_once ("NAXODKA.php");
$link = mysqli_connect($host, $user, $pass, $db);
$sql = mysqli_query($link, 'SELECT * FROM `tovar`');
?>
<?php
		//Поиск по фразе (по содержанию заметки)
		$user_search = $_GET['usersearch'];
		$where_list = array();
		$query_usersearch = "SELECT * FROM tovar";
		$clean_search = str_replace(',', ' ', $user_search);
		$search_words = explode(' ', $user_search);
		//Создаем еще один массив с окончательными результатами
		$final_search_words = array();
		//Проходим в цикле по каждому элементу массива $search_words.
		//Каждый непустой элемент добавляем в массив $final_search_words
		if (count($search_words) > 0)
			{
				foreach($search_words as $word)
				{
					if (!empty($word))
					{
						$final_search_words[] = $word;
					}
				}
			}
//работа с использованием массива $final_search_words
	foreach ($final_search_words as $word)
	{
		$where_list[] = " name LIKE '%$word%'";

	}

	$where_clause = implode (' OR ', $where_list);
	if (!empty($where_clause))
	{
		$query_usersearch .=" WHERE $where_clause";
	}
		$res_query = mysqli_query($link, $query_usersearch);
		while ($res_array = mysqli_fetch_array($res_query))
		{
				?>
			<?php
			echo "Дата записи: ", $res_array ['created'], "<br>";
			echo "Брэнд: ",$res_array ['brand'], "<br>";
			echo "Название: ",$res_array ['name'], "<br>";
			echo "Цена: ",$res_array ['cost'], "<br>";
			echo "Остаток: ",$res_array ['ost'], "<br>";
			echo "<hr>";

	}
	?>
</body>
</html>
