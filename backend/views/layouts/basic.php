<?php
use yii\helpers\Html;
?>
<?php //$this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Content Management System</title>

    <!-- ===== style sheets ===== -->
    <link rel="stylesheet" href="<?php echo Yii::$app->homeUrl ?>core/css/main.css">
    <link rel="stylesheet" href="<?php echo Yii::$app->homeUrl ?>core/css/sidebar.css">
    <link rel="stylesheet" href="<?php echo Yii::$app->homeUrl ?>core/css/header.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- ===== /style sheets ===== -->

    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script>window.html5 || document.write('<script src="js/html5shiv.js"><\/script>')</script>
	<link rel="stylesheet" href="<?php echo Yii::$app->homeUrl ?>core/css/ie8.css">
    <![endif]-->

    <!-- ======= scripts ======= -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

    <script src="<?php echo Yii::$app->homeUrl ?>core/js/TweenMax.min.js"></script>
    <script src="<?php echo Yii::$app->homeUrl ?>core/js/main.js"></script>
    <script src="<?php echo Yii::$app->homeUrl ?>core/js/config.js"></script>
    <!-- ======= /scripts ======= -->
    <?php echo Html::csrfMetaTags() ?>
    <?php //$this->head() ?>
</head>

<body>

    <!-- main-wrap -->
    <div id="main-wrap" class="main-wrap" data-action="<?php echo Yii::$app->homeUrl; ?>" data-method="post">

        <!-- site header -->
        <header class="header">

            <!-- logo -->
            <h1 class="header__logo"><a href="<?php echo Yii::$app->getHomeUrl(); ?>"><?php echo Yii::$app->name; ?> :: <span class="logo__txt">Админ панель</span></a></h1>
            <!-- logo -->

            <!-- user-panel -->
            <div class="header__user-panel">
                <span class="user"><?php echo Yii::$app->getUser()->getIdentity()->name.' '.Yii::$app->getUser()->getIdentity()->surname; ?></span>
                <a class="logout" href="<?php echo Yii::$app->homeUrl; ?>logout"></a>
            </div>
            <!-- /user-panel -->

        </header>
        <!-- /site header -->

        <!-- main-content -->
        <section class="main-content">

            <!-- sidebar -->
            <aside class="sidebar">

                <!-- menu -->
                <nav id="sidebar__menu" class="sidebar__menu">
                    <ul class="sidebar-menu__list">
                        <?php echo $content; ?>
                    </ul>
                </nav>
                <!-- menu -->

            </aside>
            <!-- /sidebar -->

            <!-- content -->
            <article id="content" class="content">
                <!-- content__menu -->
                <ul class="content__menu">
                    <?php echo Yii::$app->controller->quickButtons ?>
                </ul>
                <!-- content__menu -->
            </article>
            <!-- /content -->

        </section>
        <!-- /main-content -->

    </div>
    <?php //$this->endBody() ?>
</body>
</html>
<?php //$this->endPage() ?>