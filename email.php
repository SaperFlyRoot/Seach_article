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
      <li><a href="index.php">Главная</a></li>
      <li><a href="#">Товары</a>
        <ul>
          <li><a href="search_index.php">Найти</a></li>
        </ul>
      </li>
      <li><a href="email.php">Написать нам</a>
      <li><a href="o_nac.php">О нас</a></li>
    </ul>
    <form class="contact_form" action="send/mail.php" method="post">
      <p>
              <label for="name">Имя:</label>
              <input type="text"  name="name" placeholder="Введите ваше имя" required />
          </p>
          <p>
              <label for="email">Email:</label>
              <input type="email" name="email" placeholder="Введите электронный адрес" required />
              <span class="form_hint">Правильный формат "name@something.com"</span>
          </p>
          <p>
              <label for="tel">Телефон:</label>
              <input type="tel" name="tel" placeholder="Введите номер телефона" required />
              <span class="form_hint">Правильный формат "+7-123-4567890"</span>
          </p>
          <p>
              <label for="message">Текст сообщения:</label>
              <textarea name="message" cols="40" rows="6" required ></textarea>
          </p>
          <input name="bezspama" type="text" style="display:none" value="" />
          <p>
              <button class="submit" type="submit">Отправить сообщение</button>
          </p>
  </form>
</body>
</html>



<script type="text/javascript">
$(function(){
  'use strict';
$('#form').on('submit', function(e){
    e.preventDefault();
    var fd = new FormData( this );
    $.ajax({
      url: 'email.php',
      type: 'POST',
      contentType: false,
      processData: false,
      data: fd,
      success: function(msg){
if(msg == 'ok') {
  alert('Отправлено')
} else {
  alert('Ошибка')
}
      }
    });
  });
});
</script>
