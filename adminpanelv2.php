<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8"/>
  <title>Админ-панель</title>
</head>
<body>
  <?php
    $host = 'localhost';  // Хост, у нас все локально
    $user = 'root';    // Имя созданного вами пользователя
    $pass = ''; // Установленный вами пароль пользователю
    $db_name = 'naxodka';   // Имя базы данных
    $link = mysqli_connect($host, $user, $pass, $db_name); // Соединяемся с базой

    // Ругаемся, если соединение установить не удалось
    if (!$link) {
      echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
      exit;
    }

    //Если переменная Name передана
    if (isset($_POST["Name"])) {
      //Если это запрос на обновление, то обновляем
      if (isset($_GET['red_id'])) {
          $sql = mysqli_query($link, "UPDATE `tovar` SET `name` = '{$_POST['Name']}', `brand` = '{$_POST['Brand']}',`ost` = '{$_POST['Ost']}',`cost` = '{$_POST['Cost']}' WHERE `id`={$_GET['red_id']}");
      } else {
          //Иначе вставляем данные, подставляя их в запрос
          $sql = mysqli_query($link, "INSERT INTO `tovar` (`name`, `brand`,`ost`,`cost`)
           VALUES ('{$_POST['Name']}',
             '{$_POST['Brand']}',
             '{$_POST['Ost']}',
             '{$_POST['Cost']}')");
      }

      //Если вставка прошла успешно
      if ($sql) {
        echo '<p>Успешно!</p>';
      } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
      }
    }

    if (isset($_GET['del_id'])) { //проверяем, есть ли переменная
      //удаляем строку из таблицы
      $sql = mysqli_query($link, "DELETE FROM `tovar` WHERE `id` = {$_GET['del_id']}");
      if ($sql) {
        echo "<p>Товар удален.</p>";
      } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
      }
    }

    //Если передана переменная red_id, то надо обновлять данные. Для начала достанем их из БД
    if (isset($_GET['red_id'])) {
      $sql = mysqli_query($link, "SELECT `id`, `name`, `brand`,`ost`,`cost` FROM `tovar` WHERE `id`={$_GET['red_id']}");
      $product = mysqli_fetch_array($sql);
    }
  ?>
  <form name="one" action="" method="post">
    <table>
      <tr>
        <td>Наименование:</td>
        <td><input type="text" name="Name" value="<?= isset($_GET['red_id']) ? $product['Name'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Брэнд:</td>
        <td><input type="text" name="Brand"  value="<?= isset($_GET['red_id']) ? $product['Brand'] : ''; ?>"> </td>
      </tr>
      <tr>
        <td>Цена:</td>
        <td><input type="text" name="Cost"  value="<?= isset($_GET['red_id']) ? $product['Cost'] : ''; ?>">руб.</td>
      </tr>
      <tr>
        <td>Остаток:</td>
        <td><input type="text" name="Ost"  value="<?= isset($_GET['red_id']) ? $product['Ost'] : ''; ?>">шт.</td>
      </tr>
      <tr>
        <td colspan="2"><input type="submit" value="OK"></td>
      </tr>
    </table>
  </form>
  <table border='1'>
    <tr>
      <td>Наименование</td>
      <td>Брэнд</td>
      <td>Цена</td>
      <td>Остаток</td>
      <td>Удаление</td>
      <td>Редактирование</td>
    </tr>
    <?php
      $sql = mysqli_query($link, 'SELECT `id`, `name`, `brand`,`cost`,`ost` FROM `tovar`');
      while ($result = mysqli_fetch_array($sql)) {
        echo '<tr>' .
             "<td>{$result['name']}</td>" .
             "<td>{$result['brand']}</td>" .
             "<td>{$result['cost']} </td>" .
             "<td>{$result['ost']} </td>" .
             "<td><a href='?del_id={$result['id']}'>Удалить</a></td>" .
             "<td><a href='?red_id={$result['id']}'>Изменить</a></td>" .
             '</tr>';
      }
    ?>
  </table>
  <p><a href="?add=new">Добавить новый товар</a></p>

<?php
  //Если переменная Name передана
$created = $_POST['created'];
  if (isset($_POST["Name2"])) {
    //Если это запрос на обновление, то обновляем
    if (isset($_GET['red_id2'])) {
        $sql = mysqli_query($link, "UPDATE `naxodka_tbl` SET `name` = '{$_POST['Name2']}',
          `num_otdel` = '{$_POST['Num_otdel']}',`created` = '$created ',
          ' WHERE `id`={$_GET['red_id2']}");
    } else {
        //Иначе вставляем данные, подставляя их в запрос
        $sql = mysqli_query($link, "INSERT INTO `naxodka_tbl` (`name`, `num_otdel`,`created`)
         VALUES ('{$_POST['Name2']}','$created ',
           '{$_POST['Num_otdel']}')");
    }

    //Если вставка прошла успешно
    if ($sql) {
      echo '<p>Успешно!</p>';
    } else {
      echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
    }
  }

  if (isset($_GET['del_id2'])) { //проверяем, есть ли переменная
    //удаляем строку из таблицы
    $sql = mysqli_query($link, "DELETE FROM `naxodka_tbl` WHERE `id` = {$_GET['del_id2']}");
    if ($sql) {
      echo "<p>Товар удален.</p>";
    } else {
      echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
    }
  }

  //Если передана переменная red_id, то надо обновлять данные. Для начала достанем их из БД
  if (isset($_GET['red_id2'])) {
    $sql = mysqli_query($link, "SELECT `id`, `name`, `num_otdel` FROM `naxodka_tbl` WHERE `id`={$_GET['red_id2']}");
    $product = mysqli_fetch_array($sql);
  }
?>
<form name="two" action="" method="post">

  <table>
    <tr>
      <td><input type="hidden" name = "created" id = "created" value ="<?php echo date("Y-m-d");?>"/></td>
    </tr>
    <tr>
      <td>Название отдела:</td>
      <td><input type="text" name="Name2" value="<?= isset($_GET['red_id2']) ? $product['Name2'] : ''; ?>"></td>
    </tr>
    <tr>
      <td>Номер отдела:</td>
      <td><input type="text" name="Num_otdel"  value="<?= isset($_GET['red_id2']) ? $product['Num_otdel'] : ''; ?>"> </td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" value="OK"></td>
    </tr>
  </table>
</form>
<table border='1'>
  <tr>
    <td>Название отдела:</td>
    <td>Номер отдела:</td>
    <td>Дата создания:</td>
    <td>Удаление</td>
    <td>Редактирование</td>
  </tr>
  <?php
    $sql = mysqli_query($link, 'SELECT `id`, `name`, `num_otdel`,`created` FROM `naxodka_tbl`');
    while ($result = mysqli_fetch_array($sql)) {
      echo '<tr>' .
           "<td>{$result['name']}</td>" .
           "<td>{$result['num_otdel']}</td>" .
           "<td>{$result['created']}</td>" .
           "<td><a href='?del_id2={$result['id']}'>Удалить</a></td>" .
           "<td><a href='?red_id2={$result['id']}'>Изменить</a></td>" .
           '</tr>';
    }
  ?>
</table>
<p><a href="?add2=new">Добавить новый отдел</a></p>
</body>
</html>
