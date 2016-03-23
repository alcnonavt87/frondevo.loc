<?php
use yii\helpers\Html;

//Навигационное меню НАЧАЛО
$navMenu = '<nav class="sidebar__menu">';
if (is_file(Yii::$app->basePath.'/views/parts/OneButtonsSView.php')) {
    require Yii::$app->basePath.'/views/parts/OneButtonsSView.php';
}
$navMenu .= '</nav>';
//Навигационное меню КОНЕЦ

//Хлебные крошки НАЧАЛО
$content = '<ul class="crumbs">
                <li class="crumbs__item"><a href="/'.$id1Uri.'/'.$pageLang.'" data-href="formlist">'.$pageGroupData[0]['groupName'].'</a></li>
                <li class="crumbs__item crumbs__item-active">'.$settingsPageName.'</li>
            </ul>';
//Хлебные крошки КОНЕЦ

$content .= Html::beginForm($admPanelUri.'formupdate/'.$id1Uri.'/'.$defLang, 'post', ['id'=>"form-edit-content"]).
                '<fieldset class="catalog__section">
                '.$this->createHeader('Данные пользователя').'
                    <div class="catalog__section-data">
                    '.$this->createInput(array('id'=> 'email', 'text' => 'Email пользователя', 'width' => 400, 'name' => 'email', 'value' => Yii::$app->getUser()->getIdentity()->email, 'attr' => 'required autofocus autocomplete="off"')).'
                    '.$this->createInput(array('id'=> 'username', 'text' => 'Имя пользователя', 'width' => 400, 'name' => 'username', 'value' => Yii::$app->getUser()->getIdentity()->username, 'attr' => 'required')).'
                    '.$this->createInput(array('id'=> 'name', 'text' => 'Имя', 'width' => 400, 'name' => 'name', 'value' => Yii::$app->getUser()->getIdentity()->name, 'attr' => 'required')).'
                    '.$this->createInput(array('id'=> 'surname', 'text' => 'Фамилия', 'width' => 400, 'name' => 'surname', 'value' => Yii::$app->getUser()->getIdentity()->surname, 'attr' => 'required')).'
                    </div>
                </fieldset>
                <fieldset class="catalog__section">
                '.$this->createHeader('Сменить пароль').'
                    <div class="catalog__section-data">
                    '.$this->createInput(array('id'=> 'pass', 'text' => 'Старый пароль', 'width' => 400, 'name' => 'pass', 'value' => '')).'
                    '.$this->createInput(array('id'=> 'newPass1', 'text' => 'Новый пароль', 'width' => 400, 'name' => 'newPass1', 'value' => '')).'
                    '.$this->createInput(array('id'=> 'newPass2', 'text' => 'Подтверждение нового пароля', 'width' => 400, 'name' => 'newPass2', 'value' => '')).'
                    </div>
                </fieldset>'.
            Html::endForm();