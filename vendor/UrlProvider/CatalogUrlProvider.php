<?php
namespace vendor\UrlProvider;

use Yii;
use frontend\models\Root;

/**
 * CatalogUrlProvider class.
 */
class CatalogUrlProvider extends UrlProvider
{
	var $indexUrl;
	var $joinUris;
	var $myRoot;
	var $catalogUris;
	var $textPagesUrlProvider;
	
	const table = 'catalog';
	
	function __construct($lang, $options=[]) {
		parent::__construct($lang);
		$this->indexUrl = parent::getIndexUrl();
		
		// join modules uris (from sent item) or build them by our own
		$this->joinUris = isset($options['joinUris']);
		
		$myRoot = new Root($lang);
		$this->myRoot = $myRoot;
		
		$needCatalogUris = !isset($options['joinUris']);
		if ($needCatalogUris) {
			$this->catalogUris = $myRoot->getModuleUrls(self::table);
		}
		
		$this->textPagesUrlProvider = new TextPagesUrlProvider($lang);
	}
	
	
	////////////////////////////////////////////////////// URLS //////////////////////////////////////////////////////
	
	/**
	 * Get catalog item url.
	 */
	public function getCatalogItemUrl($params=[]) {
		$textpageUrl = $this->textPagesUrlProvider->getTextpageUrl();
		$catalogItemUri = $this->getCatalogItemUri($params);
		$url = $textpageUrl.$catalogItemUri;
		
		return $url;
	}
	
	
	////////////////////////////////////////////////////// URIS //////////////////////////////////////////////////////
	
	/**
	 * Get catalog item uri.
	 */
	public function getCatalogItemUri($params=[]) {
		$uri = '/'.$params['item']['url'];
		return $uri;
	}
}