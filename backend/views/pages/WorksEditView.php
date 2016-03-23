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
		$content .= '<li class="crumbs__item crumbs__item-active">Редактирование записи('.$worksItem['pH1'].')</li>';
	} else {
		$content .= '<li class="crumbs__item crumbs__item-active">Добавление записи</li>';
	}
$content .= '</ul>';
// Хлебные крошки КОНЕЦ



// Форма редактирования НАЧАЛО

$showViz = $worksItem['show'] > 0 ? 'checked="checked"' : '';



// Селект "Фильтр"
$filtersOptions = '<option value="0">Выберите вариант</option>';
foreach ($filters as $item) {
	if ($item['id'] == $worksItem['idFilters']) {
		$filtersOptions .= '<option value="'.$item['id'].'"  selected>'.$item['title'].'</option>';
		continue;
	}

	$filtersOptions .= '<option value="'.$item['id'].'" >'.$item['title'].'</option>';
}/* UpdateCode */



if ($idRecord) {
	$content .= '<form action="formupdate/'.$idPageGroup.'/'.$idRecord.'?pageLang='.$pageLang.'" method="post" id="form-edit-content">';
} else {
	$content .= '<form action="formupdate/'.$idPageGroup.'?newDoc=1&pageLang='.$pageLang.'" method="post" id="form-edit-content">';
}

$content .= '<!-- sectionPageData --><fieldset class="catalog__section">
	'.$this->createHeader('Основные данные страницы').'
	<div class="catalog__section-data">
		<!-- pH1 -->'.$this->createInput(['id'=> 'pH1', 'text' => 'Заголовок H1', 'placeholder' => '', 'width' => 400, 'name' => 'content[pH1]', 'value' => $worksItem['pH1'], 'attr' => 'required']).'<!-- /pH1 -->
		<!-- pTitle -->'.$this->createInput(['id'=> 'pTitle', 'text' => 'Заголовок страницы', 'placeholder' => 'В поисковой выдаче видно 60 символов', 'width' => 400, 'name' => 'content[pTitle]', 'value' => $worksItem['pTitle'], 'attr' => 'required data-count="60"', 'dataCopy' => 'pH1', 'titleCopy' => 'Копия заголовка H1']).'<!-- /pTitle -->
		<!-- pUrl -->'.$this->createInput(['id' => 'pUrl', 'text' => 'Алиас страницы', 'width' => 400, 'name' => 'base[pUrl]', 'value' => $worksItem['pUrl'], 'attr' => 'required', 'genUrl' => 'pH1', 'titleUrl' => 'Генерация с заголовка H1']).'<!-- /pUrl -->
		<!-- pDescription -->'.$this->createTextArea(['id'=> 'pDescription', 'text' => 'Meta description', 'placeholder' => 'В поисковой выдаче видно 140 символов', 'width' => '400x100', 'name' => 'content[pDescription]', 'value' => $worksItem['pDescription'], 'attr' => 'data-count="140"']).'<!-- /pDescription -->
		<!-- show -->'.$this->createCheckBoxRow(['id' => 'show', 'text' => 'Отображать страницу', 'name' => 'base[show]', 'value' => 1, 'attr' => $showViz]).'
	</div>
</fieldset><!-- /sectionPageData -->

<!-- commonData --><fieldset class="catalog__section">
	'.$this->createHeader('Основные данные').'
	<div class="catalog__section-data">
		<!-- description -->'.$this->createTextArea(['id'=> 'description', 'text' => 'Описание', 'width' => '400x100', 'name' => 'content[description]', 'value' => $worksItem['description'], 'attr' => '']).'<!-- /description -->
		<!-- filters -->'.$this->createSelect(['id'=> 'idFilters', 'text' => 'Фильтр', 'width' => 400,  'name' => 'base[idFilters]', 'value' => $filtersOptions, 'attr' => '']).'<!-- /filters -->
	</div>
</fieldset><!-- /commonData --><!-- /createFinish -->

</form>';
// Форма редактирования КОНЕЦ