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
$imagepsd2html5bgbigOne = '<fieldset class="catalog__section">'.
$this->createHeader('Изображение для background(desktop 1920x1100)');
if ($pagesItem['imagepsd2html5bgbig'] <> '') {
	$imagepsd2html5bgbigOne .= '<div class="fa__uploader single" id="uploader0-imagepsd2html5bgbig" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">
					<div class="fa__file">
						<a href="/frontend/web/p/pages/bigpsd2html5bg-'.$pagesItem['imagepsd2html5bgbig'].'" title="'.$pagesItem['imagepsd2html5bgbigTitle'].'" class="cboxElement" rel="uploader0">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/frontend/web/p/pages/bigpsd2html5bg-'.$pagesItem['imagepsd2html5bgbig'].'" width="100%" height="auto" alt="'.$pagesItem['imagepsd2html5bgbigTitle'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[imagepsd2html5bgbig-one][imgTitle]" value="'.$this->getCodeStr($pagesItem['imagepsd2html5bgbigTitle']).'">
								<input class="item-deleted" type="hidden" name="images[imagepsd2html5bgbig-one][deleted]" value="0">
							</span>
							<span class="fa__file-title">'.$pagesItem['imagepsd2html5bgbigTitle'].'</span>
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
	$imagepsd2html5bgbigOne .= '<div class="fa__uploader single" id="uploader0-imagepsd2html5bgbig" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
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
$imagepsd2html5bgbigOne .= '</fieldset>';
// Вывод одного изображения "Изображение для background(desktop 1950x1100)" КОНЕЦ



// Вывод одного изображения "Изображение для background(mobile 640x1171)" НАЧАЛО
$imagepsd2html5bgsmallOne = '<fieldset class="catalog__section">'.
$this->createHeader('Изображение для background(mobile 640x1171)');
if ($pagesItem['imagepsd2html5bgsmall'] <> '') {
	$imagepsd2html5bgsmallOne .= '<div class="fa__uploader single" id="uploader0-imagepsd2html5bgsmall" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">
					<div class="fa__file">
						<a href="/frontend/web/p/pages/smallpsd2html5bg-'.$pagesItem['imagepsd2html5bgsmall'].'" title="'.$pagesItem['imagepsd2html5bgsmallTitle'].'" class="cboxElement" rel="uploader0">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/frontend/web/p/pages/smallpsd2html5bg-'.$pagesItem['imagepsd2html5bgsmall'].'" width="100%" height="auto" alt="'.$pagesItem['imagepsd2html5bgsmallTitle'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[imagepsd2html5bgsmall-one][imgTitle]" value="'.$this->getCodeStr($pagesItem['imagepsd2html5bgsmallTitle']).'">
								<input class="item-deleted" type="hidden" name="images[imagepsd2html5bgsmall-one][deleted]" value="0">
							</span>
							<span class="fa__file-title">'.$pagesItem['imagepsd2html5bgsmallTitle'].'</span>
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
	$imagepsd2html5bgsmallOne .= '<div class="fa__uploader single" id="uploader0-imagepsd2html5bgsmall" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
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
$imagepsd2html5bgsmallOne .= '</fieldset>';
// Вывод одного изображения "Изображение для background(mobile 640x1171)" КОНЕЦ



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
          	<!-- psd2html5mainscreebtitle -->'.$this->createTextArea(['id'=> 'psd2html5mainscreebtitle', 'text' => 'Title main', 'width' => '400x100', 'name' => 'content[psd2html5mainscreebtitle]', 'value' => $pagesItem['psd2html5mainscreebtitle'], 'attr' => '']).'<!-- /psd2html5mainscreebtitle -->
		<!-- psd2html5mainscreebtitle1 -->'.$this->createTextArea(['id'=> 'psd2html5mainscreebtitle1', 'text' => 'Title medium 1', 'width' => '400x100', 'name' => 'content[psd2html5mainscreebtitle1]', 'value' => $pagesItem['psd2html5mainscreebtitle1'], 'attr' => '']).'<!-- /psd2html5mainscreebtitle1 -->
		<!-- psd2html5mainscreebtitle2 -->'.$this->createTextArea(['id'=> 'psd2html5mainscreebtitle2', 'text' => 'Title medium 2', 'width' => '400x100', 'name' => 'content[psd2html5mainscreebtitle2]', 'value' => $pagesItem['psd2html5mainscreebtitle2'], 'attr' => '']).'<!-- /psd2html5mainscreebtitle2 -->
		<!-- psd2html5mainscreebtitle3 -->'.$this->createTextArea(['id'=> 'psd2html5mainscreebtitle3', 'text' => 'Title medium 3', 'width' => '400x100', 'name' => 'content[psd2html5mainscreebtitle3]', 'value' => $pagesItem['psd2html5mainscreebtitle3'], 'attr' => '']).'<!-- /psd2html5mainscreebtitle3 -->
		<!-- psd2html5mainscreebtitle4 -->'.$this->createInput(['id'=> 'psd2html5mainscreebtitle4', 'text' => 'Title small 1', 'placeholder' => '', 'width' => 400, 'name' => 'content[psd2html5mainscreebtitle4]', 'value' => $pagesItem['psd2html5mainscreebtitle4'], 'attr' => '']).'<!-- /psd2html5mainscreebtitle4 -->
		<!-- psd2html5mainscreebtitle5 -->'.$this->createInput(['id'=> 'psd2html5mainscreebtitle5', 'text' => 'Title small 2', 'placeholder' => '', 'width' => 400, 'name' => 'content[psd2html5mainscreebtitle5]', 'value' => $pagesItem['psd2html5mainscreebtitle5'], 'attr' => '']).'<!-- /psd2html5mainscreebtitle5 -->
		<!-- psd2html5mainscreebtitle6 -->'.$this->createInput(['id'=> 'psd2html5mainscreebtitle6', 'text' => 'Title small 3', 'placeholder' => '', 'width' => 400, 'name' => 'content[psd2html5mainscreebtitle6]', 'value' => $pagesItem['psd2html5mainscreebtitle6'], 'attr' => '']).'<!-- /psd2html5mainscreebtitle6 -->
		<!-- psd2html5mainscreebtitle7 -->'.$this->createInput(['id'=> 'psd2html5mainscreebtitle7', 'text' => 'Title small 4', 'placeholder' => '', 'width' => 400, 'name' => 'content[psd2html5mainscreebtitle7]', 'value' => $pagesItem['psd2html5mainscreebtitle7'], 'attr' => '']).'<!-- /psd2html5mainscreebtitle7 -->
		<!-- imagepsd2html5bgbig -->'.$imagepsd2html5bgbigOne.'<!-- /imagepsd2html5bgbig -->
		<!-- imagepsd2html5bgsmall -->'.$imagepsd2html5bgsmallOne.'<!-- /imagepsd2html5bgsmall -->

<!-- worksexamplespsd2html5 --><fieldset class="catalog__section">
	'.$this->createHeader('Примеры работ').'
	<div class="catalog__section-data">
		<!-- worksexamplespsd2html5title -->'.$this->createInput(['id'=> 'worksexamplespsd2html5title', 'text' => 'Title', 'placeholder' => '', 'width' => 400, 'name' => 'content[worksexamplespsd2html5title]', 'value' => $pagesItem['worksexamplespsd2html5title'], 'attr' => '']).'<!-- /worksexamplespsd2html5title -->
		'.$this->createHeader('Выбор ссылок отображаемых в футере').'
		<!-- links -->'.$this->createCheckBoxGroup(['list' => $linksList]).'<!-- /links -->
	</div>
</fieldset><!-- /worksexamplespsd2html5 -->'.

            Html::endForm();