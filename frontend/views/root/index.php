<?php
use frontend\models\Common;
use vendor\UrlProvider\SimpleModuleUrlProvider;
use vendor\UrlProvider\TextPagesUrlProvider;
$textPagesUrlProvider = new TextPagesUrlProvider($lang);
?>

<!-- full height -->
<div class="full-height mesh index">

    <!-- full height  layout -->
    <div class="full-height__layout">

        <!-- middle text -->
        <div class="middle-text flex-lt middle-flex">
            <div>

                <!-- fd  index title -->
                <h1 class="fd__index-title g_text">
                    <span><?php echo $pH1; ?></span>
                    <span><img src="markup/img/header/frondevo-web-agency.png" alt="<?php echo $pageData['indexAltName']?>"></span>
                </h1>
                <!--/fd  index title -->


                <!-- align center -->
                <div class="align-center">

                    <!-- button wrap -->
                    <div class="button-wrap">

                        <!-- # -->
                        <a href="<?php echo $textPagesUrlProvider->getSitesByKeysUrl()?>" class="button dark hidden">
                            <span><?php echo $pageData['indexTextButton']?></span>
                        </a>
                        <!--/# -->

                        <canvas width="100" height="100" data-stroke="true"></canvas>
                    </div>
                    <!--/button wrap -->

                </div>
                <!--/align center -->

                <div class="footer__text"><?php echo $pageData['pContent']?></div>
            </div>
        </div>
        <!--/middle text -->


        <!-- fd  sparks -->
        <div class="fd__sparks">
            <canvas id="sparks"></canvas>
        </div>
        <!--/fd  sparks -->

    </div>
    <!--/full height  layout -->

</div>
<!--/full height -->


<!-- main wrap -->
<div class="main-wrap">
</div>
<!--/main wrap -->

</div>
<!--/site wrap -->



