<div class="full-height form">

    <div class="full-height__layout">

        <div class="middle-text">
            <h1><?php echo $pageData['commercialtitle']; ?></h1>

            <h2><?php echo $pageData['commercialtitle1']; ?></h2>
             $adr =
            <form id="form-application" action=<?php echo "/email".$langUri."/commercial" ?> method="post" autocomplete="on" data-ajax novalidate
                  class="action-form">

                <div class="row">

                    <div class="input-wrap">
                        <label for="input-name"><?php echo Yii::t('app', 'company name') . '*'; ?></label>
                        <input id="input-name" type="text" name="name" data-fld-attr-required class="input">
                    </div>

                    <div class="input-wrap">
                        <label for="input-email"><?php echo Yii::t('app', 'your email') . '*'; ?></label>
                        <input id="input-email" type="email" name="email" data-fld-attr-required class="input">
                    </div>


                </div>

                <div class="row">

                    <div class="input-wrap">
                        <label for="input-contact"><?php echo Yii::t('app', 'contact person') . '*'; ?></label>
                        <input id="input-contact" type="text" name="contact" data-fld-attr-required class="input">
                    </div>

                    <div class="input-wrap">
                        <label for="input-phone"><?php echo Yii::t('app', 'your phone number'); ?></label>
                        <input id="input-phone" type="tel" name="tel" class="input">
                    </div>
                </div>

                <div class="row">

                    <div class="input-wrap text">
                        <label for="input-desk"><?php echo Yii::t('app', 'how do you see your future website?') . '*'; ?></label>
                        <textarea id="input-desk"
                            placeholder="<?php echo Yii::t('app', 'write briefly: in what area do you work, what are your goals, what and why do you want see on your website?'); ?>"
                            name="desc"></textarea>
                    </div>


                </div>

                <div class="align-center">

                    <button type="submit" class="button dark">
                        <span><?php echo Yii::t('app', 'send'); ?></span>
                    </button>

                </div>

            </form>

            <div class="form-answer">
                <span></span>
            </div>
        </div>
        <!--/middle text -->

        <div class="background-text">WWW</div>
    </div>

</div>
<div class="main-wrap">
</div>

