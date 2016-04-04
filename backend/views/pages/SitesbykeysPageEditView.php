<?php
use yii\helpers\Html;

//Навигационное меню НАЧАЛО
$navMenu = '<nav class="sidebar__menu">';
if (is_file(Yii::$app->basePath.'/views/parts/LangsView.php')) {
    require Yii::$app->basePath.'/views/parts/LangsView.php';
}
if (is_file(Yii::$app->basePath.'/views/parts/TwoButtonsSPView.php')) {
    require Yii::$app->basePath.'/views/parts/TwoButtonsSPView.php';
}
$navMenu .= '</nav>';
//Навигационное меню КОНЕЦ

//Хлебные крошки НАЧАЛО
$content = '<ul class="crumbs">
                <li class="crumbs__item"><a href="/'.$id1Uri.'/'.$defLang.'" data-href="formlist">'.$pageGroupData[0]['groupName'].'</a></li>
                <li class="crumbs__item crumbs__item-active">'.$textPageHeader.'</li>
            </ul>';
//Хлебные крошки КОНЕЦ//



// Группа чекбоксов "Отображаемые работы"
$worksList = [];
foreach ($works as $key => $item) {
	$checked = '';
	
	if (in_array($item['id'], $worksIds)) {
		$checked = 'checked="checked"';
	}
	
	$worksList[] = ['id'=> 'works'.$key, 'text' => $item['id'], 'width' => 400, 'name' => 'worksIds[]', 'value' => $item['id'], 'attr' => $checked];
}/* UpdateCode */


$content .= Html::beginForm($admPanelUri.'formupdate/'.$id1Uri.'/'.$page[0]['id'].'/'.$pageLang, 'post', ['id'=>"form-edit-content"]).
                '<!-- sectionPageData --><fieldset class="catalog__section">
                '.$this->createHeader('Основные данные страницы').'
                    <div class="catalog__section-data">
                    <!-- pH1 -->'.$this->createInput(['id'=> 'pH1', 'text' => 'Заголовок новости H1', 'width' => 400, 'name' => 'pH1', 'value' => $page[0]['pH1'], 'attr' => 'required autofocus autocomplete="off"']).'<!-- /pH1 -->
					<!-- pTitle -->'.$this->createInput(['id'=> 'pTitle', 'text' => 'Заголовок страницы', 'placeholder' => 'В поисковой выдаче видно 60 символов', 'width' => 400, 'name' => 'pTitle', 'value' => $page[0]['pTitle'], 'attr' => 'required data-count="60"', 'dataCopy' => 'pH1', 'titleCopy' => 'Копия заголовка H1']).'<!-- /pTitle -->
                    <!-- pDescription -->'.$this->createTextArea(['id'=> 'pDescription', 'text' => 'Meta description', 'placeholder' => 'В поисковой выдаче видно 140 символов', 'width' => '400x100', 'name' => 'pDescription', 'value' => $page[0]['pDescription'], 'attr' => 'data-count="140"']).'<!-- /pDescription -->
                    <!-- pKeyWords -->'.$this->createInput(['id'=> 'pKeyWords', 'text' => 'Meta keywords', 'width' => 400, 'name' => 'pKeyWords', 'value' => $page[0]['pKeyWords'], 'attr' => '']).'<!-- /pKeyWords -->
                    <!-- pMenuName -->'.$this->createInput(['id'=> 'pMenuName', 'text' => 'Заголовок для главного меню', 'width' => 400, 'name' => 'pMenuName', 'value' => $page[0]['pMenuName'], 'attr' => 'required']).'<!-- /pMenuName -->
                    <!-- pBreadCrumbs -->'.$this->createInput(['id'=> 'pBreadCrumbs', 'text' => 'Хлебные крошки', 'width' => 400, 'name' => 'pBreadCrumbs', 'value' => $page[0]['pBreadCrumbs'], 'attr' => 'required']).'<!-- /pBreadCrumbs -->
                    </div>
                </fieldset>

                <fieldset class="catalog__section">
                '.$this->createHeader('Редактирование контента страницы').'
                <!-- pContent -->'.$this->createTextArea(['id'=> 'pContent', 'text' => '', 'width' => '400x100', 'name' => 'pContent', 'value' => $page[0]['pContent'], 'attr' => 'data-module="tinymce"']).'<!-- /pContent -->
                </fieldset><!-- /sectionPageData --><!-- /createFinish -->

<!-- section1 --><fieldset class="catalog__section">
	'.$this->createHeader('Секция1').'
	<div class="catalog__section-data">
		<!-- section1 -->'.$this->createTextArea(['id'=> 'section1', 'text' => 'Секция1', 'width' => '400x100', 'name' => 'content[section1]', 'value' => $pagesItem['section1'], 'attr' => 'data-module="tinymce"']).'<!-- /section1 -->

<!-- section2 --><fieldset class="catalog__section">
	'.$this->createHeader('Секция2').'
	<div class="catalog__section-data">
		<!-- section2 -->'.$this->createTextArea(['id'=> 'section2', 'text' => 'Секция2', 'width' => '400x100', 'name' => 'content[section2]', 'value' => $pagesItem['section2'], 'attr' => 'data-module="tinymce"']).'<!-- /section2 -->
		<!-- works -->'.$this->createCheckBoxGroup(['list' => $worksList]).'<!-- /works -->
</fieldset><!-- /section2 -->

<!-- section3 --><fieldset class="catalog__section">
	'.$this->createHeader('Секция3').'
	<div class="catalog__section-data">
		<!-- section3 -->'.$this->createTextArea(['id'=> 'section3', 'text' => 'Секция3', 'width' => '400x100', 'name' => 'content[section3]', 'value' => $pagesItem['section3'], 'attr' => 'data-module="tinymce"']).'<!-- /section3 -->
</fieldset><!-- /section3 -->

<!-- section4 --><fieldset class="catalog__section">
	'.$this->createHeader('Секция4').'
	<div class="catalog__section-data">
		<!-- section4 -->'.$this->createTextArea(['id'=> 'section4', 'text' => 'Секция4', 'width' => '400x100', 'name' => 'content[section4]', 'value' => $pagesItem['section4'], 'attr' => 'data-module="tinymce"']).'<!-- /section4 -->

</fieldset><!-- /section4 -->

<!-- section5 --><fieldset class="catalog__section">
	'.$this->createHeader('Секция5').'
	<div class="catalog__section-data">
		<!-- section5 -->'.$this->createTextArea(['id'=> 'section5', 'text' => 'Секция5', 'width' => '400x100', 'name' => 'content[section5]', 'value' => $pagesItem['section5'], 'attr' => 'data-module="tinymce"']).'<!-- /section5 -->
</fieldset><!-- /section5 -->

'.
            Html::endForm();