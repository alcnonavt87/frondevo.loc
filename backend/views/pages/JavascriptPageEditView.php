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
//Хлебные крошки КОНЕЦ

// Ссылка на преимущества
$advLink = '<p><a data-href="formlist" href="/'.$advPageGroupData['id'].'/'.$defLang.'" class="link">'.$advPageGroupData['groupName'].'</a></p>';
$content .= $advLink;


// Вывод одного изображения "Изображение для background(desktop 1950x1100)" НАЧАЛО
$imagejavascript5bgbigOne = '<fieldset class="catalog__section">'.
$this->createHeader('Изображение для background(desktop 1920x1100)');
if ($pagesItem['imagejavascript5bgbig'] <> '') {
	$imagejavascript5bgbigOne .= '<div class="fa__uploader single" id="uploader0-imagejavascript5bgbig" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">
					<div class="fa__file">
						<a href="/frontend/web/p/pages/bigjavascriptbg-'.$pagesItem['imagejavascript5bgbig'].'" title="'.$pagesItem['imagejavascript5bgbigTitle'].'" class="cboxElement" rel="uploader0">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/frontend/web/p/pages/bigjavascriptbg-'.$pagesItem['imagejavascript5bgbig'].'" width="100%" height="auto" alt="'.$pagesItem['imagejavascript5bgbigTitle'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[imagejavascript5bgbig-one][imgTitle]" value="'.$this->getCodeStr($pagesItem['imagejavascript5bgbigTitle']).'">
								<input class="item-deleted" type="hidden" name="images[imagejavascript5bgbig-one][deleted]" value="0">
							</span>
							<span class="fa__file-title">'.$pagesItem['imagejavascript5bgbigTitle'].'</span>
						</a>
						<input class="button button_small button_edit" type="button" title="Редактировать" value="Редактировать">
						<input class="button button_small button_delete" type="button" title="Удалить" value="Удалить">
					</div>
				</div>
				<div class="fa__file-edit-wrap">
					<h2 class="catalog__section-header-text" data-load="Загрузка" data-edit="Редактирование">Загрузка</h2>
					<ul class="fa__file-edit-list"></ul>
				</div>
		</div>';
} else {
	$imagejavascript5bgbigOne .= '<div class="fa__uploader single" id="uploader0-imagejavascript5bgbig" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list"></div>
				<div class="fa__file-edit-wrap">
					<h2 class="catalog__section-header-text" data-load="Загрузка" data-edit="Редактирование">Загрузка</h2>
					<ul class="fa__file-edit-list"></ul>
				</div>
		</div>';
}
$imagejavascript5bgbigOne .= '</fieldset>';
// Вывод одного изображения "Изображение для background(desktop 1950x1100)" КОНЕЦ



// Вывод одного изображения "Изображение для background(mobile 640x1171)" НАЧАЛО
$imagejavascriptbgsmallOne = '<fieldset class="catalog__section">'.
$this->createHeader('Изображение для background(mobile 640x1171)');
if ($pagesItem['imagejavascriptbgsmall'] <> '') {
	$imagejavascriptbgsmallOne .= '<div class="fa__uploader single" id="uploader0-imagejavascriptbgsmall" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">
					<div class="fa__file">
						<a href="/frontend/web/p/pages/smalljavascriptbg-'.$pagesItem['imagejavascriptbgsmall'].'" title="'.$pagesItem['imagejavascriptbgsmallTitle'].'" class="cboxElement" rel="uploader0">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/frontend/web/p/pages/smalljavascriptbg-'.$pagesItem['imagejavascriptbgsmall'].'" width="100%" height="auto" alt="'.$pagesItem['imagejavascriptbgsmallTitle'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[imagejavascriptbgsmall-one][imgTitle]" value="'.$this->getCodeStr($pagesItem['imagejavascriptbgsmallTitle']).'">
								<input class="item-deleted" type="hidden" name="images[imagejavascriptbgsmall-one][deleted]" value="0">
							</span>
							<span class="fa__file-title">'.$pagesItem['imagejavascriptbgsmallTitle'].'</span>
						</a>
						<input class="button button_small button_edit" type="button" title="Редактировать" value="Редактировать">
						<input class="button button_small button_delete" type="button" title="Удалить" value="Удалить">
					</div>
				</div>
				<div class="fa__file-edit-wrap">
					<h2 class="catalog__section-header-text" data-load="Загрузка" data-edit="Редактирование">Загрузка</h2>
					<ul class="fa__file-edit-list"></ul>
				</div>
		</div>';
} else {
	$imagejavascriptbgsmallOne .= '<div class="fa__uploader single" id="uploader0-imagejavascriptbgsmall" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list"></div>
				<div class="fa__file-edit-wrap">
					<h2 class="catalog__section-header-text" data-load="Загрузка" data-edit="Редактирование">Загрузка</h2>
					<ul class="fa__file-edit-list"></ul>
				</div>
		</div>';
}
$imagejavascriptbgsmallOne .= '</fieldset>';
// Вывод одного изображения "Изображение для background(mobile 640x1171)" КОНЕЦ



// Группа чекбоксов "Выбор ссылок отображаемых в футере"
$linksList = [];
foreach ($links as $key => $item) {
	$checked = '';
	
	if (in_array($item['id'], $linksIds)) {
		$checked = 'checked="checked"';
	}
	
	$linksList[] = ['id'=> 'links'.$key, 'text' => $item['title'], 'width' => 400, 'name' => 'linksIds[]', 'value' => $item['id'], 'attr' => $checked];
}



// Группа чекбоксов "Выбор работ отображаемых на странице"
$worksfrontoutList = [];
foreach ($worksfrontout as $key => $item) {
	$checked = '';
	
	if (in_array($item['id'], $worksfrontoutIds)) {
		$checked = 'checked="checked"';
	}
	
	$worksfrontoutList[] = ['id'=> 'worksfrontout'.$key, 'text' => $item['pH1'], 'width' => 400, 'name' => 'worksfrontoutIds[]', 'value' => $item['id'], 'attr' => $checked];
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
                '.$this->createHeader('Главный экран').'
                <!-- javascriptmainscreentitle -->'.$this->createTextArea(['id'=> 'javascriptmainscreentitle', 'text' => 'Title main', 'width' => '400x100', 'name' => 'content[javascriptmainscreentitle]', 'value' => $pagesItem['javascriptmainscreentitle'], 'attr' => '']).'<!-- /javascriptmainscreentitle -->
		<!-- javascriptmainscreentitle1 -->'.$this->createTextArea(['id'=> 'javascriptmainscreentitle1', 'text' => 'Title medium 1', 'width' => '400x100', 'name' => 'content[javascriptmainscreentitle1]', 'value' => $pagesItem['javascriptmainscreentitle1'], 'attr' => '']).'<!-- /javascriptmainscreentitle1 -->
		<!-- javascriptmainscreentitle2 -->'.$this->createTextArea(['id'=> 'javascriptmainscreentitle2', 'text' => 'Title medium 2', 'width' => '400x100', 'name' => 'content[javascriptmainscreentitle2]', 'value' => $pagesItem['javascriptmainscreentitle2'], 'attr' => '']).'<!-- /javascriptmainscreentitle2 -->
		<!-- javascriptmainscreentitle3 -->'.$this->createTextArea(['id'=> 'javascriptmainscreentitle3', 'text' => 'Title medium 3', 'width' => '400x100', 'name' => 'content[javascriptmainscreentitle3]', 'value' => $pagesItem['javascriptmainscreentitle3'], 'attr' => '']).'<!-- /javascriptmainscreentitle3 -->
		<!-- imagejavascript5bgbig -->'.$imagejavascript5bgbigOne.'<!-- /imagejavascript5bgbig -->
		<!-- imagejavascriptbgsmall -->'.$imagejavascriptbgsmallOne.'<!-- /imagejavascriptbgsmall -->

<!-- worksexamplesjavascript --><fieldset class="catalog__section">
	'.$this->createHeader('Примеры работ').'
	<div class="catalog__section-data">
		<!-- worksexamplesjavascripttitle -->'.$this->createInput(['id'=> 'worksexamplesjavascripttitle', 'text' => 'Title', 'placeholder' => '', 'width' => 400, 'name' => 'content[worksexamplesjavascripttitle]', 'value' => $pagesItem['worksexamplesjavascripttitle'], 'attr' => '']).'<!-- /worksexamplesjavascripttitle -->
		'.$this->createHeader('Выбор работ отображаемых на странице').'
		<!-- worksfrontout -->'.$this->createCheckBoxGroup(['list' => $worksfrontoutList]).'<!-- /worksfrontout -->
		'.$this->createHeader('Выбор ссылок отображаемых в футере').'
		<!-- links -->'.$this->createCheckBoxGroup(['list' => $linksList]).'<!-- /links -->
	</div>
</fieldset><!-- /worksexamplesjavascript -->'.

            Html::endForm();