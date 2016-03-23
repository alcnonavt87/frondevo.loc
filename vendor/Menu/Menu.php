<?php
namespace vendor\Menu;

use Yii;
use frontend\models\Root;
use vendor\UrlProvider\UrlProvider;
use vendor\UrlProvider\TextPagesUrlProvider;

/**
 * Menu class.
 */
class Menu
{
	var $lang;
	var $type;
	var $currAlias;
	var $config;
	var $menu;
	var $pagesContent;
	var $urlProvider;
	var $textPagesUrlProvider;
	var $catalogUrlProvider;
	
	// html-код меню
	static $openCode;
	static $item1Code;
	static $item1CodeActive;
	static $closeCode;
	static $item1OpenCode;
	static $item2Code;
	static $item1CloseCode;
	static $item2OpenCode;
	static $item3Code;
	static $item2CloseCode;
	
	const CODE_SHIFT = "\n\t\t\t";
	
	function __construct($lang, $type, $options=[]) {
		$this->lang = $lang;
		
		// тип меню
		$this->type = $type;
		
		// алиас текущей страницы
		$this->currAlias = isset($options['currAlias']) ? $options['currAlias'] : null;
		
		// подключаем конфиг
		require 'config.php';
		$this->config = $config;
		$this->menu = $menu;
		
		// размерность меню
		$level = $this->menu[$this->type]['level'];
		
		// получаем информацию о текстовых страницах
		$myRoot = new Root($lang);
		$pagesContent = $myRoot->getPagesContent($lang);
		$this->pagesContent = $pagesContent;//echo '<pre>';print_r($this->pagesContent);echo '</pre>';exit;
		
		// инициализируем провайдеры урлов сайта
		$this->urlProvider = new UrlProvider($lang);
		$options = [];
		$options['joinUris'] = 1;
		$options['items'] = $pagesContent;
		$this->textPagesUrlProvider = new TextPagesUrlProvider($lang, $options);
		$options = [];
		$options['joinUris'] = 1;
		
		// инициализируем html-код меню
		// первый уровень
		$openCodePath = $this->config['templates']['partsPath'].$this->config['templates'][$type]['openName'];
		$item1CodePath = $this->config['templates']['partsPath'].$this->config['templates'][$type]['item1Name'];
		$item1CodePathActive = $this->config['templates']['partsPath'].$this->config['templates'][$type]['item1NameActive'];
		$closeCodePath = $this->config['templates']['partsPath'].$this->config['templates'][$type]['closeName'];
		self::$openCode = Yii::$app->controller->renderPartial($openCodePath);
		self::$item1Code = Yii::$app->controller->renderPartial($item1CodePath);
		self::$item1CodeActive = Yii::$app->controller->renderPartial($item1CodePathActive);
		self::$closeCode = Yii::$app->controller->renderPartial($closeCodePath);
		// второй уровень
		if ($level > 1) {
			$item1OpenCodePath = $this->config['templates']['partsPath'].$this->config['templates'][$type]['item1OpenName'];
			$item2CodePath = $this->config['templates']['partsPath'].$this->config['templates'][$type]['item2Name'];
			$item1CloseCodePath = $this->config['templates']['partsPath'].$this->config['templates'][$type]['item1CloseName'];
			self::$item1OpenCode = Yii::$app->controller->renderPartial($item1OpenCodePath);
			self::$item2Code = Yii::$app->controller->renderPartial($item2CodePath);
			self::$item1CloseCode = Yii::$app->controller->renderPartial($item1CloseCodePath);
		}
		// третий уровень
		if ($level > 2) {
			$item2OpenCodePath = $this->config['templates']['partsPath'].$this->config['templates'][$type]['item2OpenName'];
			$item3CodePath = $this->config['templates']['partsPath'].$this->config['templates'][$type]['item3Name'];
			$item2CloseCodePath = $this->config['templates']['partsPath'].$this->config['templates'][$type]['item2CloseName'];
			self::$item2OpenCode = Yii::$app->controller->renderPartial($item2OpenCodePath);
			self::$item3Code = Yii::$app->controller->renderPartial($item3CodePath);
			self::$item2CloseCode = Yii::$app->controller->renderPartial($item2CloseCodePath);
		}
	}
	
	
	/************************ ОСНОВНЫЕ ФУНКЦИИ ************************/
	
	/**
	 * Create menu.
	 */
	public function create($params=[]) {
		$content = '';
		
		// получаем и объединяем три части:
		// открывающую, "сердцевину" и закрывающую
		$open = $this->createOpen($params);
		$menu = $this->createMenu($params);
		$close = $this->createClose($params);
		$content .= $open;
		$content .= $menu;
		$content .= $close;
		
		return $content;
	}
	
	/**
	 * Create menu core part.
	 */
	public function createMenu($params=[]) {
		$content = '';
		
		// конфигурация пунктов меню
		$menu = $this->menu[$this->type]['items'];//echo '<pre>';print_r($menu);echo '</pre>';exit;
		
		/************************ ПЕРВЫЙ УРОВЕНЬ: НАЧАЛО ************************/
		
		// обрабатываем первый уровень
		foreach ($menu as $key => $menuItem) {
			// признак наличия подменю (второго уровня)
			$submenu = is_array($menuItem);
			
			// html-код пункта меню
			$currItem = ($menuItem == $this->currAlias);
			if ($currItem) { //активный пункт
				$itemCode = $this->createItem1Active($params);
			} else if ($submenu) { //пункт, открывающий второй уровень
				$itemCode = $this->createItem1Open($params);
			} else {
				$itemCode = $this->createItem1($params);
			}
			
			// получаем данные для обработки сниппетов
			$class = $this->getUrlProviderClass(0, null);
			$alias = $submenu ? $key : $menuItem;
			$method = $this->getUrlProviderMethod(0, null, $alias);
			$methodParams = $this->getUrlProviderMethodParams(0, null);
			$data = $this->pagesContent;
			
			// обрабатываем сниппеты
			$content .= $this->processSnippets($class, $method, $methodParams, $data, $alias, $itemCode);
			
			
			/************************ ВТОРОЙ УРОВЕНЬ: НАЧАЛО ************************/
			
			if ($submenu) {
				// пункты меню второго уровня
				$submenuItems = $menuItem;//echo '<pre>';print_r($submenuItems);echo '</pre>';exit;
				
				// уточняем пункты меню (в случае, если они представлены неспецифицированным сниппетом типа {subdivs})
				$pattern = '/^{([\w]+)[}=>{]*([\w]*)}$/';
				$submenuItemsSnippetted = preg_match($pattern, $submenuItems[0], $matches);
				if ($submenuItemsSnippetted) {
					$submenuItemsSnippet = $matches[1];
					// выясняем заданы ли пункты меню общим сниппетом или конкретно
					$submenuItemsSnippetParts = explode('_', $submenuItemsSnippet);
					$submenuItemsSpecified = isset($submenuItemsSnippetParts[1]);
					if (!$submenuItemsSpecified) {
						$submenuItems = $this->convertCommonSnippetToSpecified($params[$submenuItemsSnippet], $submenuItemsSnippet);
					}
				}
				
				// обрабатываем второй уровень
				foreach ($submenuItems as $key => $submenuItem) {
					// получаем пункты меню (в случае, если они представлены специфицированным сниппетом типа {subdiv_dresses})
					preg_match($pattern, $submenuItem, $matches);
					$submenuItemSnippet = isset($matches[1]) ? $matches[1] : null;
					$submenuItemSnippetParts = explode('_', $submenuItemSnippet);
					$submenuItemSpecified = isset($submenuItemSnippetParts[1]);
					if ($submenuItemSpecified) {
						$submenuItemKey = $submenuItemSnippetParts[0].'s';
						$submenuItemValue = $submenuItemSnippetParts[1];
					} else {
						$submenuItemKey = $submenuItemSnippet;
					}
					
					// получаем данные по пунктам меню (в случае, если они представлены сниппетом)
					$submenuItemSnippetted = $submenuItemsSnippetted;
					if ($submenuItemSnippetted) {
						$submenuItemData = $params[$submenuItemKey];
					}
					
					// признак наличия подменю (третьего уровня)
					$submenu = (isset($matches[2]) && !empty($matches[2]));
					
					// html-код пункта меню
					if ($submenu) { //пункт, открывающий третий уровень
						$itemCode = $this->createItem2Open($params);
					} else {
						$itemCode = $this->createItem2($params);
					}
					
					// получаем данные для обработки сниппетов
					$class = $this->getUrlProviderClass($submenuItemSnippetted, $submenuItemKey);
					$alias = $submenuItemSpecified ? $submenuItemValue : $submenuItem;
					$method = $this->getUrlProviderMethod($submenuItemSnippetted, $submenuItemKey, $alias);
					if ($submenuItemSnippetted) {
						$item = $submenuItemData[$alias];
						$data = $submenuItemData;
					} else {
						$item = null;
						$data = $this->pagesContent;
					}
					$methodParams = $this->getUrlProviderMethodParams($submenuItemSnippetted, $item);
					//echo '<pre>';print_r($class);echo '</pre>';exit;
					// обрабатываем сниппеты
					$content .= $this->processSnippets($class, $method, $methodParams, $data, $alias, $itemCode);
					
					
					/************************ ТРЕТИЙ УРОВЕНЬ: НАЧАЛО ************************/
					
					if ($submenu) {
						// пункты меню третьего уровня
						$submenuItemSnippet = $matches[2];
						$submenuItemData = $params[$submenuItemSnippet];
						$submenuItems = array_keys($submenuItemData);//echo '<pre>';print_r($submenuItems);echo '</pre>';exit;
						
						// обрабатываем третий уровень
						foreach ($submenuItems as $key => $submenuItem) {
							// html-код пункта меню
							$itemCode = $this->createItem3($params);
							
							// получаем данные для обработки сниппетов
							$class = $this->getUrlProviderClass(1, $submenuItemSnippet);
							$alias = $submenuItem;
							$method = $this->getUrlProviderMethod(1, $submenuItemSnippet, $alias);
							$item = $submenuItemData[$submenuItem];
							$data = $submenuItemData;
							$methodParams = $this->getUrlProviderMethodParams($submenuItemSnippetted, $item);
							//echo '<pre>';print_r($class);echo '</pre>';exit;
							// обрабатываем сниппеты
							$content .= $this->processSnippets($class, $method, $methodParams, $data, $alias, $itemCode);
						}
						
						// закрываем третий уровень
						$content .= $this->createItem2Close($params);
					}
					
					/************************ ТРЕТИЙ УРОВЕНЬ: КОНЕЦ ************************/
				
				}
				
				// закрываем второй уровень
				$content .= $this->createItem1Close($params);
			}
			
			/************************ ВТОРОЙ УРОВЕНЬ: КОНЕЦ ************************/
			
		}
		
		/************************ ПЕРВЫЙ УРОВЕНЬ: КОНЕЦ ************************/
		
		return $content;
	}
	
	
	/************************ ВСПОМОГАТЕЛЬНЫЕ ФУНКЦИИ ************************/
	
	/**
	 * Convert common snippet to list of specified snippets.
	 */
	public function convertCommonSnippetToSpecified($data, $snippet, $params=[]) {
		$specifiedSnippets = [];
		
		foreach ($data as $item) {
			$snippetSingular = substr($snippet, 0, -1);
			$specifiedSnippet = '{'.$snippetSingular.'_'.$item['alias'].'}';
			$specifiedSnippets[] = $specifiedSnippet;
		}
		
		return $specifiedSnippets;
	}
	
	/**
	 * Get url provider class.
	 */
	public function getUrlProviderClass($snippetted, $snippet, $params=[]) {
		if ($snippetted) { //раздел/подраздел
			switch ($snippet) {
				case 'subdivs':
				case 'cats':
					$class = 'catalogUrlProvider';
					break;
				default:
					$class = '';
			}
		} else { //текстовая страница
			$class = 'textPagesUrlProvider';
		}
		
		return $class;
	}
	
	/**
	 * Get url provider method.
	 */
	public function getUrlProviderMethod($snippetted, $snippet, $alias, $params=[]) {
		if ($snippetted) { //раздел/подраздел
			switch ($snippet) {
				case 'subdivs':
					$method = 'getCatalogSubdivUrl';
					break;
				case 'cats':
					$method = 'getCatalogCategoryUrl';
					break;
				default:
					$method = '';
			}
		} else { //текстовая страница
			$method = 'get'.ucfirst($alias).'Url';
		}
		
		return $method;
	}
	
	/**
	 * Get url provider method params.
	 */
	public function getUrlProviderMethodParams($snippetted, $item, $params=[]) {
		$methodParams = [];
		
		if ($snippetted) { //раздел/подраздел
			$methodParams['item'] = $item;
		}
		
		return $methodParams;
	}
	
	/**
	 * Process snippets.
	 */
	public function processSnippets($class, $method, $methodParams, $data, $alias, $itemCode, $params=[]) {
		$content = '';
		
		// ищем сниппеты
		$search[] = '{{activeClass}}';
		$search[] = '{{itemUrl}}';
		$search[] = '{{itemText}}';
		
		// получаем данные
		$itemUrl = $this->{$class}->{$method}($methodParams);
		$itemText = $data[$alias]['menu'];
		
		// заменяем сниппеты данными
		$replace[] = $this->config['classes']['item1Active'];
		$replace[] = $itemUrl;
		$replace[] = $itemText;
		$itemCode = str_replace($search, $replace, $itemCode);
		$content .= self::CODE_SHIFT."\t".$itemCode;
		
		$search = [];
		$replace = [];
		
		return $content;
	}
	
	
	/************************ HTML-ШАБЛОНЫ "НУЛЕВОЙ" УРОВЕНЬ (ОТКРЫТИЕ/ЗАКРЫТИЕ ВСЕГО МЕНЮ) ************************/
	
	/**
	 * Create menu open part.
	 */
	public function createOpen($params=[]) {
		$content = self::$openCode;
		return $content;
	}
	
	/**
	 * Create menu close part.
	 */
	public function createClose($params=[]) {
		$content = self::CODE_SHIFT.self::$closeCode;
		return $content;
	}
	
	
	/************************ HTML-ШАБЛОНЫ ПЕРВЫЙ УРОВЕНЬ ************************/
	
	/**
	 * Create item1.
	 */
	public function createItem1($params=[]) {
		$content = self::$item1Code;
		return $content;
	}
	
	/**
	 * Create active item1.
	 */
	public function createItem1Active($params=[]) {
		$content = self::$item1CodeActive;
		return $content;
	}
	
	
	/************************ HTML-ШАБЛОНЫ ВТОРОЙ УРОВЕНЬ ************************/
	
	/**
	 * Create item1 open.
	 */
	public function createItem1Open($params=[]) {
		$content = self::$item1OpenCode;
		return $content;
	}
	
	/**
	 * Create item1 close.
	 */
	public function createItem1Close($params=[]) {
		$content = self::$item1CloseCode;
		return $content;
	}
	
	/**
	 * Create item2.
	 */
	public function createItem2($params=[]) {
		$content = self::$item2Code;
		return $content;
	}
	
	
	/************************ HTML-ШАБЛОНЫ ТРЕТИЙ УРОВЕНЬ ************************/
	
	/**
	 * Create item2 open.
	 */
	public function createItem2Open($params=[]) {
		$content = self::$item2OpenCode;
		return $content;
	}
	
	/**
	 * Create item2 close.
	 */
	public function createItem2Close($params=[]) {
		$content = self::$item2CloseCode;
		return $content;
	}
	
	/**
	 * Create item3.
	 */
	public function createItem3($params=[]) {
		$content = self::$item3Code;
		return $content;
	}
}