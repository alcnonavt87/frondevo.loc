<?php
use yii\helpers\Html;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Content Management System</title>

    <!-- ===== style sheets ===== -->
    <link rel="stylesheet" href="<?php echo Yii::$app->homeUrl ?>core/css/main.css">
    <link rel="stylesheet" href="<?php echo Yii::$app->homeUrl ?>core/css/auth.css">
    <!-- ===== /style sheets ===== -->

    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script>window.html5 || document.write('<script src="js/html5shiv.js"><\/script>')</script>
	<link rel="stylesheet" href="<?php echo Yii::$app->homeUrl ?>core/css/ie8.css">
    <![endif]-->

    <!-- ======= scripts ======= -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

    <script src="<?php echo Yii::$app->homeUrl ?>core/js/TweenMax.min.js"></script>
    <script src="<?php echo Yii::$app->homeUrl ?>core/js/main.js"></script>
    <script src="<?php echo Yii::$app->homeUrl ?>core/js/config.js"></script>
    <!-- ======= /scripts ======= -->
    <?php echo Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>


<body>

    <!-- auth -->
    <div id="auth" class="auth">

        <?php echo $content; ?>

        <!-- created by frondevo -->
        <a href="http://frondevo.com" target="_blank" class="auth-form__created-by">
            © Created by the <span>Frondevo</span> team.
        </a>
        <!--/created by frondevo -->

    </div>
    <!--/auth -->
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>