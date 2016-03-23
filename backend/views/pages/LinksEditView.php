<?php

// Навигационное меню НАЧАЛО
$navMenu .= '<nav class="sidebar__menu">';
	$countLangs = count($langs);
	if($countLangs) {
		$navMenu .= '<fieldset class="select-wrap sidebar_select"><select class="select" name="language" data-module="select">';
		for ($i = 0; $i < $countLangs; $i++) {
			$selected = '';
			if($pageLang == $langs[$i]['sName']) {
				$selected = 'selected';
			}

			if ($idRecord) {
				$navMenu .= '<option data-href="formedit" data-action="/'.$id1Uri.'/'.$idRecord.'/'.$langs[$i]['sName'].'" '.$selected.' value="'.$langs[$i]['sName'].'">'.$langs[$i]['fullName'].'</option>';
			} else {
				$navMenu .= '<option data-href="formadd" data-action="/'.$id1Uri.'/'.$langs[$i]['sName'].'" '.$selected.' value="'.$langs[$i]['sName'].'">'.$langs[$i]['fullName'].'</option>';
			}
		}
		$navMenu .= '</select></fieldset>';
	}
	
	$navMenu .= '<ul class="sidebar-menu__list">
		<li class="sidebar-menu__item sidebar-menu__item-save">Сохранить</li>';
		if ($idRecord) {
			$navMenu .= '<li class="sidebar-menu__item sidebar-menu__item-remove" data-id="formdel/'.$idPageGroup.'/'.$idRecord.'">Удалить</li>';
		}
	$navMenu .= '</ul>
</nav>';
// Навигационное меню КОНЕЦ



// Хлебные крошки НАЧАЛО
$content .= '<ul class="crumbs">';
	$content .= '<li class="crumbs__item"><a href="/'.$idPageGroup.'/'.$pageLang.'" data-href="formlist">Список записей</a></li>';
	if ($idRecord) {
		$content .= '<li class="crumbs__item crumbs__item-active">Редактирование записи</li>';
	} else {
		$content .= '<li class="crumbs__item crumbs__item-active">Добавление записи</li>';
	}
$content .= '</ul>';
// Хлебные крошки КОНЕЦ



// Форма редактирования НАЧАЛО



// Селект "Текстовая страница"
$textpagesOptions = '<option value="0">Выберите вариант</option>';
foreach ($textpages as $item) {
	if ($item['id'] == $linksItem['idTextpages']) {
		$textpagesOptions .= '<option value="'.$item['id'].'"  selected>'.$item['pH1'].'</option>';
		continue;
	}

	$textpagesOptions .= '<option value="'.$item['id'].'" >'.$item['pH1'].'</option>';
}/* UpdateCode */



if ($idRecord) {
	$content .= '<form action="formupdate/'.$idPageGroup.'/'.$idRecord.'?pageLang='.$pageLang.'" method="post" id="form-edit-content">';
} else {
	$content .= '<form action="formupdate/'.$idPageGroup.'?newDoc=1&pageLang='.$pageLang.'" method="post" id="form-edit-content">';
}

$content .= '<!-- /createFinish -->

<!-- commonData --><fieldset class="catalog__section">
	'.$this->createHeader('Основные данные').'
	<div class="catalog__section-data">
		<!-- title -->'.$this->createInput(['id'=> 'title', 'text' => 'Заголовок', 'placeholder' => '', 'width' => 400, 'name' => 'content[title]', 'value' => $linksItem['title'], 'attr' => '']).'<!-- /title -->
		<!-- textpages -->'.$this->createSelect(['id'=> 'idTextpages', 'text' => 'Текстовая страница', 'width' => 400,  'name' => 'base[idTextpages]', 'value' => $textpagesOptions, 'attr' => '']).'<!-- /textpages -->
	</div>
</fieldset><!-- /commonData -->

</form>';
// Форма редактирования КОНЕЦ