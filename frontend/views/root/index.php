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
                


                
                <div class="align-center">

                    
                    <div class="button-wrap">

                        
                        <a href="<?php echo $textPagesUrlProvider->getSitesByKeysUrl()?>" class="button dark hidden">
                            <span><?php echo $pageData['indexTextButton']?></span>
                        </a>
                        

                        <canvas width="100" height="100" data-stroke="true"></canvas>
                    </div>
                    

                </div>
                

                <div class="footer__text"><?php echo $pageData['pContent']?></div>
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




