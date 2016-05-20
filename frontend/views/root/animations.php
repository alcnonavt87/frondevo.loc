<?php
use frontend\models\Common;
use vendor\UrlProvider\SimpleModuleUrlProvider;
use vendor\UrlProvider\TextPagesUrlProvider;

$options['joinUris'] = 1;
$simpleModuleUrlProvider = new SimpleModuleUrlProvider($lang, $options);
$textPagesUrlProvider = new TextPagesUrlProvider($lang);
?>

<div class="full-height inner mesh">

    <?php if (!empty($pageData['imageanimationsbgbig'])) { ?>
        <picture>
            <source srcset="<?php echo('p/pages/biganimationsbg-'.$pageData['imageanimationsbgbig']) ?>" media="(min-height: 900px)">
            <source srcset="<?php echo('p/pages/smallanimationsbg-'.$pageData['imageanimationsbgsmall']) ?>" media="(min-height: 480px)">
            <img src="<?php echo('p/pages/smallanimationsbg-'.$pageData['imageanimationsbgsmall']) ?>" alt="" data-fit="cover">
        </picture>
    <?php }
    else {?>
        <video autoplay loop muted poster="video/poster.jpg" class="fs-bg-video">
            <source src="markup/video/games.mp4" type="video/mp4" codecs="avc1.42E01E, mp4a.40.2" media="(min-width: 1024px)">
            <source src="markup/video/games-720.mp4" type="video/mp4" codecs="avc1.42E01E, mp4a.40.2" media="(min-width: 768px)">
            <source src="markup/video/games-640.mp4" type="video/mp4" codecs="avc1.42E01E, mp4a.40.2" media="(min-width: 640px)">
            <source src="markup/video/games-320.mp4" type="video/mp4" codecs="avc1.42E01E, mp4a.40.2">
            <source src="markup/video/games.webm" type="video/webm" codecs="vp8, vorbis" media="(min-width: 1280px)">
            <source src="markup/video/games-720.webm" type="video/webm" codecs="vp8, vorbis" media="screen and (min-width: 992px)">
            <source src="markup/video/games-640.webm" type="video/webm" codecs="vp8, vorbis" media="(min-width: 640px)">
            <source src="markup/video/games-320.webm" type="video/webm" codecs="vp8, vorbis">
        </video>
    <?php } ?>

    
    <div class="full-height__layout">

        
        <div class="middle-text">

            
            <h1 class="fd__title_type1 fd__title_xs-esmall">
                            <span>
                                <!--each item, index in page.data.siteText.top//span= item
                                -->
                            </span>
                            <span> <?php echo($pageData['animationssmainscreentitle']) ?></span>
            </h1>
            

            <p><?php echo($pageData['animationsmainscreentitle1']) ?></p>
        </div>
        

        <div class="direct-line"></div>
        <div class="arrow"></div>
    </div>
    

</div>




<div class="main-wrap">

    
    <section class="article light why2">
        <h2>
            <?php echo($pageData['animationsadvtitle']) ?>
        </h2>

        
        <div class="layout">

            <div class="why-dl">
                <?php foreach ($pageData2 as $advantages) { ?>
                    <div class="why-dl-row">
                        <div class="why-dt"><?php echo($advantages['title']) ?></div>
                        <div class="why-dd">
                            <?php if (!empty($advantages['paragraph'])) { ?>
                                <p><?php echo($advantages['paragraph']) ?></p><?php } ?>
                            <ul>
                                <?php foreach ($advantages['advlist'] as $key => $item) { ?>
                                    <li><?php echo($item['text']) ?> </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                <?php } ?>

            </div>

        </div>
        

    </section>
    


    
    <div class="our-works our-works_type2 our-works_vert">
        <h2>
            <span><?php echo($pageData['worksexamplesanimationstitle']) ?></span>
        </h2>

        

        <div class="our-works__wrap">
            <ul>

                <?php foreach ($works as $key =>$work) { ?>
                    <?php if ($key%5 == 0)echo('</ul> <ul>') ?>
                    <li>
                        <?php
                        $params['item'] = $work;
                        $workUrl = $simpleModuleUrlProvider->geteWorksFrontOutItemUrl($params);
                        ?>
                        <a href="<?php echo $workUrl; ?>"><img src="<?php echo $work['imgPath']; ?>" alt="">

                            <div>
                                
                                <div class="our-works__descr">
                                    <span><?php echo Yii::t('app', 'Front end development:'); ?></span>
                                    <span>
                                    <?php foreach ($work['desclist'] as $key => $item) { ?>
                                        <span><?php echo($item['text'])?></span>
                                    <?php } ?>

                                </div>
                                
                            </div>
                        </a>
                    </li>

                <?php } ?>
            </ul>

            
            <div class="our-works-footer">
                <div>

                    
                    <a href="<?php echo $textPagesUrlProvider->getPortfolifrontoutUrl();?>" class="button light">
                        <span><?php echo Yii::t('app', 'to see a front end portfolio');?></span>
                    </a>
                    

                </div>
                <p><?php echo $workscount .' '. Yii::t('app', 'works');?></p>
            </div>
            

        </div>
        

    </div>
    
    
    <section class="article light warranty">

        
        <div class="warranty__background-text">
            <span><?php echo($pageData1['garantiesbgword']) ?></span>
        </div>
        


        
        <div class="layout">

            
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
            

        </div>
        

    </section>
    

    
    <div class="offer mesh">

        
        <div class="layout fd_align-center">

            
            <a href="<?php echo($textPagesUrlProvider->getCommercialUrl()) ?>" class="button dark">
                <span><?php echo Yii::t('app', 'request a free consultation and estimate of your project'); ?></span>
            </a>
            

        </div>
        

    </div>
    



</div>
