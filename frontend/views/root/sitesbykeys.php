<?php
use frontend\models\Common;
use vendor\UrlProvider\SimpleModuleUrlProvider;
use vendor\UrlProvider\TextPagesUrlProvider;

$options['joinUris'] = 1;
$simpleModuleUrlProvider = new SimpleModuleUrlProvider($lang, $options);
$textPagesUrlProvider = new TextPagesUrlProvider($lang);
?>

<div class="full-height inner mesh">
    <picture>
        <source srcset="<?php echo('p/pages/generalbgsbk-'.$pageData1['imagebgsbk']) ?>" media="(min-height: 900px)">
        <source srcset="<?php echo('p/pages/mediumbgsbk-'.$pageData1['imagebgsbklp']) ?>" media="(min-height: 736px)">
        <source srcset="<?php echo('p/pages/smallbgsbk-'.$pageData1['imagebgsbkmb']) ?>" media="(min-height: 480px)">
        <img src="<?php echo('p/pages/smallbgsbk-'.$pageData1['imagebgsbkmb']) ?>" alt="" data-fit="cover">
    </picture>

   
    <div class="full-height__layout">

       
        <div class="middle-text">

           <?php echo($pageData['pContent']) ?>

            <p><?php echo($pageData1['sbkdescription']) ?></p>
        </div>
       

        <div class="direct-line"></div>
        <div class="arrow"></div>
        <div class="background-text"><?php echo($pageData1['textforbackground']) ?></div>
    </div>
   

</div>




<div class="main-wrap">


    <?php echo($pageData1['section1']) ?>

   
    <div class="our-works">
        <h2>
            <?php echo($pageData1['section2']) ?>
        </h2>

        <h3>  <?php echo($pageData1['sbkworkstext']) ?></h3>


       
        <div class="our-works__wrap">
            <ul>
                <li class="long">
                    <a href="<?php echo Yii::$app->request->absoluteUrl.'/portfolio/'.$works2[0]['url'] ?>"><img src="<?php echo 'p/pages/bigsbk-'.$works2[0]['sbkimgwork1']?>" alt="">
                        <div>
                            <span><?php echo $works2[0]['sbkdeskwork1']?></span>
                        </div>
                    </a>
                </li>

                <li>
                    <a href="<?php echo Yii::$app->request->absoluteUrl.'/portfolio/'.$works2[0]['url1'] ?>"><img src="<?php echo 'p/pages/mediumsbk-'.$works2[0]['sbkimgwork2']?>" alt="">
                        <div>
                            <span><?php echo $works2[0]['sbkdeskwork2']?></span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo Yii::$app->request->absoluteUrl.'/portfolio/'.$works2[0]['url2'] ?>"><img src="<?php echo 'p/pages/mediumsbk-'.$works2[0]['sbkimgwork3']?>" alt="">
                        <div>
                            <span><?php echo $works2[0]['sbkdeskwork3']?></span>
                        </div>
                    </a>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="<?php echo Yii::$app->request->absoluteUrl.'/portfolio/'.$works2[0]['url3'] ?>"><img src="<?php echo 'p/pages/mediumsbk-'.$works2[0]['sbkimgwork4']?>" alt="">
                        <div>
                            <span><?php echo $works2[0]['sbkdeskwork4']?></span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo Yii::$app->request->absoluteUrl.'/portfolio/'.$works2[0]['url4'] ?>"><img src="<?php echo 'p/pages/mediumsbk-'.$works2[0]['sbkimgwork5']?>" alt="">
                        <div>
                            <span><?php echo $works2[0]['sbkdeskwork5']?></span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo Yii::$app->request->absoluteUrl.'/portfolio/'.$works2[0]['url5'] ?>"><img src="<?php echo 'p/pages/mediumsbk-'.$works2[0]['sbkimgwork6']?>" alt="">
                        <div>
                            <span><?php echo $works2[0]['sbkdeskwork6']?></span>
                        </div>
                    </a>
                </li>
                <li >
                    <a href="<?php echo Yii::$app->request->absoluteUrl.'/portfolio/'.$works2[0]['url6'] ?>"><img src="<?php echo 'p/pages/mediumsbk-'.$works2[0]['sbkimgwork7']?>" alt="">
                        <div>
                            <span><?php echo $works2[0]['sbkdeskwork7']?></span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
   


   
    <div class="approach">

       
        <div class="layout">
            <h2>
                <?php echo($pageData1['section3']) ?>
            </h2>

            <h3> <?php echo($pageData1['sbksmalltitle3']) ?></h3>

           
            <div class="approach__list-wrap">

               
                <div class="approach__list">

                   
                    <div class="approach__item">
                        <h3><?php echo($pageData1['sbktitlestep1']) ?></h3>

                        <p><?php echo($pageData1['sbkdeskstep1']) ?></p>
                    </div>
                   


                   
                    <div class="approach__item">
                        <h3><?php echo($pageData1['sbktitlestep2']) ?></h3>

                        <p><?php echo($pageData1['sbkdeskstep2']) ?></p>
                    </div>
                   


                   
                    <div class="approach__item">
                        <h3><?php echo($pageData1['sbktitlestep3']) ?></h3>

                        <p><?php echo($pageData1['sbkdeskstep3']) ?></p>
                    </div>
                   

                </div>
               


               
                <div class="approach__list">

                   
                    <div class="layout">

                       
                        <div class="approach__item">
                            <h3><?php echo($pageData1['sbktitlestep4']) ?></h3>

                            <p><?php echo($pageData1['sbkdeskstep4']) ?></p>
                        </div>
                       


                       
                        <div class="approach__item">
                            <h3><?php echo($pageData1['sbktitlestep5']) ?></h3>

                            <p><?php echo($pageData1['sbkdeskstep5']) ?></p>
                        </div>
                       


                       
                        <div class="approach__item">
                            <h3><?php echo($pageData1['sbktitlestep6']) ?></h3>

                            <p><?php echo($pageData1['sbkdeskstep6']) ?></p>
                        </div>
                       


                       
                        <div class="approach__item">
                            <h3><?php echo($pageData1['sbktitlestep7']) ?></h3>

                            <p><?php echo($pageData1['sbkdeskstep7']) ?></p>
                        </div>
                       

                    </div>
                   

                </div>
               

            </div>
           

        </div>
       

    </div>
   


   
    <div id="indicators1" class="stages hor-indicators">

       
        <div class="stages__back">
            <div class="hor-ind"></div>
        </div>
       

        <div class="stages__back stages__back-2"><img src="markup/img/sites/frondevo.png" alt="Сайты"
                                                      width="4826" height="612" class="hor-ind"></div>

       
        <div class="stages__wrap">
            <h2><?php echo($pageData1['section4']) ?></h2>

            <h3><?php echo($pageData1['sbksmalltitle']) ?></h3>

           
            <div data-indicators="indicators1" class="stages__layout hor-wrapper">

               
                <div class="stages__scroll hor-scroller hor-scrollbar hor-snap-mobile">

                   
                    <ul class="stages__list">

                       
                        <li class="stages__item hor-sizing hor-snap researching">
                            <h3><?php echo($pageData1['sbkstagetitle1']) ?></h3>

                            <div>
                                <ul>
                                    <?php foreach ($pageData1['sbkstagelist1'] as $stagelist) { ?>

                                        <li><?php echo $stagelist['text'] ?></li>

                                    <?php } ?>
                                </ul>
                            </div>
                        </li>
                       


                       
                        <li class="stages__item hor-sizing hor-snap projecting">
                            <h3><?php echo($pageData1['sbkstagetitle2']) ?></h3>

                            <div>
                                <ul>
                                    <?php foreach ($pageData1['sbkstagelist2'] as $stagelist) { ?>

                                        <li><?php echo $stagelist['text'] ?></li>

                                    <?php } ?>
                                </ul>
                            </div>
                        </li>
                       


                       
                        <li class="stages__item hor-sizing hor-snap designing">
                            <h3><?php echo($pageData1['sbkstagetitle3']) ?></h3>

                            <div>
                                <ul>
                                    <?php foreach ($pageData1['sbkstagelist3'] as $stagelist) { ?>

                                        <li><?php echo $stagelist['text'] ?></li>

                                    <?php } ?>
                                </ul>
                            </div>
                        </li>
                       


                       
                        <li class="stages__item hor-sizing hor-snap developing">
                            <h3><?php echo($pageData1['sbkstagetitle4']) ?></h3>

                            <div>
                                <ul>
                                    <?php foreach ($pageData1['sbkstagelist4'] as $stagelist) { ?>

                                        <li><?php echo $stagelist['text'] ?></li>

                                    <?php } ?>
                                </ul>
                            </div>
                        </li>
                       


                       
                        <li class="stages__item hor-sizing hor-snap contenting">
                            <h3><?php echo($pageData1['sbkstagetitle5']) ?></h3>

                            <div>
                                <ul>
                                    <?php foreach ($pageData1['sbkstagelist5'] as $stagelist) { ?>

                                        <li><?php echo $stagelist['text'] ?></li>

                                    <?php } ?>
                                </ul>
                            </div>
                        </li>
                       


                       
                        <li class="stages__item hor-sizing hor-snap supporting">
                            <h3><?php echo($pageData1['sbkstagetitle6']) ?></h3>

                            <div>
                                <ul>
                                    <?php foreach ($pageData1['sbkstagelist6'] as $stagelist) { ?>

                                        <li><?php echo $stagelist['text'] ?></li>

                                    <?php } ?>
                                </ul>
                            </div>
                        </li>
                       

                    </ul>
                   

                </div>
               

            </div>
           

        </div>
       

    </div>
   


   
    <div class="customers">

       
        <div class="customers__background-text">
            <span>P.S.</span>
        </div>
       


       
        <div class="layout">
            <h2>
                <?php echo($pageData1['section5']) ?>
            </h2>
            <ul>
                <?php foreach ($pageData1['sbkpslist'] as $pslist) { ?>


                    <li><?php echo $pslist['text'] ?></li>

                <?php } ?>
            </ul>
        </div>
       

    </div>
   


   
    <div class="offer mesh">

       
        <div class="layout fd_align-center">

           
            <a href="<?php echo($textPagesUrlProvider->getCommercialUrl()) ?>" class="button dark">
                <span><?php echo Yii::t('app', 'request a free consultation and estimate of your project'); ?></span>
            </a>
           

        </div>
       

    </div>
   

</div>




