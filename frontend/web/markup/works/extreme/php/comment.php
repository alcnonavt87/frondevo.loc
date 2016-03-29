<?php
sleep(1);

// success
echo json_encode(array("captcha" => true, "message" => '<p>Спасибо!</p><p>Запрос отправлен.</p><p>В ближайшее время мы с вами свяжемся!</p>'));

//wrong captcha
//$id = round(microtime(true) * 1000);
//echo json_encode(array("captcha" => false, "src" => 'http://image.captchas.net/?client=demo&random='.$id, "message" => "<p>Ошибка!</p><p>Введен не верный код с картинки</p>"));


?>