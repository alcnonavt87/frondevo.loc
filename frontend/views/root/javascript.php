<?php
use frontend\models\Common;
use vendor\UrlProvider\SimpleModuleUrlProvider;
use vendor\UrlProvider\TextPagesUrlProvider;

$options['joinUris'] = 1;
$simpleModuleUrlProvider = new SimpleModuleUrlProvider($lang, $options);
$textPagesUrlProvider = new TextPagesUrlProvider($lang);
?>
<!-- full height -->
    <div class="full-height inner mesh">

            <picture>
                <source srcset="<?php echo('p/pages/bigjavascriptbg-'.$pageData['imagejavascript5bgbig']) ?>" media="(min-height: 900px)">
                <source srcset="<?php echo('p/pages/smalljavascriptbg-'.$pageData['imagejavascriptbgsmall']) ?>" media="(min-height: 480px)">
                <img src="<?php echo('p/pages/smalljavascriptbg-'.$pageData['imagejavascriptbgsmall']) ?>" alt="" data-fit="cover">
            </picture>


        <!-- full height  layout -->
        <div class="full-height__layout">

            <!-- middle text -->
            <div class="middle-text">

                <!-- fd  title type2 -->
                <h1 class="fd__title_type2">
                    <?php echo($pageData['javascriptmainscreentitle']) ?>
                </h1>
                <!--/fd  title type2 -->

                <p> <?php echo($pageData['javascriptmainscreentitle1']) ?></p>
                <div class="start-screen-cats start-screen-cats_double">

                    <!-- start screen cats list -->
                    <ul class="start-screen-cats-list">

                        <!-- start screen cats items -->
                        <li class="start-screen-cats-items">

                            <!-- start screen cats item content -->
                            <div class="start-screen-cats-item-content">
                                <div> <?php echo($pageData['javascriptmainscreentitle2']) ?></div>
                            </div>
                            <!--/start screen cats item content -->

                        </li>
                        <!--/start screen cats items -->


                        <!-- start screen cats items -->
                        <li class="start-screen-cats-items">

                            <!-- start screen cats item content -->
                            <div class="start-screen-cats-item-content">
                                <div> <?php echo($pageData['javascriptmainscreentitle3']) ?></div>
                            </div>
                            <!--/start screen cats item content -->

                        </li>
                        <!--/start screen cats items -->

                    </ul>
                    <!--/start screen cats list -->

                </div>
            </div>
            <!--/middle text -->

            <div class="direct-line"></div>
            <div class="arrow"></div>
        </div>
        <!--/full height  layout -->

    </div>
    <!--/full height -->


    <!-- main wrap -->
    <div class="main-wrap">

        <!-- article -->
        <section class="article light why2">
            <!--h2
            span Увлекательный интерактив — это
            | мощный маркетинговый инструмент <br/>для проведения масштабных пиар компаний.
            -->

            <!-- layout -->
            <div class="layout">

                <!-- why dl -->
                <div class="why-dl">

                    <!-- why dl row -->
                    <div class="why-dl-row">
                        <div class="why-dt">Профессиональный код</div>

                        <!-- why dd -->
                        <div class="why-dd">
                            <ul>
                                <li>хорошо структурированный</li>
                                <li>содержащий комментарии</li>
                                <li>легко масштабируемый</li>
                                <li>объектно-ориентированный подход (ООП)</li>
                                <li>соотвествует правилам JSLint</li>
                            </ul>
                        </div>
                        <!--/why dd -->

                    </div>
                    <!--/why dl row -->


                    <!-- why dl row -->
                    <div class="why-dl-row">
                        <div class="why-dt">Использование <br/>архитектурных шаблонов</div>

                        <!-- why dd -->
                        <div class="why-dd">
                            <ul>
                                <li>Module Pattern (object literals, revealing module, singleton)</li>
                                <li>Constructor Pattern</li>
                                <li>Prototype Pattern</li>
                                <li>Observer Pattern</li>
                                <li>Subscribe Pattern</li>
                            </ul>
                        </div>
                        <!--/why dd -->

                    </div>
                    <!--/why dl row -->


                    <!-- why dl row -->
                    <div class="why-dl-row">
                        <div class="why-dt">Опыт работ с HTML5 api <br/>и noSQL БД</div>

                        <!-- why dd -->
                        <div class="why-dd">
                            <ul>
                                <li>Audio, Video, Web audio, Fullscreen</li>
                                <li>History, Web notification, Canvas, Files</li>
                                <li>Storage (local storage, session storage, IndexedDB)</li>
                                <li>JSON, Base64, Fetch, Promise, Mutation Observer, Page visibility, Runtime script error reporting,</li>
                                <li>URL Api, matchMedia</li>
                                <li>MongoDBS</li>
                            </ul>
                        </div>
                        <!--/why dd -->

                    </div>
                    <!--/why dl row -->


                    <!-- why dl row -->
                    <div class="why-dl-row">
                        <div class="why-dt">Опыт работ <br/>с Javascript библиотеками <br/>и фреймворками</div>

                        <!-- why dd -->
                        <div class="why-dd">
                            <ul>
                                <li>jQuery, Kinetic.js, Require.js</li>
                                <li>Greensock, Raphael, ThreeJs</li>
                                <li>AngularJs, Mustache, CommonJS/AMD</li>
                            </ul>
                        </div>
                        <!--/why dd -->

                    </div>
                    <!--/why dl row -->


                    <!-- why dl row -->
                    <div class="why-dl-row">
                        <div class="why-dt">Опыт работы с api <br/>сторонних сервисов</div>

                        <!-- why dd -->
                        <div class="why-dd">
                            <ul>
                                <li>Google Analytics, Maps, Places, Geocoding</li>
                                <li>Youtube, Facebook, VK</li>
                                <li>Yandex Webmaster, Maps</li>
                                <li>GitLab</li>
                            </ul>
                        </div>
                        <!--/why dd -->

                    </div>
                    <!--/why dl row -->


                    <!-- why dl row -->
                    <div class="why-dl-row">
                        <div class="why-dt">Современное <br/>окружение разработки</div>

                        <!-- why dd -->
                        <div class="why-dd">
                            <p>Jade, NodeJs, npm, bower, Gulp, Git</p>
                        </div>
                        <!--/why dd -->

                    </div>
                    <!--/why dl row -->

                </div>
                <!--/why dl -->

            </div>
            <!--/layout -->

        </section>
        <!--/article -->


        <!-- our works -->
        <div class="our-works our-works_type2 our-works_vert">
            <h2>
                <span>Примеры Javascript кода от нашей команды</span>
            </h2>

            <!-- our works  wrap -->
            <div class="our-works__wrap">
                <ul>
                    <li>

                        <!-- # -->
                        <a href="#"><img src="pic/our-works-front/work1.jpg" alt="">
                            <div>

                                <!-- our works  descr -->
                                <div class="our-works__descr">
                                    <span>Responsive</span>
                                    <span>Animations</span>
                                    <span>Landing page</span>
                                    <span>Promo</span>
                                </div>
                                <!--/our works  descr -->

                            </div>
                        </a>
                        <!--/# -->

                    </li>
                    <li>

                        <!-- # -->
                        <a href="#"><img src="pic/our-works-front/work2.jpg" alt="">
                            <div>

                                <!-- our works  descr -->
                                <div class="our-works__descr">
                                    <span>Responsive</span>
                                    <span>Animations</span>
                                    <span>Landing page</span>
                                    <span>Promo</span>
                                </div>
                                <!--/our works  descr -->

                            </div>
                        </a>
                        <!--/# -->

                    </li>
                    <li>

                        <!-- # -->
                        <a href="#"><img src="pic/our-works-front/work3.jpg" alt="">
                            <div>

                                <!-- our works  descr -->
                                <div class="our-works__descr">
                                    <span>Responsive</span>
                                    <span>Animations</span>
                                </div>
                                <!--/our works  descr -->

                            </div>
                        </a>
                        <!--/# -->

                    </li>
                    <li>

                        <!-- # -->
                        <a href="#"><img src="pic/our-works-front/work4.jpg" alt="">
                            <div>

                                <!-- our works  descr -->
                                <div class="our-works__descr">
                                    <span>Responsive</span>
                                    <span>Animations</span>
                                    <span>Landing page</span>
                                </div>
                                <!--/our works  descr -->

                            </div>
                        </a>
                        <!--/# -->

                    </li>
                    <li>

                        <!-- # -->
                        <a href="#"><img src="pic/our-works-front/work5.jpg" alt="">
                            <div>

                                <!-- our works  descr -->
                                <div class="our-works__descr">
                                    <span>Responsive</span>
                                </div>
                                <!--/our works  descr -->

                            </div>
                        </a>
                        <!--/# -->

                    </li>
                </ul>
                <ul>
                    <li>

                        <!-- # -->
                        <a href="#"><img src="pic/our-works-front/work3.jpg" alt="">
                            <div>

                                <!-- our works  descr -->
                                <div class="our-works__descr">
                                    <span>Responsive</span>
                                    <span>Animations</span>
                                    <span>Landing page</span>
                                    <span>Promo</span>
                                </div>
                                <!--/our works  descr -->

                            </div>
                        </a>
                        <!--/# -->

                    </li>
                    <li>

                        <!-- # -->
                        <a href="#"><img src="pic/our-works-front/work5.jpg" alt="">
                            <div>

                                <!-- our works  descr -->
                                <div class="our-works__descr">
                                    <span>Responsive</span>
                                    <span>Animations</span>
                                    <span>Landing page</span>
                                    <span>Promo</span>
                                </div>
                                <!--/our works  descr -->

                            </div>
                        </a>
                        <!--/# -->

                    </li>
                    <li>

                        <!-- # -->
                        <a href="#"><img src="pic/our-works-front/work4.jpg" alt="">
                            <div>

                                <!-- our works  descr -->
                                <div class="our-works__descr">
                                    <span>Responsive</span>
                                    <span>Animations</span>
                                </div>
                                <!--/our works  descr -->

                            </div>
                        </a>
                        <!--/# -->

                    </li>
                    <li>

                        <!-- # -->
                        <a href="#"><img src="pic/our-works-front/work2.jpg" alt="">
                            <div>

                                <!-- our works  descr -->
                                <div class="our-works__descr">
                                    <span>Responsive</span>
                                    <span>Animations</span>
                                    <span>Landing page</span>
                                </div>
                                <!--/our works  descr -->

                            </div>
                        </a>
                        <!--/# -->

                    </li>
                    <li>

                        <!-- # -->
                        <a href="#"><img src="pic/our-works-front/work1.jpg" alt="">
                            <div>

                                <!-- our works  descr -->
                                <div class="our-works__descr">
                                    <span>Responsive</span>
                                </div>
                                <!--/our works  descr -->

                            </div>
                        </a>
                        <!--/# -->

                    </li>
                </ul>

                <!-- our works footer -->
                <div class="our-works-footer">
                    <div>

                        <!-- button -->
                        <a href="#" class="button light">
                            <span>посмотреть front end портфолио</span>
                        </a>
                        <!--/button -->

                    </div>
                    <p>256 работ</p>
                </div>
                <!--/our works footer -->

            </div>
            <!--/our works  wrap -->

        </div>
        <!--/our works -->
        <!-- article -->
        <section class="article light warranty">

            <!-- warranty  background text -->
            <div class="warranty__background-text">
                <span><?php echo($pageData1['garantiesbgword']) ?></span>
            </div>
            <!--/warranty  background text -->


            <!-- layout -->
            <div class="layout">

                <!-- warranty item -->
                <div class="warranty-item">
                    <h2><?php echo($pageData1['garanties1title']) ?></h2>
                    <ul>
                        <?php foreach ($pageData1['garanties1list'] as $garanties) { ?>
                            <li>
                                <?php echo $garanties['text'] ?>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
                <!--/warranty item -->


                <!-- warranty item -->
                <div class="warranty-item">
                    <h2><?php echo($pageData1['garanties2title']) ?></h2>
                    <ul>
                        <?php foreach ($pageData1['garanties2list'] as $garanties) { ?>
                            <li>
                                <?php echo $garanties['text'] ?>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
                <!--/warranty item -->

            </div>
            <!--/layout -->

        </section>
        <!--/article -->

        <!-- offer -->
        <div class="offer mesh">

            <!-- layout -->
            <div class="layout fd_align-center">

                <!-- button -->
                <a href="<?php echo($textPagesUrlProvider->getCommercialUrl()) ?>" class="button dark">
                    <span><?php echo Yii::t('app', 'request a free consultation and estimate of your project'); ?></span>
                </a>
                <!--/button -->

            </div>
            <!--/layout -->

        </div>
        <!--/offer -->



    </div>
    <!--/main wrap -->


