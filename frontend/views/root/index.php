<?php
use frontend\models\Common;
use vendor\UrlProvider\SimpleModuleUrlProvider;
use vendor\UrlProvider\TextPagesUrlProvider;
$textPagesUrlProvider = new TextPagesUrlProvider($lang);
?>


<div class="full-height mesh index">

    
    <div class="full-height__layout">

        
        <div class="middle-text flex-lt middle-flex">
            <div>

                
                <h1 class="fd__index-title g_text">
                    <span><?php echo $pH1; ?></span>
                    <span><img src="markup/img/header/frondevo-web-agency.png" alt="<?php echo $pageData['indexAltName']?>"></span>
                </h1>
                <!-- sections column wrap -->
                <div class="fd__index-column-wrap">
                    <div class="swiper-wrapper">

                        <!-- website dev wrap -->
                        <div class="fd__index-column-item swiper-slide">
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
                        <!-- /website dev wrap -->

                        <!-- website dev wrap -->
                        <div class="fd__index-column-item swiper-slide">
                            <!-- align center -->
                            <div class="align-center">

                                <!-- button wrap -->
                                <div class="button-wrap">

                                    <!-- # -->
                                    <a href="<?php echo $textPagesUrlProvider->getFrontendOutUrl()?>" class="button dark hidden">
                                        <span><?php echo $pageData['indexTextButton2']?></span>
                                    </a>
                                    <!--/# -->

                                    <canvas width="100" height="100" data-stroke="true"></canvas>
                                </div>
                                <!--/button wrap -->

                            </div>
                            <!--/align center -->

                            <!--<div class="footer__text">Решение задач различной сложности.<br> Современные методы разработки.</div>-->
                            <div class="footer__text"><?php echo $pageData['pContentbutton2']?></div>

                        </div>
                        <!-- /website dev wrap -->


                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <!-- /sections column wrap -->
            </div>
        </div>

        <div class="fd__sparks">
            <canvas id="sparks"></canvas>
        </div>
        

    </div>
    

</div>




<div class="main-wrap">
</div>


</div>




