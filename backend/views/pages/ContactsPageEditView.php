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
                <!--<li class="crumbs__item"><a href="/'.$id1Uri.'/'.$defLang.'" data-href="formlist">'.$pageGroupData[0]['groupName'].'</a></li>-->
                <li class="crumbs__item crumbs__item-active">'.$textPageHeader.'</li>
            </ul>';
//Хлебные крошки КОНЕЦ



// Группа чекбоксов "Выбор ссылок отображаемых в футере"
$linksList = [];
foreach ($links as $key => $item) {
	$checked = '';
	
	if (in_array($item['id'], $linksIds)) {
		$checked = 'checked="checked"';
	}
	
	$linksList[] = ['id'=> 'links'.$key, 'text' => $item['title'], 'width' => 400, 'name' => 'linksIds[]', 'value' => $item['id'], 'attr' => $checked];
}/* UpdateCode */

$content .= Html::beginForm($admPanelUri.'formupdate/'.$id1Uri.'/'.$page[0]['id'].'/'.$pageLang, 'post', ['id'=>"form-edit-content"]).
                '<!-- sectionPageData --><fieldset class="catalog__section">
                '.$this->createHeader('Основные данные страницы').'
                    <div class="catalog__section-data">
                    <!-- pH1 -->'.$this->createInput(['id'=> 'pH1', 'text' => 'Заголовок новости H1', 'width' => 400, 'name' => 'pH1', 'value' => $page[0]['pH1'], 'attr' => 'required autofocus autocomplete="off"']).'<!-- /pH1 -->
					<!-- pTitle -->'.$this->createInput(['id'=> 'pTitle', 'text' => 'Заголовок страницы', 'placeholder' => 'В поисковой выдаче видно 60 символов', 'width' => 400, 'name' => 'pTitle', 'value' => $page[0]['pTitle'], 'attr' => 'required data-count="60"', 'dataCopy' => 'pH1', 'titleCopy' => 'Копия заголовка H1']).'<!-- /pTitle -->
                    <!-- pUrl -->'.$this->createInput(['id' => 'pUrl', 'text' => 'Алиас страницы', 'width' => 400, 'name' => 'base[Url]', 'value' => $page[0]['Url'], 'attr' => 'required', 'genUrl' => 'pH1', 'titleUrl' => 'Генерация с заголовка H1']).'<!-- /pUrl -->
                    <!-- pDescription -->'.$this->createTextArea(['id'=> 'pDescription', 'text' => 'Meta description', 'placeholder' => 'В поисковой выдаче видно 140 символов', 'width' => '400x100', 'name' => 'pDescription', 'value' => $page[0]['pDescription'], 'attr' => 'data-count="140"']).'<!-- /pDescription -->
                    <!-- pMenuName -->'.$this->createInput(['id'=> 'pMenuName', 'text' => 'Заголовок для главного меню', 'width' => 400, 'name' => 'pMenuName', 'value' => $page[0]['pMenuName'], 'attr' => 'required']).'<!-- /pMenuName -->
                    </div>
                </fieldset>

                <fieldset class="catalog__section">
		<!-- adresscontacts -->'.$this->createInput(['id'=> 'adresscontacts', 'text' => 'Адрес', 'placeholder' => '', 'width' => 400, 'name' => 'content[adresscontacts]', 'value' => $pagesItem['adresscontacts'], 'attr' => '']).'<!-- /adresscontacts -->
		<!-- telcontacts -->'.$this->createInput(['id'=> 'telcontacts', 'text' => 'Телефон', 'placeholder' => '', 'width' => 400, 'name' => 'content[telcontacts]', 'value' => $pagesItem['telcontacts'], 'attr' => '']).'<!-- /telcontacts -->
		<!-- emailcontacts -->'.$this->createInput(['id'=> 'emailcontacts', 'text' => 'Email', 'width' => '400', 'name' => 'content[emailcontacts]', 'value' => $pagesItem['emailcontacts'], 'attr' => '']).'<!-- /emailcontacts -->
		'.$this->createHeader('Выбор ссылок отображаемых в футере').'
		<!-- links -->'.$this->createCheckBoxGroup(['list' => $linksList]).'<!-- /links -->

<!-- social --><fieldset class="catalog__section">
	'.$this->createHeader('Социальные сети').'
	<div class="catalog__section-data">
		<!-- snVkontakte -->'.$this->createInput(['id'=> 'snVkontakte', 'text' => 'Вконтакте', 'placeholder' => '', 'width' => 400, 'name' => 'content[snVkontakte]', 'value' => $pagesItem['snVkontakte'], 'attr' => '']).'<!-- /snVkontakte -->
		<!-- snFacebook -->'.$this->createInput(['id'=> 'snFacebook', 'text' => 'Фэйсбук', 'placeholder' => '', 'width' => 400, 'name' => 'content[snFacebook]', 'value' => $pagesItem['snFacebook'], 'attr' => '']).'<!-- /snFacebook -->
		<!-- snTwitter -->'.$this->createInput(['id'=> 'snTwitter', 'text' => 'Твиттер', 'placeholder' => '', 'width' => 400, 'name' => 'content[snTwitter]', 'value' => $pagesItem['snTwitter'], 'attr' => '']).'<!-- /snTwitter -->
		<!-- snBahance -->'.$this->createInput(['id'=> 'snBahance', 'text' => 'Behance', 'placeholder' => '', 'width' => 400, 'name' => 'content[snBahance]', 'value' => $pagesItem['snBahance'], 'attr' => '']).'<!-- /snBahance -->
		<!-- snInstagram -->'.$this->createInput(['id'=> 'snInstagram', 'text' => 'Instagram', 'placeholder' => '', 'width' => 400, 'name' => 'content[snInstagram]', 'value' => $pagesItem['snInstagram'], 'attr' => '']).'<!-- /snInstagram -->
		<!-- snBall -->'.$this->createInput(['id'=> 'snBall', 'text' => 'Ball', 'placeholder' => '', 'width' => 400, 'name' => 'content[snBall]', 'value' => $pagesItem['snBall'], 'attr' => '']).'<!-- /snBall -->
		<!-- snPinterest -->'.$this->createInput(['id'=> 'snPinterest', 'text' => 'Pinterest', 'placeholder' => '', 'width' => 400, 'name' => 'content[snPinterest]', 'value' => $pagesItem['snPinterest'], 'attr' => '']).'<!-- /snPinterest -->
	</div>
</fieldset><!-- /social -->
                </fieldset><!-- /sectionPageData --><!-- /createFinish -->'.
            Html::endForm();