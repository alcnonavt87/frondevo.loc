<?php
use yii\helpers\Html;

$admPanelUri = Yii::$app->homeUrl;
?>
<!-- auth login -->
<?php echo Html::beginForm($admPanelUri.'login', 'post', ['id'=>"auth-login", 'class'=>"auth-form auth__login", 'autocomplete'=>"off"]); ?>
    <h2 class="auth__header">Вход в личный кабинет</h2>

    <!-- form row -->
    <div class="input-row input-wrap auth-form__row">
        <input type="text" name="authLogin" class="input auth-form_input auth-form_username" data-error="Поле обязательное для заполнения" placeholder="username" required>
    </div>
    <!--/form row -->

    <!-- form row -->
    <div class="input-row input-wrap auth-form__row">
        <input type="password" name="authPass" class="input auth-form_input auth-form_password" data-error="Поле обязательное для заполнения" placeholder="password" required>
    </div>
    <!--/form row -->

    <!-- auth controls -->
    <div class="auth-form__controls">

        <!-- checkbox - remember -->
        <div class="input__check-box-wrap auth-form_checkbox">
            <input id="input-checkbox__remember" name="remember" class="check-box" type="checkbox">
            <label for="input-checkbox__remember" class="check-box__label">Запомнить</label>
        </div>
        <!--/checkbox - remember -->

        <button type="submit" formnovalidate="formnovalidate" class="button auth-form_button auth-form_button-login">Вход</button>

    </div>
    <!--/auth controls -->
    
    <!-- forget password -->
    <div id="auth-form__forget-link" class="auth-form__forget-link">
        <span class="auth-form__link">Напомнить пароль?</span>
    </div>
    <!--/forget password -->
<?php echo Html::endForm(); ?>
<!--/auth login -->

<!-- auth forget password -->
<?php echo Html::beginForm($admPanelUri.'remember', 'post', ['id'=>"auth-forget", 'class'=>"auth-form auth__forget-password", 'autocomplete'=>"off"])  ?>
<!--<form id="auth-forget" action="<?php echo $admPanelUri; ?>auth/remember" method="post" class="auth-form auth__forget-password" autocomplete="off">-->
    <h2 class="auth__header">Напоминание пароля</h2>

    <!-- form row -->
    <div class="input-row input-wrap auth-form__row">
        <input type="email" data-error="E-mail is not valid" name="rememberEmail" class="input auth-form_input auth-form_email" placeholder="E-Mail" required>
    </div>
    <!--/form row -->

    <!-- auth controls -->
    <div class="auth-form__controls">

        <span class="button auth-form_button-back">Назад</span>

        <button type="submit" formnovalidate="formnovalidate" class="button auth-form_button auth-form_button-login">Отправить</button>

    </div>
    <!--/auth controls -->
<?php echo Html::endForm(); ?>    
<!--</form>-->

<!--/auth forget password -->
