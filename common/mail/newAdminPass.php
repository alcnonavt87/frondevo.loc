<?php
use yii\helpers\Html;
?>

<p>Уважаемый <?php echo Html::encode($user['name']).' '.Html::encode($user['surname']) ?>,</p>
<p>Ваш пароль изменён</p>
<p>Ваш новый пароль: <?php echo Html::encode($newPass) ?></p>
