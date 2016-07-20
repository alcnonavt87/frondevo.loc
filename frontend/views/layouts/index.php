<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use vendor\UrlProvider\TextPagesUrlProvider;
use frontend\controllers\CommonController;
use frontend\models\Root;
\frontend\assets\MainAsset::register($this);
extract(Yii::$app->params['forLayout']);

$textPagesUrlProvider = new TextPagesUrlProvider($lang);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang=<?= $lang ?>>
<head>
    <title><?=$pTitle?></title>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="description" content="<?php echo Root::getCodeStr($pDescription); ?>">
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
    <base href="<?= Yii::$app->request->hostInfo.'/frontend/web/'?>">
    <link rel="shortcut icon" href="markup/img/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, minimum-scale=1.0'">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <meta name="apple-mobile-web-app-title" content="">
    <link rel="stylesheet" href="markup/css/main.min.css">
    <link rel="stylesheet" href="markup/css/lib/swiper.min.css">
    <?php if (!empty($PageLangEn) && !empty($PageLangUa)) {
        if ($lang == 'ru'){
            echo '<link href="'.$PageLangEn.'" hreflang="en" rel="alternate">
              <link href="'.$PageLangUa.'" hreflang="uk-UA" rel="alternate">';
        }
        else if ($lang == 'en') {
            echo '<link href="'.$PageLangUa.'" hreflang="uk-UA" rel="alternate">
                  <link href="'.$PageLangRu.'" hreflang="ru-RU" rel="alternate">';
        }
        else if ($lang == 'ua' ) {
            echo '<link href="'.$PageLangEn.'" hreflang="en" rel="alternate">
                  <link href="'.$PageLangRu.'" hreflang="ru-RU" rel="alternate">';
        }
    }

    ?>
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="site-wrap tEndElement loading">

    <header class="header hidden index">
        <span class="logo"><img src="markup/img/header/logo.png" width="77" height="76"
                                alt="<?php echo Yii::t('app', 'Frondevo - Full Service Web Agency'); ?>"></span>
    </header>

    <?= $content ?>

    <div title="Open menu" data-popup="gmenu" data-popup-close="Close menu" class="menu-button fd__hb-menu">
        <div>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="fd__popup fd__popup_v2 tEndElement">


        <div class="pop-wrap">


            <div class="pop-content queue-wrap queueFromBottom animate in">


                <div class="fd__pmenu">


                    <div class="fd__pmenu-cell queue-wrap queueFromLeft popup-column">
                        <div>
                            <div class="fd__pmenu-logo queue queue1"><img src="markup/img/frondevo.png"
                                                                          width="80" height="80" alt="<?php echo Yii::t('app', 'Frondevo - Full Service Web Agency'); ?>"></div>

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


                    <div class="queue-wrap popup-column">
                        <div class="fd__stripe tEndElement"></div>
                    </div>
                    <div class="fd__pmenu-cell queue-wrap queueFromRight popup-column">
                        <div class="fd__pmenu-list">
                            <div class="fd__menu g_menu">
                                <?php echo $menu; ?>

                            </div>


                        </div>


                    </div>




                    <div class="queue-wrap popup-column">
                        <div class="fd__stripe fd__stripe2 tEndElement"></div>
                    </div>


                </div>


            </div>

        </div>


        <div title="Close" class="pop-btn-close"></div>
    </div>

    <script src="markup/js/lib/lib.min.js"></script>
    <script src="markup/js/main.min.js"></script>
    <script src="markup/js/lib/swiper.jquery.min.js"></script>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<!--/ru -->