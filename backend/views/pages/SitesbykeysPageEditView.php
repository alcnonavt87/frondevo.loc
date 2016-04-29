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
	
	$worksList[] = ['id'=> 'works'.$key, 'text' => $item['pTitle'], 'width' => 400, 'name' => 'worksIds[]', 'value' => $item['id'], 'attr' => $checked];
}



// Вывод одного изображения "Изображение для background" НАЧАЛО
$imagebgsbkOne = '<fieldset class="catalog__section">'.
$this->createHeader('Изображение для background(desktop 1950x1100)');
if ($pagesItem['imagebgsbk'] <> '') {
	$imagebgsbkOne .= '<div class="fa__uploader single" id="uploader0-imagebgsbk" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">
					<div class="fa__file">
						<a href="/p/pages/original-'.$pagesItem['imagebgsbk'].'" title="'.$pagesItem['imagebgsbkTitle'].'" class="cboxElement" rel="uploader0">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/frontend/web/p/pages/generalbgsbk-'.$pagesItem['imagebgsbk'].'" width="100%" height="auto" alt="'.$pagesItem['imagebgsbkTitle'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[imagebgsbk-one][imgTitle]" value="'.$this->getCodeStr($pagesItem['imagebgsbkTitle']).'">
								<input class="item-deleted" type="hidden" name="images[imagebgsbk-one][deleted]" value="0">
							</span>
							<span class="fa__file-title">'.$pagesItem['imagebgsbkTitle'].'</span>
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
	$imagebgsbkOne .= '<div class="fa__uploader single" id="uploader0-imagebgsbk" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
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
$imagebgsbkOne .= '</fieldset>';
// Вывод одного изображения "Изображение для background" КОНЕЦ



// Вывод одного изображения "Изображение для background(laptop 1487x736)" НАЧАЛО
$imagebgsbklpOne = '<fieldset class="catalog__section">'.
$this->createHeader('Изображение для background(laptop 1487x736)');
if ($pagesItem['imagebgsbklp'] <> '') {
	$imagebgsbklpOne .= '<div class="fa__uploader single" id="uploader0-imagebgsbklp" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">
					<div class="fa__file">
						<a href="/p/pages/original-'.$pagesItem['imagebgsbklp'].'" title="'.$pagesItem['imagebgsbklpTitle'].'" class="cboxElement" rel="uploader0">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/frontend/web/p/pages/mediumbgsbk-'.$pagesItem['imagebgsbklp'].'" width="100%" height="auto" alt="'.$pagesItem['imagebgsbklpTitle'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[imagebgsbklp-one][imgTitle]" value="'.$this->getCodeStr($pagesItem['imagebgsbklpTitle']).'">
								<input class="item-deleted" type="hidden" name="images[imagebgsbklp-one][deleted]" value="0">
							</span>
							<span class="fa__file-title">'.$pagesItem['imagebgsbklpTitle'].'</span>
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
	$imagebgsbklpOne .= '<div class="fa__uploader single" id="uploader0-imagebgsbklp" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
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
$imagebgsbklpOne .= '</fieldset>';
// Вывод одного изображения "Изображение для background(laptop 1487x736)" КОНЕЦ



// Селект "Работа 1"
$works1Options = '<option value="0">Выберите вариант</option>';
foreach ($works as $item) {
	if ($item['id'] == $worksItem1[1]['idWorks1']) {
		$works1Options .= '<option value="'.$item['id'].'"  selected>'.$item['pTitle'].'</option>';
		continue;
	}

	$works1Options .= '<option value="'.$item['id'].'" >'.$item['pTitle'].'</option>';
}
// Селект "Работа 2"
$works2Options = '<option value="0">Выберите вариант</option>';
foreach ($works as $item) {
	if ($item['id'] == $worksItem2[1]['idWorks2']) {
		$works2Options .= '<option value="'.$item['id'].'"  selected>'.$item['pTitle'].'</option>';
		continue;
	}

	$works2Options .= '<option value="'.$item['id'].'" >'.$item['pTitle'].'</option>';
}
// Селект "Работа 3"
$works3Options = '<option value="0">Выберите вариант</option>';
foreach ($works as $item) {
	if ($item['id'] == $worksItem3[1]['idWorks3']) {
		$works3Options .= '<option value="'.$item['id'].'"  selected>'.$item['pTitle'].'</option>';
		continue;
	}

	$works3Options .= '<option value="'.$item['id'].'" >'.$item['pTitle'].'</option>';
}
// Селект "Работа 4"
$works4Options = '<option value="0">Выберите вариант</option>';
foreach ($works as $item) {
	if ($item['id'] == $worksItem4[1]['idWorks4']) {
		$works4Options .= '<option value="'.$item['id'].'"  selected>'.$item['pTitle'].'</option>';
		continue;
	}

	$works4Options .= '<option value="'.$item['id'].'" >'.$item['pTitle'].'</option>';
}
// Селект "Работа 5"
$works5Options = '<option value="0">Выберите вариант</option>';
foreach ($works as $item) {
	if ($item['id'] == $worksItem5[1]['idWorks5']) {
		$works5Options .= '<option value="'.$item['id'].'"  selected>'.$item['pTitle'].'</option>';
		continue;
	}

	$works5Options .= '<option value="'.$item['id'].'" >'.$item['pTitle'].'</option>';
}
// Селект "Работа 6"
$works6Options = '<option value="0">Выберите вариант</option>';
foreach ($works as $item) {
	if ($item['id'] == $worksItem6[1]['idWorks6']) {
		$works6Options .= '<option value="'.$item['id'].'"  selected>'.$item['pTitle'].'</option>';
		continue;
	}

	$works6Options .= '<option value="'.$item['id'].'" >'.$item['pTitle'].'</option>';
}
// Селект "Работа 7"
$works7Options = '<option value="0">Выберите вариант</option>';
foreach ($works as $item) {
	if ($item['id'] == $worksItem7[1]['idWorks7']) {
		$works7Options .= '<option value="'.$item['id'].'"  selected>'.$item['pTitle'].'</option>';
		continue;
	}

	$works7Options .= '<option value="'.$item['id'].'" >'.$item['pTitle'].'</option>';
}
// Вывод одного изображения "Изображение для background(mobile 970x480)" НАЧАЛО
$imagebgsbkmbOne = '<fieldset class="catalog__section">'.
$this->createHeader('Изображение для background(mobile 640x1171)');
if ($pagesItem['imagebgsbkmb'] <> '') {
	$imagebgsbkmbOne .= '<div class="fa__uploader single" id="uploader0-imagebgsbkmb" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">
					<div class="fa__file">
						<a href="/p/pages/smallbgsbk-'.$pagesItem['imagebgsbkmb'].'" title="'.$pagesItem['imagebgsbkmbTitle'].'" class="cboxElement" rel="uploader0">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/frontend/web/p/pages/smallbgsbk-'.$pagesItem['imagebgsbkmb'].'" width="100%" height="auto" alt="'.$pagesItem['imagebgsbkmbTitle'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[imagebgsbkmb-one][imgTitle]" value="'.$this->getCodeStr($pagesItem['imagebgsbkmbTitle']).'">
								<input class="item-deleted" type="hidden" name="images[imagebgsbkmb-one][deleted]" value="0">
							</span>
							<span class="fa__file-title">'.$pagesItem['imagebgsbkmbTitle'].'</span>
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
	$imagebgsbkmbOne .= '<div class="fa__uploader single" id="uploader0-imagebgsbkmb" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
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
$imagebgsbkmbOne .= '</fieldset>';
// Вывод одного изображения "Изображение для background(mobile 970x480)" КОНЕЦ



// Группа чекбоксов "Отображаемые работы"
$linksList = [];
foreach ($links as $key => $item) {
	$checked = '';
	
	if (in_array($item['id'], $linksIds)) {
		$checked = 'checked="checked"';
	}
	
	$linksList[] = ['id'=> 'links'.$key, 'text' => $item['title'], 'width' => 400, 'name' => 'linksIds[]', 'value' => $item['id'], 'attr' => $checked];
}



// Вывод одного изображения "Изображение для работы №1" НАЧАЛО
$sbkimgwork1One = '<fieldset class="catalog__section">'.
$this->createHeader('Изображение для работы №1(940x275)');
if ($pagesItem['sbkimgwork1'] <> '') {
	$sbkimgwork1One .= '<div class="fa__uploader single" id="uploader0-sbkimgwork1" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">
					<div class="fa__file">
						<a href="/frontend/web/p/pages/mediumsbk-'.$pagesItem['sbkimgwork1'].'" title="'.$pagesItem['sbkimgwork1Title'].'" class="cboxElement" rel="uploader0">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/frontend/web/p/pages/mediumsbk-'.$pagesItem['sbkimgwork1'].'" width="100%" height="auto" alt="'.$pagesItem['sbkimgwork1Title'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[sbkimgwork1-one][imgTitle]" value="'.$this->getCodeStr($pagesItem['sbkimgwork1Title']).'">
								<input class="item-deleted" type="hidden" name="images[sbkimgwork1-one][deleted]" value="0">
							</span>
							<span class="fa__file-title">'.$pagesItem['sbkimgwork1Title'].'</span>
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
	$sbkimgwork1One .= '<div class="fa__uploader single" id="uploader0-sbkimgwork1" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
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
$sbkimgwork1One .= '</fieldset>';
// Вывод одного изображения "Изображение для работы №1" КОНЕЦ




// Вывод одного изображения "Изображение для работы №2" НАЧАЛО
$sbkimgwork2One = '<fieldset class="catalog__section">'.
$this->createHeader('Изображение для работы №2(461x275)');
if ($pagesItem['sbkimgwork2'] <> '') {
	$sbkimgwork2One .= '<div class="fa__uploader single" id="uploader0-sbkimgwork2" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">
					<div class="fa__file">
						<a href="/frontend/web/p/pages/mediumsbk-'.$pagesItem['sbkimgwork2'].'" title="'.$pagesItem['sbkimgwork2Title'].'" class="cboxElement" rel="uploader0">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/frontend/web/p/pages/mediumsbk-'.$pagesItem['sbkimgwork2'].'" width="100%" height="auto" alt="'.$pagesItem['sbkimgwork2Title'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[sbkimgwork2-one][imgTitle]" value="'.$this->getCodeStr($pagesItem['sbkimgwork2Title']).'">
								<input class="item-deleted" type="hidden" name="images[sbkimgwork2-one][deleted]" value="0">
							</span>
							<span class="fa__file-title">'.$pagesItem['sbkimgwork2Title'].'</span>
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
	$sbkimgwork2One .= '<div class="fa__uploader single" id="uploader0-sbkimgwork2" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
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
$sbkimgwork2One .= '</fieldset>';
// Вывод одного изображения "Изображение для работы №2" КОНЕЦ



// Вывод одного изображения "Изображение для работы №3" НАЧАЛО
$sbkimgwork3One = '<fieldset class="catalog__section">'.
$this->createHeader('Изображение для работы №3(461x275)');
if ($pagesItem['sbkimgwork3'] <> '') {
	$sbkimgwork3One .= '<div class="fa__uploader single" id="uploader0-sbkimgwork3" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">
					<div class="fa__file">
						<a href="/frontend/web/p/pages/mediumsbk-'.$pagesItem['sbkimgwork3'].'" title="'.$pagesItem['sbkimgwork3Title'].'" class="cboxElement" rel="uploader0">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/frontend/web/p/pages/mediumsbk-'.$pagesItem['sbkimgwork3'].'" width="100%" height="auto" alt="'.$pagesItem['sbkimgwork3Title'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[sbkimgwork3-one][imgTitle]" value="'.$this->getCodeStr($pagesItem['sbkimgwork3Title']).'">
								<input class="item-deleted" type="hidden" name="images[sbkimgwork3-one][deleted]" value="0">
							</span>
							<span class="fa__file-title">'.$pagesItem['sbkimgwork3Title'].'</span>
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
	$sbkimgwork3One .= '<div class="fa__uploader single" id="uploader0-sbkimgwork3" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
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
$sbkimgwork3One .= '</fieldset>';
// Вывод одного изображения "Изображение для работы №3" КОНЕЦ



// Вывод одного изображения "Изображение для работы №4" НАЧАЛО
$sbkimgwork4One = '<fieldset class="catalog__section">'.
$this->createHeader('Изображение для работы №4(461x275)');
if ($pagesItem['sbkimgwork4'] <> '') {
	$sbkimgwork4One .= '<div class="fa__uploader single" id="uploader0-sbkimgwork4" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">
					<div class="fa__file">
						<a href="/frontend/web/p/pages/mediumsbk-'.$pagesItem['sbkimgwork4'].'" title="'.$pagesItem['sbkimgwork4Title'].'" class="cboxElement" rel="uploader0">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/frontend/web/p/pages/mediumsbk-'.$pagesItem['sbkimgwork4'].'" width="100%" height="auto" alt="'.$pagesItem['sbkimgwork4Title'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[sbkimgwork4-one][imgTitle]" value="'.$this->getCodeStr($pagesItem['sbkimgwork4Title']).'">
								<input class="item-deleted" type="hidden" name="images[sbkimgwork4-one][deleted]" value="0">
							</span>
							<span class="fa__file-title">'.$pagesItem['sbkimgwork4Title'].'</span>
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
	$sbkimgwork4One .= '<div class="fa__uploader single" id="uploader0-sbkimgwork4" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
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
$sbkimgwork4One .= '</fieldset>';
// Вывод одного изображения "Изображение для работы №4" КОНЕЦ



// Вывод одного изображения "Изображение для работы №5" НАЧАЛО
$sbkimgwork5One = '<fieldset class="catalog__section">'.
$this->createHeader('Изображение для работы №5(461x275)');
if ($pagesItem['sbkimgwork5'] <> '') {
	$sbkimgwork5One .= '<div class="fa__uploader single" id="uploader0-sbkimgwork5" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">
					<div class="fa__file">
						<a href="/frontend/web/p/pages/mediumsbk-'.$pagesItem['sbkimgwork5'].'" title="'.$pagesItem['sbkimgwork5Title'].'" class="cboxElement" rel="uploader0">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/frontend/web/p/pages/mediumsbk-'.$pagesItem['sbkimgwork5'].'" width="100%" height="auto" alt="'.$pagesItem['sbkimgwork5Title'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[sbkimgwork5-one][imgTitle]" value="'.$this->getCodeStr($pagesItem['sbkimgwork5Title']).'">
								<input class="item-deleted" type="hidden" name="images[sbkimgwork5-one][deleted]" value="0">
							</span>
							<span class="fa__file-title">'.$pagesItem['sbkimgwork5Title'].'</span>
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
	$sbkimgwork5One .= '<div class="fa__uploader single" id="uploader0-sbkimgwork5" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
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
$sbkimgwork5One .= '</fieldset>';
// Вывод одного изображения "Изображение для работы №5" КОНЕЦ



// Вывод одного изображения "Изображение для работы №6" НАЧАЛО
$sbkimgwork6One = '<fieldset class="catalog__section">'.
$this->createHeader('Изображение для работы №6(461x275)');
if ($pagesItem['sbkimgwork6'] <> '') {
	$sbkimgwork6One .= '<div class="fa__uploader single" id="uploader0-sbkimgwork6" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">
					<div class="fa__file">
						<a href="/frontend/web/p/pages/mediumsbk-'.$pagesItem['sbkimgwork6'].'" title="'.$pagesItem['sbkimgwork6Title'].'" class="cboxElement" rel="uploader0">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/frontend/web/p/pages/mediumsbk-'.$pagesItem['sbkimgwork6'].'" width="100%" height="auto" alt="'.$pagesItem['sbkimgwork6Title'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[sbkimgwork6-one][imgTitle]" value="'.$this->getCodeStr($pagesItem['sbkimgwork6Title']).'">
								<input class="item-deleted" type="hidden" name="images[sbkimgwork6-one][deleted]" value="0">
							</span>
							<span class="fa__file-title">'.$pagesItem['sbkimgwork6Title'].'</span>
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
	$sbkimgwork6One .= '<div class="fa__uploader single" id="uploader0-sbkimgwork6" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
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
$sbkimgwork6One .= '</fieldset>';
// Вывод одного изображения "Изображение для работы №6" КОНЕЦ



// Вывод одного изображения "Изображение для работы №7" НАЧАЛО
$sbkimgwork7One = '<fieldset class="catalog__section">'.
$this->createHeader('Изображение для работы №7(461x275)');
if ($pagesItem['sbkimgwork7'] <> '') {
	$sbkimgwork7One .= '<div class="fa__uploader single" id="uploader0-sbkimgwork7" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">
					<div class="fa__file">
						<a href="/frontend/web/p/pages/mediumsbk-'.$pagesItem['sbkimgwork7'].'" title="'.$pagesItem['sbkimgwork7Title'].'" class="cboxElement" rel="uploader0">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/frontend/web/p/pages/mediumsbk-'.$pagesItem['sbkimgwork7'].'" width="100%" height="auto" alt="'.$pagesItem['sbkimgwork7Title'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[sbkimgwork7-one][imgTitle]" value="'.$this->getCodeStr($pagesItem['sbkimgwork7Title']).'">
								<input class="item-deleted" type="hidden" name="images[sbkimgwork7-one][deleted]" value="0">
							</span>
							<span class="fa__file-title">'.$pagesItem['sbkimgwork7Title'].'</span>
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
	$sbkimgwork7One .= '<div class="fa__uploader single" id="uploader0-sbkimgwork7" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'/'.$idPage.'">
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
$sbkimgwork7One .= '</fieldset>';
// Вывод одного изображения "Изображение для работы №7" КОНЕЦ/* UpdateCode */


$content .= Html::beginForm($admPanelUri.'formupdate/'.$id1Uri.'/'.$page[0]['id'].'/'.$pageLang, 'post', ['id'=>"form-edit-content"]).
                '<!-- sectionPageData --><fieldset class="catalog__section">
                '.$this->createHeader('Основные данные страницы').'
                    <div class="catalog__section-data">
                    <!-- pH1 -->'.$this->createInput(['id'=> 'pH1', 'text' => 'Заголовок страницы H1', 'width' => 400, 'name' => 'pH1', 'value' => $page[0]['pH1'], 'attr' => 'required autofocus autocomplete="off"']).'<!-- /pH1 -->
					<!-- pTitle -->'.$this->createInput(['id'=> 'pTitle', 'text' => 'Заголовок страницы', 'placeholder' => 'В поисковой выдаче видно 60 символов', 'width' => 400, 'name' => 'pTitle', 'value' => $page[0]['pTitle'], 'attr' => 'required data-count="60"', 'dataCopy' => 'pH1', 'titleCopy' => 'Копия заголовка H1']).'<!-- /pTitle -->
                    <!-- pUrl -->'.$this->createInput(['id' => 'pUrl', 'text' => 'Алиас страницы', 'width' => 400, 'name' => 'content[pUrl]', 'value' => $page[0]['pUrl'], 'attr' => 'required', 'genUrl' => 'pH1', 'titleUrl' => 'Генерация с заголовка H1']).'<!-- /pUrl -->
					<!-- pDescription -->'.$this->createTextArea(['id'=> 'pDescription', 'text' => 'Meta description', 'placeholder' => 'В поисковой выдаче видно 140 символов', 'width' => '400x100', 'name' => 'pDescription', 'value' => $page[0]['pDescription'], 'attr' => 'data-count="140"']).'<!-- /pDescription -->
					<!-- pMenuName -->'.$this->createInput(['id'=> 'pMenuName', 'text' => 'Заголовок для главного меню', 'width' => 400, 'name' => 'pMenuName', 'value' => $page[0]['pMenuName'], 'attr' => 'required']).'<!-- /pMenuName -->
                    </div>
                </fieldset>

                <fieldset class="catalog__section">
                '.$this->createHeader('Главный экран').'
                <!-- pContent -->'.$this->createTextArea(['id'=> 'pContent', 'text' => 'Title ', 'width' => '800x500', 'name' => 'pContent', 'value' => $page[0]['pContent'], 'attr' => '']).'<!-- /pContent -->
		<!-- sbkdescription -->'.$this->createTextArea(['id'=> 'sbkdescription', 'text' => 'Title small ', 'width' => '400x100', 'name' => 'content[sbkdescription]', 'value' => $pagesItem['sbkdescription'], 'attr' => '']).'<!-- /sbkdescription -->
		<!-- textforbackground -->'.$this->createInput(['id'=> 'textforbackground', 'text' => 'Текст background', 'placeholder' => '', 'width' => 400, 'name' => 'content[textforbackground]', 'value' => $pagesItem['textforbackground'], 'attr' => '']).'<!-- /textforbackground -->
		<!-- imagebgsbk -->'.$imagebgsbkOne.'<!-- /imagebgsbk -->
		<!-- imagebgsbklp -->'.$imagebgsbklpOne.'<!-- /imagebgsbklp -->
		<!-- imagebgsbkmb -->'.$imagebgsbkmbOne.'<!-- /imagebgsbkmb -->
                </fieldset><!-- /sectionPageData --><!-- /createFinish -->

<!-- section1 --><fieldset class="catalog__section">
	'.$this->createHeader('Причины').'
	<div class="catalog__section-data">
		<!-- section1 -->'.$this->createTextArea(['id'=> 'section1', 'text' => 'Причины', 'width' => '800x500', 'name' => 'content[section1]', 'value' => $pagesItem['section1'], 'attr' => '']).'<!-- /section1 -->

<!-- section2 --><fieldset class="catalog__section">
	'.$this->createHeader('Работы').'
	<div class="catalog__section-data">
		<!-- section2 -->'.$this->createTextArea(['id'=> 'section2', 'text' => 'Title ', 'width' => '400x100', 'name' => 'content[section2]', 'value' => $pagesItem['section2'], 'attr' => '']).'<!-- /section2 -->
		<!-- sbkworkstext -->'.$this->createInput(['id'=> 'sbkworkstext', 'text' => 'Title small ', 'placeholder' => '', 'width' => 400, 'name' => 'content[sbkworkstext]', 'value' => $pagesItem['sbkworkstext'], 'attr' => '']).'<!-- /sbkworkstext -->
		'.$this->createHeader('Информация о работах которые будут отображаться на странице').'
		<!-- idWorks1 -->'.$this->createSelect(['id'=> 'idWorks1', 'text' => 'Работа №1', 'width' => 400,  'name' => 'base[idWorks1]', 'value' => $works1Options, 'attr' => '']).'<!-- /idWorks1 -->
		<!-- sbkdeskwork1 -->'.$this->createTextArea(['id'=> 'sbkdeskwork1', 'text' => 'Описание работы 1', 'width' => '400x100', 'name' => 'content[sbkdeskwork1]', 'value' => $pagesItem['sbkdeskwork1'], 'attr' => '']).'<!-- /sbkdeskwork1 -->
		<!-- sbkimgwork1 -->'.$sbkimgwork1One.'<!-- /sbkimgwork1 -->
		<!-- idWorks2 -->'.$this->createSelect(['id'=> 'idWorks2', 'text' => 'Работа №2', 'width' => 400,  'name' => 'base[idWorks2]', 'value' => $works2Options, 'attr' => '']).'<!-- /idWorks2 -->
		<!-- sbkdeskwork2 -->'.$this->createTextArea(['id'=> 'sbkdeskwork2', 'text' => 'Описание работы 2', 'width' => '400x100', 'name' => 'content[sbkdeskwork2]', 'value' => $pagesItem['sbkdeskwork2'], 'attr' => '']).'<!-- /sbkdeskwork2 -->
		<!-- sbkimgwork2 -->'.$sbkimgwork2One.'<!-- /sbkimgwork2 -->
		<!-- idWorks3 -->'.$this->createSelect(['id'=> 'idWorks3', 'text' => 'Работа №3', 'width' => 400,  'name' => 'base[idWorks3]', 'value' => $works3Options, 'attr' => '']).'<!-- /idWorks3 -->
		<!-- sbkdeskwork3 -->'.$this->createTextArea(['id'=> 'sbkdeskwork3', 'text' => 'Описание работы 3', 'width' => '400x100', 'name' => 'content[sbkdeskwork3]', 'value' => $pagesItem['sbkdeskwork3'], 'attr' => '']).'<!-- /sbkdeskwork3 -->
		<!-- sbkimgwork3 -->'.$sbkimgwork3One.'<!-- /sbkimgwork3 -->
		<!-- idWorks4 -->'.$this->createSelect(['id'=> 'idWorks4', 'text' => 'Работа №4', 'width' => 400,  'name' => 'base[idWorks4]', 'value' => $works4Options, 'attr' => '']).'<!-- /idWorks4 -->
		<!-- sbkdeskwork4 -->'.$this->createTextArea(['id'=> 'sbkdeskwork4', 'text' => 'Описание работы 4', 'width' => '400x100', 'name' => 'content[sbkdeskwork4]', 'value' => $pagesItem['sbkdeskwork4'], 'attr' => '']).'<!-- /sbkdeskwork4 -->
		<!-- sbkimgwork4 -->'.$sbkimgwork4One.'<!-- /sbkimgwork4 -->
		<!-- idWorks5 -->'.$this->createSelect(['id'=> 'idWorks5', 'text' => 'Работа №5', 'width' => 400,  'name' => 'base[idWorks5]', 'value' => $works5Options, 'attr' => '']).'<!-- /idWorks5 -->
		<!-- sbkdeskwork5 -->'.$this->createTextArea(['id'=> 'sbkdeskwork5', 'text' => 'Описание работы 5', 'width' => '400x100', 'name' => 'content[sbkdeskwork5]', 'value' => $pagesItem['sbkdeskwork5'], 'attr' => '']).'<!-- /sbkdeskwork5 -->
		<!-- sbkimgwork5 -->'.$sbkimgwork5One.'<!-- /sbkimgwork5 -->
		<!-- idWorks6 -->'.$this->createSelect(['id'=> 'idWorks6', 'text' => 'Работа №6', 'width' => 400,  'name' => 'base[idWorks6]', 'value' => $works6Options, 'attr' => '']).'<!-- /idWorks6 -->
		<!-- sbkdeskwork6 -->'.$this->createTextArea(['id'=> 'sbkdeskwork6', 'text' => 'Описание работы 6', 'width' => '400x100', 'name' => 'content[sbkdeskwork6]', 'value' => $pagesItem['sbkdeskwork6'], 'attr' => '']).'<!-- /sbkdeskwork6 -->
		<!-- sbkimgwork6 -->'.$sbkimgwork6One.'<!-- /sbkimgwork6 -->
		<!-- idWorks7 -->'.$this->createSelect(['id'=> 'idWorks7', 'text' => 'Работа №7', 'width' => 400,  'name' => 'base[idWorks7]', 'value' => $works7Options, 'attr' => '']).'<!-- /idWorks7 -->
		<!-- sbkdeskwork7 -->'.$this->createTextArea(['id'=> 'sbkdeskwork7', 'text' => 'Описание работы 7', 'width' => '400x100', 'name' => 'content[sbkdeskwork7]', 'value' => $pagesItem['sbkdeskwork7'], 'attr' => '']).'<!-- /sbkdeskwork7 -->
		<!-- sbkimgwork7 -->'.$sbkimgwork7One.'<!-- /sbkimgwork7 -->



</fieldset><!-- /section2 -->

<!-- section3 --><fieldset class="catalog__section">
	'.$this->createHeader('Подход к разработке').'
	<div class="catalog__section-data">
		<!-- section3 -->'.$this->createTextArea(['id'=> 'section3', 'text' => 'Title', 'width' => '400x100', 'name' => 'content[section3]', 'value' => $pagesItem['section3'], 'attr' => '']).'<!-- /section3 -->
		<!-- sbksmalltitle3 -->'.$this->createInput(['id'=> 'sbksmalltitle3', 'text' => 'Title small', 'placeholder' => '', 'width' => 400, 'name' => 'content[sbksmalltitle3]', 'value' => $pagesItem['sbksmalltitle3'], 'attr' => '']).'<!-- /sbksmalltitle3 -->
		<!-- sbktitlestep1 -->'.$this->createInput(['id'=> 'sbktitlestep1', 'text' => 'Title шага', 'placeholder' => '', 'width' => 400, 'name' => 'content[sbktitlestep1]', 'value' => $pagesItem['sbktitlestep1'], 'attr' => '']).'<!-- /sbktitlestep1 -->
		<!-- sbkdeskstep1 -->'.$this->createTextArea(['id'=> 'sbkdeskstep1', 'text' => 'Описание шага', 'width' => '400x100', 'name' => 'content[sbkdeskstep1]', 'value' => $pagesItem['sbkdeskstep1'], 'attr' => '']).'<!-- /sbkdeskstep1 -->
		<!-- sbktitlestep2 -->'.$this->createInput(['id'=> 'sbktitlestep2', 'text' => 'Title шага', 'placeholder' => '', 'width' => 400, 'name' => 'content[sbktitlestep2]', 'value' => $pagesItem['sbktitlestep2'], 'attr' => '']).'<!-- /sbktitlestep2 -->
		<!-- sbkdeskstep2 -->'.$this->createTextArea(['id'=> 'sbkdeskstep2', 'text' => 'Описание шага', 'width' => '400x100', 'name' => 'content[sbkdeskstep2]', 'value' => $pagesItem['sbkdeskstep2'], 'attr' => '']).'<!-- /sbkdeskstep2 -->
		<!-- sbktitlestep3 -->'.$this->createInput(['id'=> 'sbktitlestep3', 'text' => 'Title шага', 'placeholder' => '', 'width' => 400, 'name' => 'content[sbktitlestep3]', 'value' => $pagesItem['sbktitlestep3'], 'attr' => '']).'<!-- /sbktitlestep3 -->
		<!-- sbkdeskstep3 -->'.$this->createTextArea(['id'=> 'sbkdeskstep3', 'text' => 'Описание шага', 'width' => '400x100', 'name' => 'content[sbkdeskstep3]', 'value' => $pagesItem['sbkdeskstep3'], 'attr' => '']).'<!-- /sbkdeskstep3 -->
		<!-- sbktitlestep4 -->'.$this->createInput(['id'=> 'sbktitlestep4', 'text' => 'Title шага', 'placeholder' => '', 'width' => 400, 'name' => 'content[sbktitlestep4]', 'value' => $pagesItem['sbktitlestep4'], 'attr' => '']).'<!-- /sbktitlestep4 -->
		<!-- sbkdeskstep4 -->'.$this->createTextArea(['id'=> 'sbkdeskstep4', 'text' => 'Описание шага', 'width' => '400x100', 'name' => 'content[sbkdeskstep4]', 'value' => $pagesItem['sbkdeskstep4'], 'attr' => '']).'<!-- /sbkdeskstep4 -->
		<!-- sbktitlestep5 -->'.$this->createInput(['id'=> 'sbktitlestep5', 'text' => 'Title шага', 'placeholder' => '', 'width' => 400, 'name' => 'content[sbktitlestep5]', 'value' => $pagesItem['sbktitlestep5'], 'attr' => '']).'<!-- /sbktitlestep5 -->
		<!-- sbkdeskstep5 -->'.$this->createTextArea(['id'=> 'sbkdeskstep5', 'text' => 'Описание шага', 'width' => '400x100', 'name' => 'content[sbkdeskstep5]', 'value' => $pagesItem['sbkdeskstep5'], 'attr' => '']).'<!-- /sbkdeskstep5 -->
		<!-- sbktitlestep6 -->'.$this->createInput(['id'=> 'sbktitlestep6', 'text' => 'Title шага', 'placeholder' => '', 'width' => 400, 'name' => 'content[sbktitlestep6]', 'value' => $pagesItem['sbktitlestep6'], 'attr' => '']).'<!-- /sbktitlestep6 -->
		<!-- sbkdeskstep6 -->'.$this->createTextArea(['id'=> 'sbkdeskstep6', 'text' => 'Описание шага', 'width' => '400x100', 'name' => 'content[sbkdeskstep6]', 'value' => $pagesItem['sbkdeskstep6'], 'attr' => '']).'<!-- /sbkdeskstep6 -->
		<!-- sbktitlestep7 -->'.$this->createInput(['id'=> 'sbktitlestep7', 'text' => 'Title шага', 'placeholder' => '', 'width' => 400, 'name' => 'content[sbktitlestep7]', 'value' => $pagesItem['sbktitlestep7'], 'attr' => '']).'<!-- /sbktitlestep7 -->
		<!-- sbkdeskstep7 -->'.$this->createTextArea(['id'=> 'sbkdeskstep7', 'text' => 'Описание шага', 'width' => '400x100', 'name' => 'content[sbkdeskstep7]', 'value' => $pagesItem['sbkdeskstep7'], 'attr' => '']).'<!-- /sbkdeskstep7 -->
</fieldset><!-- /section3 -->

<!-- section4 --><fieldset class="catalog__section">
	'.$this->createHeader('Этапы разработки').'
	<div class="catalog__section-data">
		<!-- section4 -->'.$this->createTextArea(['id'=> 'section4', 'text' => 'Title', 'width' => '400x100', 'name' => 'content[section4]', 'value' => $pagesItem['section4'], 'attr' => '']).'<!-- /section4 -->
		<!-- sbksmalltitle -->'.$this->createInput(['id'=> 'sbksmalltitle', 'text' => 'Title small', 'placeholder' => '', 'width' => 400, 'name' => 'content[sbksmalltitle]', 'value' => $pagesItem['sbksmalltitle'], 'attr' => '']).'<!-- /sbksmalltitle -->
		<!-- sbkstagetitle1 -->'.$this->createInput(['id'=> 'sbkstagetitle1', 'text' => 'Title этапа', 'placeholder' => '', 'width' => 400, 'name' => 'content[sbkstagetitle1]', 'value' => $pagesItem['sbkstagetitle1'], 'attr' => '']).'<!-- /sbkstagetitle1 -->
		<!-- sbkstagelist1 --><div class="input-row__group-wrap">';
			for ($i = 0; $i < count($sbkstagelist1); $i++) {
				if ($i == count($sbkstagelist1)-1) {
					$content .= '<div class="input-row input-wrap input-row__group">
						<label class="input__label" for="' . $i . '">Пункты этапа</label>
						<input placeholder="" id="' . $i . '" name="sbkstagelist1[]" class="input catalog_input input-width_400" type="text" value="' . $this->getCodeStr($sbkstagelist1[$i]['text']) . '" />
						<div class="button button__block button_copy-block"></div>
					</div>';
					continue;
				}
				
				$content .= '<div class="input-row input-wrap input-row__group">
					<label class="input__label" for="' . $i . '">Пункты этапа</label>
					<input placeholder="" id="' . $i . '" name="sbkstagelist1[]" class="input catalog_input input-width_400" type="text" value="' . $this->getCodeStr($sbkstagelist1[$i]['text']) . '" />
					<div class="button button__block button_remove-block"></div>
				</div>';
			}
		$content .= '</div><!-- /sbkstagelist1 -->
		<!-- sbkstagetitle2 -->'.$this->createInput(['id'=> 'sbkstagetitle2', 'text' => 'Title этапа', 'placeholder' => '', 'width' => 400, 'name' => 'content[sbkstagetitle2]', 'value' => $pagesItem['sbkstagetitle2'], 'attr' => '']).'<!-- /sbkstagetitle2 -->
		<!-- sbkstagelist2 --><div class="input-row__group-wrap">';
			for ($i = 0; $i < count($sbkstagelist2); $i++) {
				if ($i == count($sbkstagelist2)-1) {
					$content .= '<div class="input-row input-wrap input-row__group">
						<label class="input__label" for="' . $i . '">Пункты этапа</label>
						<input placeholder="" id="' . $i . '" name="sbkstagelist2[]" class="input catalog_input input-width_400" type="text" value="' . $this->getCodeStr($sbkstagelist2[$i]['text']) . '" />
						<div class="button button__block button_copy-block"></div>
					</div>';
					continue;
				}
				
				$content .= '<div class="input-row input-wrap input-row__group">
					<label class="input__label" for="' . $i . '">Пункты этапа</label>
					<input placeholder="" id="' . $i . '" name="sbkstagelist2[]" class="input catalog_input input-width_400" type="text" value="' . $this->getCodeStr($sbkstagelist2[$i]['text']) . '" />
					<div class="button button__block button_remove-block"></div>
				</div>';
			}
		$content .= '</div><!-- /sbkstagelist2 -->
		<!-- sbkstagetitle3 -->'.$this->createInput(['id'=> 'sbkstagetitle3', 'text' => 'Title этапа', 'placeholder' => '', 'width' => 400, 'name' => 'content[sbkstagetitle3]', 'value' => $pagesItem['sbkstagetitle3'], 'attr' => '']).'<!-- /sbkstagetitle3 -->
		<!-- sbkstagelist3 --><div class="input-row__group-wrap">';
			for ($i = 0; $i < count($sbkstagelist3); $i++) {
				if ($i == count($sbkstagelist3)-1) {
					$content .= '<div class="input-row input-wrap input-row__group">
						<label class="input__label" for="' . $i . '">Пункты этапа</label>
						<input placeholder="" id="' . $i . '" name="sbkstagelist3[]" class="input catalog_input input-width_400" type="text" value="' . $this->getCodeStr($sbkstagelist3[$i]['text']) . '" />
						<div class="button button__block button_copy-block"></div>
					</div>';
					continue;
				}
				
				$content .= '<div class="input-row input-wrap input-row__group">
					<label class="input__label" for="' . $i . '">Пункты этапа</label>
					<input placeholder="" id="' . $i . '" name="sbkstagelist3[]" class="input catalog_input input-width_400" type="text" value="' . $this->getCodeStr($sbkstagelist3[$i]['text']) . '" />
					<div class="button button__block button_remove-block"></div>
				</div>';
			}
		$content .= '</div><!-- /sbkstagelist3 -->
		<!-- sbkstagetitle4 -->'.$this->createInput(['id'=> 'sbkstagetitle4', 'text' => 'Title этапа', 'placeholder' => '', 'width' => 400, 'name' => 'content[sbkstagetitle4]', 'value' => $pagesItem['sbkstagetitle4'], 'attr' => '']).'<!-- /sbkstagetitle4 -->
		<!-- sbkstagelist4 --><div class="input-row__group-wrap">';
			for ($i = 0; $i < count($sbkstagelist4); $i++) {
				if ($i == count($sbkstagelist4)-1) {
					$content .= '<div class="input-row input-wrap input-row__group">
						<label class="input__label" for="' . $i . '">Пункты этапа</label>
						<input placeholder="" id="' . $i . '" name="sbkstagelist4[]" class="input catalog_input input-width_400" type="text" value="' . $this->getCodeStr($sbkstagelist4[$i]['text']) . '" />
						<div class="button button__block button_copy-block"></div>
					</div>';
					continue;
				}
				
				$content .= '<div class="input-row input-wrap input-row__group">
					<label class="input__label" for="' . $i . '">Пункты этапа</label>
					<input placeholder="" id="' . $i . '" name="sbkstagelist4[]" class="input catalog_input input-width_400" type="text" value="' . $this->getCodeStr($sbkstagelist4[$i]['text']) . '" />
					<div class="button button__block button_remove-block"></div>
				</div>';
			}
		$content .= '</div><!-- /sbkstagelist4 -->
		<!-- sbkstagetitle5 -->'.$this->createInput(['id'=> 'sbkstagetitle5', 'text' => 'Title этапа', 'placeholder' => '', 'width' => 400, 'name' => 'content[sbkstagetitle5]', 'value' => $pagesItem['sbkstagetitle5'], 'attr' => '']).'<!-- /sbkstagetitle5 -->
		<!-- sbkstagelist5 --><div class="input-row__group-wrap">';
			for ($i = 0; $i < count($sbkstagelist5); $i++) {
				if ($i == count($sbkstagelist5)-1) {
					$content .= '<div class="input-row input-wrap input-row__group">
						<label class="input__label" for="' . $i . '">Пункты этапа</label>
						<input placeholder="" id="' . $i . '" name="sbkstagelist5[]" class="input catalog_input input-width_400" type="text" value="' . $this->getCodeStr($sbkstagelist5[$i]['text']) . '" />
						<div class="button button__block button_copy-block"></div>
					</div>';
					continue;
				}
				
				$content .= '<div class="input-row input-wrap input-row__group">
					<label class="input__label" for="' . $i . '">Пункты этапа</label>
					<input placeholder="" id="' . $i . '" name="sbkstagelist5[]" class="input catalog_input input-width_400" type="text" value="' . $this->getCodeStr($sbkstagelist5[$i]['text']) . '" />
					<div class="button button__block button_remove-block"></div>
				</div>';
			}
		$content .= '</div><!-- /sbkstagelist5 -->
		<!-- sbkstagetitle6 -->'.$this->createInput(['id'=> 'sbkstagetitle6', 'text' => 'Title этапа', 'placeholder' => '', 'width' => 400, 'name' => 'content[sbkstagetitle6]', 'value' => $pagesItem['sbkstagetitle6'], 'attr' => '']).'<!-- /sbkstagetitle6 -->
		<!-- sbkstagelist6 --><div class="input-row__group-wrap">';
			for ($i = 0; $i < count($sbkstagelist6); $i++) {
				if ($i == count($sbkstagelist6)-1) {
					$content .= '<div class="input-row input-wrap input-row__group">
						<label class="input__label" for="' . $i . '">Пункты этапа</label>
						<input placeholder="" id="' . $i . '" name="sbkstagelist6[]" class="input catalog_input input-width_400" type="text" value="' . $this->getCodeStr($sbkstagelist6[$i]['text']) . '" />
						<div class="button button__block button_copy-block"></div>
					</div>';
					continue;
				}
				
				$content .= '<div class="input-row input-wrap input-row__group">
					<label class="input__label" for="' . $i . '">Пункты этапа</label>
					<input placeholder="" id="' . $i . '" name="sbkstagelist6[]" class="input catalog_input input-width_400" type="text" value="' . $this->getCodeStr($sbkstagelist6[$i]['text']) . '" />
					<div class="button button__block button_remove-block"></div>
				</div>';
			}
		$content .= '</div><!-- /sbkstagelist6 -->

</fieldset><!-- /section4 -->

<!-- section5 --><fieldset class="catalog__section">
	'.$this->createHeader('P.S').'
	<div class="catalog__section-data">
		<!-- section5 -->'.$this->createTextArea(['id'=> 'section5', 'text' => 'P.S.title', 'width' => '400x100', 'name' => 'content[section5]', 'value' => $pagesItem['section5'], 'attr' => '']).'<!-- /section5 -->

		<!-- sbkpslist --><div class="input-row__group-wrap">';
			for ($i = 0; $i < count($sbkpslist); $i++) {
				if ($i == count($sbkpslist)-1) {
					$content .= '<div class="input-row input-wrap input-row__group">
						<label class="input__label" for="' . $i . '">Пункт перечня</label>
						<input placeholder="" id="' . $i . '" name="sbkpslist[]" class="input catalog_input input-width_400" type="text" value="' . $this->getCodeStr($sbkpslist[$i]['text']) . '" />
						<div class="button button__block button_copy-block"></div>
					</div>';
					continue;
				}
				
				$content .= '<div class="input-row input-wrap input-row__group">
					<label class="input__label" for="' . $i . '">Пункт перечня</label>
					<input placeholder="" id="' . $i . '" name="sbkpslist[]" class="input catalog_input input-width_400" type="text" value="' . $this->getCodeStr($sbkpslist[$i]['text']) . '" />
					<div class="button button__block button_remove-block"></div>
				</div>';
			}
		$content .= '</div><!-- /sbkpslist -->

</fieldset><!-- /section5 -->

<!-- Links --><fieldset class="catalog__section">
	'.$this->createHeader('Выбор ссылок отображаемых в футере').'
	<div class="catalog__section-data">
		<!-- links -->'.$this->createCheckBoxGroup(['list' => $linksList]).'<!-- /links -->
	</div>
</fieldset><!-- /Links -->


'.
            Html::endForm();