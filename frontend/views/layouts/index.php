<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use vendor\UrlProvider\TextPagesUrlProvider;
use frontend\controllers\CommonController;
\frontend\assets\MainAsset::register($this);
extract(Yii::$app->params['forLayout']);

$textPagesUrlProvider = new TextPagesUrlProvider($lang);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<!-- ru -->
<html lang="ru">
<head>
    <title><?=$pTitle?></title>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
    <base href="http://frondevo.loc/frontend/web/">
    <link rel="shortcut icon" href="markup/img/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, minimum-scale=1.0'">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <meta name="apple-mobile-web-app-title" content="">
    <link rel="stylesheet" href="markup/css/main.css">
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!-- site wrap -->
<div class="site-wrap tEndElement loading">

    <!-- header -->
    <header class="header hidden index">
        <span class="logo"><img src="markup/img/header/logo.png" width="77" height="76"
                                alt="Frondevo - интернет-агентство полного цикла разработки интернет-проектов"></span>
    </header>
    <!--/header -->
    <?= $content ?>
    <!-- menu button -->
    <div title="Open menu" data-popup="gmenu" data-popup-close="Close menu" class="menu-button fd__hb-menu">
        <div>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <!--/menu button -->
    <!-- fd  popup -->
    <div class="fd__popup fd__popup_v2 tEndElement">

        <!-- pop wrap -->
        <div class="pop-wrap">

            <!-- pop content -->
            <div class="pop-content queue-wrap queueFromBottom animate in">

                <!-- fd  pmenu -->
                <div class="fd__pmenu">

                    <!-- fd  pmenu cell -->
                    <div class="fd__pmenu-cell queue-wrap queueFromLeft popup-column">
                        <div>
                            <div class="fd__pmenu-logo queue queue1"><img src="markup/img/frondevo.png"
                                                                          width="80" height="80" alt=""></div>

                            <!-- fd  menu -->
                            <div class="fd__menu header-lang g_menu queue queue2">

                                <?php foreach ($langMenu as $menuItemLang => $menuItem) {
                                    $sameLang = ($menuItemLang == $lang);
                                    ?>

                                    <?php if ($sameLang) { ?>
                                        <div class="m-item active queue queue3"> <?php echo $menuItem['text']; ?></div>

                                    <?php } else { ?>
                                        <div class="m-item queue queue2">
                                            <a href="<?php echo $menuItem['link']; ?>"><?php echo $menuItem['text']; ?></a>
                                        </div>
                                    <?php } ?>

                                <?php } ?>
                            </div>

                        </div>
                    </div>
                    <!--/fd  pmenu cell -->


                    <!-- queue wrap -->
                    <div class="queue-wrap popup-column">
                        <div class="fd__stripe tEndElement"></div>
                    </div>
                    <!--/queue wrap -->


                    <!-- fd  pmenu cell -->
                    <div class="fd__pmenu-cell queue-wrap queueFromRight popup-column">

                        <!-- fd  pmenu list -->
                        <div class="fd__pmenu-list">

                            <!-- fd  menu -->
                            <div class="fd__menu g_menu">
                                <?php echo $menu; ?>

                            </div>
                            <!--/fd  menu -->

                        </div>
                        <!--/fd  pmenu list -->

                    </div>
                    <!--/fd  pmenu cell -->


                    <!-- queue wrap -->
                    <div class="queue-wrap popup-column">
                        <div class="fd__stripe fd__stripe2 tEndElement"></div>
                    </div>
                    <!--/queue wrap -->

                </div>
                <!--/fd  pmenu -->

            </div>
            <!--/pop content -->

        </div>
        <!--/pop wrap -->

        <div title="Close" class="pop-btn-close"></div>
    </div>
    <!--/fd  popup -->
    <script src="markup/js/lib/lib.min.js"></script>
    <script src="markup/js/main.min.js"></script>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<!--/ru -->