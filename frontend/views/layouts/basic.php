<?php
//
// Базовый шаблон сайта
//
// Принимаемые переменные:
// $hostName - имя хоста
// $lang - язык
// $indexUrl - урл главной страницы
// $pTitle - мета-заголовок страницы
// $pDescription - мета-описание страницы
// $indexPage - флаг главной страницы
// $menu - контент меню
// $content - контент внутренней страницы
//
?>
<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use vendor\UrlProvider\TextPagesUrlProvider;
use frontend\models\Root;

extract(Yii::$app->params['forLayout']);
\frontend\assets\MainAsset::register($this);
$textPagesUrlProvider = new TextPagesUrlProvider($lang);
$urlprovider = new \vendor\UrlProvider\UrlProvider($lang)
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<?php if ($lang == 'ua'){
    $lang = 'uk';
}?>
<html lang=<?= $lang ?>>
<head>
    <title><?= $pTitle ?></title>
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
    <?php if (!empty($worksfrontoutPage)) {
        echo '   <link rel="stylesheet" href="markup/css/lib/highlight/railscasts.css">';
    }
    ?>
    <?php if (!empty($PageLangEn) && !empty($PageLangUa)) {
        if ($lang == 'ru') {
            echo '<link href="' . $PageLangEn . '" hreflang="en" rel="alternate">
              <link href="' . $PageLangUa . '" hreflang="uk-UA" rel="alternate">';
        } else if ($lang == 'en') {
            echo '<link href="' . $PageLangUa . '" hreflang="uk-UA" rel="alternate">
                  <link href="' . $PageLangRu . '" hreflang="ru-RU" rel="alternate">';
        } else if ($lang == 'ua') {
            echo '<link href="' . $PageLangEn . '" hreflang="en" rel="alternate">
                  <link href="' . $PageLangRu . '" hreflang="ru-RU" rel="alternate">';
        }
    }
    ?>
    <?= Html::csrfMetaTags() ?>
</head>
<body>


<div class="site-wrap tEndElement">


    <header class="header hidden">
        <a title="<?php echo Yii::t('app', 'Frondevo - Full Service Web Agency'); ?>" href="<?php echo $indexUrl ?>"
           class="logo"><img src="markup/img/header/logo.png" width="77"
                             height="76"
                             alt="<?php echo Yii::t('app', 'Frondevo - Full Service Web Agency'); ?>"></a>
    </header>
    <div title="Open menu" data-popup="gmenu" data-popup-close="Close menu" class="menu-button fd__hb-menu">
        <div>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>


    <?= $content ?>

    <footer class="footer">

        <div class="footer__top">

            <div class="layout">
                <?php if (!empty($links)) { ?>
                    <ul>
                    <?php foreach ($links as $link) { ?>
                        <?php if (!empty($link['urlMethod'])){
                            $linkUrl = $textPagesUrlProvider->{$link['urlMethod']}();
                        } else {
                            $linkUrl = '';
                        } ?>
                        <li><a href="<?php echo $linkUrl; ?>"><?php echo $link['title']; ?></a></li>
                    <?php } ?>
                     </ul>
                <?php } ?>

            </div>


        </div>


        <div class="layout">
            <a href="<?php echo $indexUrl ?>" class="footer-logo"><img src="markup/img/footer/footer-logo.png"
                                                                       alt="<?php echo Yii::t('app', 'Frondevo - Full Service Web Agency'); ?>"></a>
            <address>
                <span><?php echo '&copy;' . date('Y') . " " . $settings['copyright'] ?><br>
                   </span>
                        <span>
                            <span>  <?php echo $settings['address']; ?></span>
                            <a href="mailto:welcome@frondevo.com">welcome@frondevo.com</a>
                        </span>
            </address>
        </div>


    </footer>


</div>


<div class="fd__popup fd__popup_v2 tEndElement">

    <div class="pop-wrap">


        <div class="pop-content queue-wrap queueFromBottom animate in">

            <div class="fd__pmenu">


                <div class="fd__pmenu-cell queue-wrap queueFromLeft popup-column">
                    <div>
                        <div class="fd__pmenu-logo queue queue1"><img src="markup/img/frondevo.png"
                                                                      width="80" height="80" alt=""></div>

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
<?php if (!empty($sitesbykeysPage) || !empty($frontendoutPage) || !empty($Psd2html5Page)) {
    echo '<script src="markup/js/lib/site.lib.min.js"></script>
    <script src="markup/js/site.min.js"></script>';
} else if (!empty($portfolioPage)) {
    echo '<script src="markup/js/lib/projects.lib.min.js"></script>
    <script src="markup/js/projects.min.js"></script>';
} else if (!empty($workPage) || !empty($worksfrontoutPage)) {
    echo '<script src="markup/js/lib/works-view.lib.min.js"></script>
    <script src="markup/js/works-view.min.js"></script>';
} else if (!empty($commercialPage)) {
    echo '<script src="markup/js/lib/project.lib.min.js"></script>
        <script src="markup/js/lib/lib.min.js"></script>
        <script src="markup/js/form.min.js"></script>';
} else if (!empty($contactsPage) || !empty($JavascriptPage) || !empty($AngularPage) || !empty($PortfoliofrontoutPage) || !empty($GamesPage) || !empty($AnimationsPage)) {
    echo '<script src="markup/js/lib/project.lib.min.js"></script>
    <script src="markup/js/project.min.js"></script>';
} else {
    echo '<script src="markup/js/lib/lib.min.js"></script>
    <script src="markup/js/main.min.js"></script>';
}

?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>




