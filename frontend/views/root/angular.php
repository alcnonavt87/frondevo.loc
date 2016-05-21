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
        <source srcset="<?php echo('p/pages/bigangularbg-'.$pageData['imageangularbgbig']) ?>" media="(min-height: 900px)">
        <source srcset="<?php echo('p/pages/smallangularbg-'.$pageData['imageangularbgsmall']) ?>" media="(min-height: 480px)">
        <img src="<?php echo('p/pages/smallangularbg-'.$pageData['imageangularbgsmall']) ?>" alt="" data-fit="cover">
    </picture>


    
    <div class="full-height__layout">

        
        <div class="middle-text">

            
            <h1 class="fd__title_type1">
                <?php echo($pageData['angularmainscreentitle']) ?>
            </h1>
            

            <p><?php echo($pageData['angularmainscreentitle1']) ?></p>
        </div>
        

        <div class="direct-line"></div>
        <div class="arrow"></div>
    </div>
    

</div>




<div class="main-wrap">

    
    <section class="article light why">
        <h2> <?php echo($pageData['causesAngulartitle']) ?></h2>

        
        <div class="layout">
            <div class="why-item">
                <ul>
            <?php foreach ($pageData['causesAngularlist'] as $item) { ?>
                <li><?php echo($item['text']) ?></li>
            <?php } ?>
                </ul>
            </div>

            <div class="why-item">
                <ul>
                    <?php foreach ($pageData['causesAngularlist1'] as $item) { ?>
                        <li><?php echo($item['text']) ?></li>
                    <?php } ?>
                </ul>
            </div>


        </div>
        

    </section>
    


    
    <div class="our-works our-works_type2 our-works_vert">
        <h2>
            <span><?php echo($pageData['worksexamplesangulartitle']) ?></span>
        </h2>

        
        
        <div class="our-works__wrap">
            <ul>

                <?php foreach ($works as $key => $work) { ?>
                    <?php if ($key !=0 && $key % 5 == 0) echo('</ul> <ul>') ?>
                    <li>
                        <?php
                        $params['item'] = $work;
                        $workUrl = $simpleModuleUrlProvider->geteWorksFrontOutItemUrl($params);
                        ?>
                        <a href="<?php echo $workUrl; ?>"><img src="<?php echo $work['imgPath']; ?>" alt="">

                            <div>

                                <div class="our-works__descr">

                                    <?php foreach ($work['desclist'] as $key => $item) { ?>
                                        <span><?php echo($item['text']) ?></span>
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


