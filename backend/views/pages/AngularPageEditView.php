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



// Вывод одного изображения "Изображение для background(desktop 1950x1100)" НАЧАЛО
$imageangularbgbigOne = '<fieldset class="catalog__section">'.
$this->createHeader('Изображение для background(desktop 1920x1100)');
if ($pagesItem['imageangularbgbig'] <> '') {
	$imageangularbgbigOne .= '<div class="fa__uploader single" id="uploader0-imageangularbgbig" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">
					<div class="fa__file">
						<a href="/frontend/web/p/pages/bigangularbg-'.$pagesItem['imageangularbgbig'].'" title="'.$pagesItem['imageangularbgbigTitle'].'" class="cboxElement" rel="uploader0">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/frontend/web/p/pages/bigangularbg-'.$pagesItem['imageangularbgbig'].'" width="100%" height="auto" alt="'.$pagesItem['imageangularbgbigTitle'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[imageangularbgbig-one][imgTitle]" value="'.$this->getCodeStr($pagesItem['imageangularbgbigTitle']).'">
								<input class="item-deleted" type="hidden" name="images[imageangularbgbig-one][deleted]" value="0">
							</span>
							<span class="fa__file-title">'.$pagesItem['imageangularbgbigTitle'].'</span>
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
	$imageangularbgbigOne .= '<div class="fa__uploader single" id="uploader0-imageangularbgbig" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
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
$imageangularbgbigOne .= '</fieldset>';
// Вывод одного изображения "Изображение для background(desktop 1950x1100)" КОНЕЦ



// Вывод одного изображения "Изображение для background(mobile 640x1171)" НАЧАЛО
$imageangularbgsmallOne = '<fieldset class="catalog__section">'.
$this->createHeader('Изображение для background(mobile 640x1171)');
if ($pagesItem['imageangularbgsmall'] <> '') {
	$imageangularbgsmallOne .= '<div class="fa__uploader single" id="uploader0-imageangularbgsmall" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">
					<div class="fa__file">
						<a href="/p/pages/original-'.$pagesItem['imageangularbgsmall'].'" title="'.$pagesItem['imageangularbgsmallTitle'].'" class="cboxElement" rel="uploader0">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/frontend/web/p/pages/smallangularbg-'.$pagesItem['imageangularbgsmall'].'" width="100%" height="auto" alt="'.$pagesItem['imageangularbgsmallTitle'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[imageangularbgsmall-one][imgTitle]" value="'.$this->getCodeStr($pagesItem['imageangularbgsmallTitle']).'">
								<input class="item-deleted" type="hidden" name="images[imageangularbgsmall-one][deleted]" value="0">
							</span>
							<span class="fa__file-title">'.$pagesItem['imageangularbgsmallTitle'].'</span>
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
	$imageangularbgsmallOne .= '<div class="fa__uploader single" id="uploader0-imageangularbgsmall" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
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
$imageangularbgsmallOne .= '</fieldset>';
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



// Группа чекбоксов "Выбор ссылок отображаемых в футере"
$linksList = [];
foreach ($links as $key => $item) {
	$checked = '';
	
	if (in_array($item['id'], $linksIds)) {
		$checked = 'checked="checked"';
	}
	
	$linksList[] = ['id'=> 'links'.$key, 'text' => $item['title'], 'width' => 400, 'name' => 'linksIds[]', 'value' => $item['id'], 'attr' => $checked];
}



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
                '.$this->createHeader('Главный экран').'
                	<!-- angularmainscreentitle -->'.$this->createTextArea(['id'=> 'angularmainscreentitle', 'text' => 'Title main', 'width' => '400x100', 'name' => 'content[angularmainscreentitle]', 'value' => $pagesItem['angularmainscreentitle'], 'attr' => '']).'<!-- /angularmainscreentitle -->
		<!-- angularmainscreentitle1 -->'.$this->createTextArea(['id'=> 'angularmainscreentitle1', 'text' => 'Title medium ', 'width' => '400x100', 'name' => 'content[angularmainscreentitle1]', 'value' => $pagesItem['angularmainscreentitle1'], 'attr' => '']).'<!-- /angularmainscreentitle1 -->
		<!-- imageangularbgbig -->'.$imageangularbgbigOne.'<!-- /imageangularbgbig -->
		<!-- imageangularbgsmall -->'.$imageangularbgsmallOne.'<!-- /imageangularbgsmall -->

<!-- causesAngular --><fieldset class="catalog__section">
	'.$this->createHeader('Почему Angular').'
	<div class="catalog__section-data">
		<!-- causesAngulartitle -->'.$this->createTextArea(['id'=> 'causesAngulartitle', 'text' => 'Title', 'width' => '400x100', 'name' => 'content[causesAngulartitle]', 'value' => $pagesItem['causesAngulartitle'], 'attr' => '']).'<!-- /causesAngulartitle -->
		<!-- causesAngularlist --><div class="input-row__group-wrap">';
			for ($i = 0; $i < count($causesAngularlist); $i++) {
				if ($i == count($causesAngularlist)-1) {
					$content .= '<div class="input-row input-wrap input-row__group">
						<label class="input__label" for="' . $i . '">Пункт перечня 1-я колонка</label>
						<input placeholder="" id="' . $i . '" name="causesAngularlist[]" class="input catalog_input input-width_400" type="text" value="' . $this->getCodeStr($causesAngularlist[$i]['text']) . '" />
						<div class="button button__block button_copy-block"></div>
					</div>';
					continue;
				}
				
				$content .= '<div class="input-row input-wrap input-row__group">
					<label class="input__label" for="' . $i . '">Пункт перечня 1-я колонка</label>
					<input placeholder="" id="' . $i . '" name="causesAngularlist[]" class="input catalog_input input-width_400" type="text" value="' . $this->getCodeStr($causesAngularlist[$i]['text']) . '" />
					<div class="button button__block button_remove-block"></div>
				</div>';
			}
		$content .= '</div><!-- /causesAngularlist -->
		<!-- causesAngularlist1 --><div class="input-row__group-wrap">';
			for ($i = 0; $i < count($causesAngularlist1); $i++) {
				if ($i == count($causesAngularlist1)-1) {
					$content .= '<div class="input-row input-wrap input-row__group">
						<label class="input__label" for="' . $i . '">Пункт перечня 2-я колонка</label>
						<input placeholder="" id="' . $i . '" name="causesAngularlist1[]" class="input catalog_input input-width_400" type="text" value="' . $this->getCodeStr($causesAngularlist1[$i]['text']) . '" />
						<div class="button button__block button_copy-block"></div>
					</div>';
					continue;
				}
				
				$content .= '<div class="input-row input-wrap input-row__group">
					<label class="input__label" for="' . $i . '">Пункт перечня 2-я колонка</label>
					<input placeholder="" id="' . $i . '" name="causesAngularlist1[]" class="input catalog_input input-width_400" type="text" value="' . $this->getCodeStr($causesAngularlist1[$i]['text']) . '" />
					<div class="button button__block button_remove-block"></div>
				</div>';
			}
		$content .= '</div><!-- /causesAngularlist1 -->

<!-- worksexamplesAngular --><fieldset class="catalog__section">
	'.$this->createHeader('Примеры работ').'
	<div class="catalog__section-data">
		<!-- worksexamplesAngulartitle -->'.$this->createInput(['id'=> 'worksexamplesAngulartitle', 'text' => 'Title', 'placeholder' => '', 'width' => 400, 'name' => 'content[worksexamplesAngulartitle]', 'value' => $pagesItem['worksexamplesAngulartitle'], 'attr' => '']).'<!-- /worksexamplesAngulartitle -->
		<!-- links -->'.$this->createCheckBoxGroup(['list' => $linksList]).'<!-- /links -->

	</div>
</fieldset><!-- /worksexamplesAngular -->
	</div>
</fieldset><!-- /causesAngular -->'.
            Html::endForm();