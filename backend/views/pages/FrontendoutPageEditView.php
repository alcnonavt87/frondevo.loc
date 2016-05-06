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
$imagefrontoutbgbigOne = '<fieldset class="catalog__section">'.
$this->createHeader('Изображение для background(desktop 1950x1100)');
if ($pagesItem['imagefrontoutbgbig'] <> '') {
	$imagefrontoutbgbigOne .= '<div class="fa__uploader single" id="uploader0-imagefrontoutbgbig" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">
					<div class="fa__file">
						<a href="/frontend/web/p/pages/bigfrontoutbg-'.$pagesItem['imagefrontoutbgbig'].'" title="'.$pagesItem['imagefrontoutbgbigTitle'].'" class="cboxElement" rel="uploader0">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/frontend/web/p/pages/bigfrontoutbg-'.$pagesItem['imagefrontoutbgbig'].'" width="100%" height="auto" alt="'.$pagesItem['imagefrontoutbgbigTitle'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[imagefrontoutbgbig-one][imgTitle]" value="'.$this->getCodeStr($pagesItem['imagefrontoutbgbigTitle']).'">
								<input class="item-deleted" type="hidden" name="images[imagefrontoutbgbig-one][deleted]" value="0">
							</span>
							<span class="fa__file-title">'.$pagesItem['imagefrontoutbgbigTitle'].'</span>
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
	$imagefrontoutbgbigOne .= '<div class="fa__uploader single" id="uploader0-imagefrontoutbgbig" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
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
$imagefrontoutbgbigOne .= '</fieldset>';
// Вывод одного изображения "Изображение для background(desktop 1950x1100)" КОНЕЦ



// Вывод одного изображения "Изображение для background(mobile 640x1171)" НАЧАЛО
$imagefrontoutbgsmallOne = '<fieldset class="catalog__section">'.
$this->createHeader('Изображение для background(mobile 640x1171)');
if ($pagesItem['imagefrontoutbgsmall'] <> '') {
	$imagefrontoutbgsmallOne .= '<div class="fa__uploader single" id="uploader0-imagefrontoutbgsmall" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">
					<div class="fa__file">
						<a href="/frontend/web/p/pages/smallfrontoutbg-'.$pagesItem['imagefrontoutbgsmall'].'" title="'.$pagesItem['imagefrontoutbgsmallTitle'].'" class="cboxElement" rel="uploader0">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/frontend/web/p/pages/smallfrontoutbg-'.$pagesItem['imagefrontoutbgsmall'].'" width="100%" height="auto" alt="'.$pagesItem['imagefrontoutbgsmallTitle'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[imagefrontoutbgsmall-one][imgTitle]" value="'.$this->getCodeStr($pagesItem['imagefrontoutbgsmallTitle']).'">
								<input class="item-deleted" type="hidden" name="images[imagefrontoutbgsmall-one][deleted]" value="0">
							</span>
							<span class="fa__file-title">'.$pagesItem['imagefrontoutbgsmallTitle'].'</span>
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
	$imagefrontoutbgsmallOne .= '<div class="fa__uploader single" id="uploader0-imagefrontoutbgsmall" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
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
$imagefrontoutbgsmallOne .= '</fieldset>';
// Вывод одного изображения "Изображение для background(mobile 640x1171)" КОНЕЦ



// Вывод нескольких изображений "Лого наших клиентов" НАЧАЛО
$imagesCount = count($imageourclientslogo);
$imageourclientslogoMany = '<fieldset class="catalog__section">'.
$this->createHeader('Лого наших клиентов');
if ($imagesCount > 0) {
	$imageourclientslogoMany .= '<div class="fa__uploader" id="uploader1-imageourclientslogo" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файлы
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">';

	for ($i = 0; $i < $imagesCount; $i++) {
		$imageourclientslogoMany .= '<div class="fa__file">
						<a href="/frontend/web/p/pages/original-'.$imageourclientslogo[$i]['img'].'" title="'.$imageourclientslogo[$i]['imgTitle'].'" class="cboxElement" rel="uploader1-imageourclientslogo">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/frontend/web/p/pages/medium-'.$imageourclientslogo[$i]['img'].'" width="100%" height="auto" alt="'.$imageourclientslogo[$i]['imgTitle'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[imageourclientslogo-'.$imageourclientslogo[$i]['id'].'][imgTitle]" value="'.$this->getCodeStr($imageourclientslogo[$i]['imgTitle']).'">
								<input class="place-fld" type="hidden" name="images[imageourclientslogo-'.$imageourclientslogo[$i]['id'].'][picking]" value="'.$imageourclientslogo[$i]['order'].'">
								<input class="item-id" type="hidden" name="images[imageourclientslogo-'.$imageourclientslogo[$i]['id'].'][imgId]" value="imageourclientslogo-'.$imageourclientslogo[$i]['id'].'">
								<input class="item-deleted" type="hidden" name="images[imageourclientslogo-'.$imageourclientslogo[$i]['id'].'][deleted]" value="0">
								<input class="item-groupName" type="hidden" name="images[imageourclientslogo-'.$imageourclientslogo[$i]['id'].'][groupName]" value="uploader1-imageourclientslogo">
							</span>
							<span class="fa__file-title">'.$imageourclientslogo[$i]['imgTitle'].'</span>
						</a>
						<input class="button button_small button_edit" type="button" title="Редактировать" value="Редактировать">
						<input class="button button_small button_delete" type="button" title="Удалить" value="Удалить">
					</div>';
	}

	$imageourclientslogoMany .= '</div>
				<div class="fa__file-edit-wrap">
					<h2 class="catalog__section-header-text" data-load="Загрузка" data-edit="Редактирование">Загрузка</h2>
					<ul class="fa__file-edit-list"></ul>
				</div>
			</div>';
} else {
	$imageourclientslogoMany .= '<div class="fa__uploader" id="uploader1-imageourclientslogo" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файлы
					<input id="fileupload" type="file" name="files[]" multiple">
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
$imageourclientslogoMany .= '</fieldset>';
// Вывод нескольких изображеий "Лого наших клиентов" КОНЕЦ/* UpdateCode */

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
		<!-- titlefrontout -->'.$this->createTextArea(['id'=> 'titlefrontout', 'text' => 'Title', 'width' => '400x100', 'name' => 'content[titlefrontout]', 'value' => $pagesItem['titlefrontout'], 'attr' => '']).'<!-- /titlefrontout -->
		<!-- titlemiddlefrontout -->'.$this->createTextArea(['id'=> 'titlemiddlefrontout', 'text' => 'Title small 1', 'width' => '400x100', 'name' => 'content[titlemiddlefrontout]', 'value' => $pagesItem['titlemiddlefrontout'], 'attr' => '']).'<!-- /titlemiddlefrontout -->
		<!-- titlesmallfrontout -->'.$this->createTextArea(['id'=> 'titlesmallfrontout', 'text' => 'Title small 2', 'width' => '400x100', 'name' => 'content[titlesmallfrontout]', 'value' => $pagesItem['titlesmallfrontout'], 'attr' => '']).'<!-- /titlesmallfrontout -->
		<!-- titlesmallfrontout2 -->'.$this->createTextArea(['id'=> 'titlesmallfrontout2', 'text' => 'Title small 3', 'width' => '400x100', 'name' => 'content[titlesmallfrontout2]', 'value' => $pagesItem['titlesmallfrontout2'], 'attr' => '']).'<!-- /titlesmallfrontout2 -->
		<!-- imagefrontoutbgbig -->'.$imagefrontoutbgbigOne.'<!-- /imagefrontoutbgbig -->
		<!-- imagefrontoutbgsmall -->'.$imagefrontoutbgsmallOne.'<!-- /imagefrontoutbgsmall -->

<!-- dataofTeam --><fieldset class="catalog__section">
	'.$this->createHeader('Данные о команде').'
	<div class="catalog__section-data">

		<!-- frndoutsect2title -->'.$this->createInput(['id'=> 'frndoutsect2title', 'text' => 'title', 'width' => '400', 'name' => 'content[frndoutsect2title]', 'value' => $pagesItem['frndoutsect2title'], 'attr' => '']).'<!-- /frndoutsect2title -->
		<!-- frndoutsect2data -->'.$this->createTextArea(['id'=> 'frndoutsect2data', 'text' => 'Данные о команде', 'width' => '800x500', 'name' => 'content[frndoutsect2data]', 'value' => $pagesItem['frndoutsect2data'], 'attr' => '']).'<!-- /frndoutsect2data -->
	</div>
</fieldset><!-- /dataofTeam -->
<!-- ourclients --><fieldset class="catalog__section">
	'.$this->createHeader('Наши клиенты').'
	<div class="catalog__section-data">
		<!-- frndoutsect3title -->'.$this->createTextArea(['id'=> 'frndoutsect3title', 'text' => 'title', 'width' => '400x100', 'name' => 'content[frndoutsect3title]', 'value' => $pagesItem['frndoutsect3title'], 'attr' => '']).'<!-- /frndoutsect3title -->
		<!-- ourclientslist --><div class="input-row__group-wrap">';
			for ($i = 0; $i < count($ourclientslist); $i++) {
				if ($i == count($ourclientslist)-1) {
					$content .= '<div class="input-row input-wrap input-row__group">
						<label class="input__label" for="' . $i . '">Виды клиетов</label>
						<input placeholder="" id="' . $i . '" name="ourclientslist[]" class="input catalog_input input-width_400" type="text" value="' . $this->getCodeStr($ourclientslist[$i]['text']) . '" />
						<div class="button button__block button_copy-block"></div>
					</div>';
					continue;
				}
				
				$content .= '<div class="input-row input-wrap input-row__group">
					<label class="input__label" for="' . $i . '">Виды клиентов</label>
					<input placeholder="" id="' . $i . '" name="ourclientslist[]" class="input catalog_input input-width_400" type="text" value="' . $this->getCodeStr($ourclientslist[$i]['text']) . '" />
					<div class="button button__block button_remove-block"></div>
				</div>';
			}
		$content .= '</div><!-- /ourclientslist -->
		<!-- imageourclientslogo -->'.$imageourclientslogoMany.'<!-- /imageourclientslogo -->
	</div>
</fieldset><!-- /ourclients -->


                </fieldset><!-- /sectionPageData --><!-- /createFinish -->'.
            Html::endForm();