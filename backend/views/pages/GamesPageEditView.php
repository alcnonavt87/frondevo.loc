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


// Вывод одного изображения "Изображение для background(desktop 1920x1100)" НАЧАЛО
$imagegamesbgbigOne = '<fieldset class="catalog__section">'.
$this->createHeader('Изображение для background(desktop 1920x1100)');
if ($pagesItem['imagegamesbgbig'] <> '') {
	$imagegamesbgbigOne .= '<div class="fa__uploader single" id="uploader0-imagegamesbgbig" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">
					<div class="fa__file">
						<a href="/frontend/web/p/pages/biggamesbg-'.$pagesItem['imagegamesbgbig'].'" title="'.$pagesItem['imagegamesbgbigTitle'].'" class="cboxElement" rel="uploader0">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/frontend/web/p/pages/biggamesbg-'.$pagesItem['imagegamesbgbig'].'" width="100%" height="auto" alt="'.$pagesItem['imagegamesbgbigTitle'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[imagegamesbgbig-one][imgTitle]" value="'.$this->getCodeStr($pagesItem['imagegamesbgbigTitle']).'">
								<input class="item-deleted" type="hidden" name="images[imagegamesbgbig-one][deleted]" value="0">
							</span>
							<span class="fa__file-title">'.$pagesItem['imagegamesbgbigTitle'].'</span>
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
	$imagegamesbgbigOne .= '<div class="fa__uploader single" id="uploader0-imagegamesbgbig" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
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
$imagegamesbgbigOne .= '</fieldset>';
// Вывод одного изображения "Изображение для background(desktop 1920x1100)" КОНЕЦ



// Вывод одного изображения "Изображение для background(mobile 640x1171)" НАЧАЛО
$imagegamesbgsmallOne = '<fieldset class="catalog__section">'.
$this->createHeader('Изображение для background(mobile 640x1171)');
if ($pagesItem['imagegamesbgsmall'] <> '') {
	$imagegamesbgsmallOne .= '<div class="fa__uploader single" id="uploader0-imagegamesbgsmall" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">
					<div class="fa__file">
						<a href="/frontend/web/p/pages/smallgamesbg-'.$pagesItem['imagegamesbgsmall'].'" title="'.$pagesItem['imagegamesbgsmallTitle'].'" class="cboxElement" rel="uploader0">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/frontend/web/p/pages/smallgamesbg-'.$pagesItem['imagegamesbgsmall'].'" width="100%" height="auto" alt="'.$pagesItem['imagegamesbgsmallTitle'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[imagegamesbgsmall-one][imgTitle]" value="'.$this->getCodeStr($pagesItem['imagegamesbgsmallTitle']).'">
								<input class="item-deleted" type="hidden" name="images[imagegamesbgsmall-one][deleted]" value="0">
							</span>
							<span class="fa__file-title">'.$pagesItem['imagegamesbgsmallTitle'].'</span>
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
	$imagegamesbgsmallOne .= '<div class="fa__uploader single" id="uploader0-imagegamesbgsmall" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
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
$imagegamesbgsmallOne .= '</fieldset>';
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
<!-- main screen --><fieldset class="catalog__section">
	'.$this->createHeader('Главные экран').'
	<div class="catalog__section-data">
		<!-- gamesmainscreentitle -->'.$this->createTextArea(['id'=> 'gamesmainscreentitle', 'text' => 'Title main', 'width' => '400x100', 'name' => 'content[gamesmainscreentitle]', 'value' => $pagesItem['gamesmainscreentitle'], 'attr' => '']).'<!-- /gamesmainscreentitle -->
		<!-- gamesmainscreentitle1 -->'.$this->createTextArea(['id'=> 'gamesmainscreentitle1', 'text' => 'Title medium', 'width' => '400x100', 'name' => 'content[gamesmainscreentitle1]', 'value' => $pagesItem['gamesmainscreentitle1'], 'attr' => '']).'<!-- /gamesmainscreentitle1 -->
		<!-- imagegamesbgbig -->'.$imagegamesbgbigOne.'<!-- /imagegamesbgbig -->
		<!-- imagegamesbgsmall -->'.$imagegamesbgsmallOne.'<!-- /imagegamesbgsmall -->

<!-- Our advantages --><fieldset class="catalog__section">
	'.$this->createHeader('Наши преимущества').'
	<div class="catalog__section-data">
		<!-- gamesadvtitle -->'.$this->createTextArea(['id'=> 'gamesadvtitle', 'text' => 'Title', 'width' => '400x100', 'name' => 'content[gamesadvtitle]', 'value' => $pagesItem['gamesadvtitle'], 'attr' => '']).'<!-- /gamesadvtitle -->
	</div>
</fieldset><!-- /Our advantages -->
	</div><!-- worksexamplesgames --><fieldset class="catalog__section">
	'.$this->createHeader('Примеры работ').'
	<div class="catalog__section-data">
		<!-- worksexamplesgamestitle -->'.$this->createInput(['id'=> 'worksexamplesgamestitle', 'text' => 'Title', 'placeholder' => '', 'width' => 400, 'name' => 'content[worksexamplesgamestitle]', 'value' => $pagesItem['worksexamplesgamestitle'], 'attr' => '']).'<!-- /worksexamplesgamestitle -->
		'.$this->createHeader('Выбор работ отображаемых на странице').'
		<!-- worksfrontout -->'.$this->createCheckBoxGroup(['list' => $worksfrontoutList]).'<!-- /worksfrontout -->
		'.$this->createHeader('Выбор ссылок отображаемых в футере').'
		<!-- links -->'.$this->createCheckBoxGroup(['list' => $linksList]).'<!-- /links -->

	</div>
</fieldset><!-- /worksexamplesgames -->

</fieldset><!-- /main screen -->'.
            Html::endForm();