<?php
use frontend\models\Common;
use vendor\UrlProvider\SimpleModuleUrlProvider;
use vendor\UrlProvider\TextPagesUrlProvider;

$options['joinUris'] = 1;
$simpleModuleUrlProvider = new SimpleModuleUrlProvider($lang, $options);
$textPagesUrlProvider = new TextPagesUrlProvider($lang);
?><!-- full height -->
<div class="full-height inner mesh">
    <picture>
        <source srcset="<?php echo('p/pages/bigangularbg-'.$pageData['imageangularbgbig']) ?>" media="(min-height: 900px)">
        <source srcset="<?php echo('p/pages/smallangularbg-'.$pageData['imageangularbgsmall']) ?>" media="(min-height: 480px)">
        <img src="<?php echo('p/pages/smallangularbg-'.$pageData['imageangularbgsmall']) ?>" alt="" data-fit="cover">
    </picture>


    <!-- full height  layout -->
    <div class="full-height__layout">

        <!-- middle text -->
        <div class="middle-text">

            <!-- fd  title type1 -->
            <h1 class="fd__title_type1">
                <?php echo($pageData['angularmainscreentitle']) ?>
            </h1>
            <!--/fd  title type1 -->

            <p><?php echo($pageData['angularmainscreentitle1']) ?></p>
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
    <section class="article light why">
        <h2>Почему AngularJs?</h2>

        <!-- layout -->
        <div class="layout">

            <!-- why item -->
            <div class="why-item">
                <ul>
                    <li>Легкая масштабируемость приложений</li>
                    <li>Высокая скорость работы и малый вес приложений</li>
                    <li>Полная независимость от back end платформы</li>
                    <li>Легкая локализация</li>
                    <li>Быстрая отладка</li>
                </ul>
            </div>
            <!--/why item -->


            <!-- why item -->
            <div class="why-item">
                <ul>
                    <li>Высокая уровень гибкости</li>
                    <li>Сокращение времени разработки</li>
                    <li>Возможность «из коробки» создавать REST приложения</li>
                    <li>Простая интеграция с веб страницами</li>
                    <li>Постоянное  совершенствование фреймворка и мощное сообщество разработчиков</li>
                </ul>
            </div>
            <!--/why item -->

        </div>
        <!--/layout -->

    </section>
    <!--/article -->


    <!-- our works -->
    <div class="our-works our-works_type2 our-works_vert">
        <h2>
            <span>Примеры разработок на AngularJs от нашей команды</span>
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

