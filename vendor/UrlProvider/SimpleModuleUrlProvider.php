<?php
namespace vendor\UrlProvider;

use Yii;
use frontend\models\Root;

/**
 * SimpleModuleUrlProvider class.
 */
class SimpleModuleUrlProvider extends UrlProvider
{
	var $indexUrl;
	var $joinUris;
	var $myRoot;
	var $moduleUris;
	var $textPagesUrlProvider;
	
	function __construct($lang, $options=[]) {
		parent::__construct($lang);
		$this->indexUrl = parent::getIndexUrl();
		
		// join modules uris (from sent item) or build them by our own
		$this->joinUris = isset($options['joinUris']);
		
		$myRoot = new Root($lang);
		
		$needModuleUris = !isset($options['joinUris']);
		if ($needModuleUris) {
			$this->moduleUris = $myRoot->getModuleUrls($options['table']);
		}
		
		$this->textPagesUrlProvider = new TextPagesUrlProvider($lang);
	}
	
	
	////////////////////////////////////////////////////// URLS //////////////////////////////////////////////////////
	
	/**
	 * Get works item url.
	 */
	public function geteWorksItemUrl($params=[]) {
		$worksUrl = $this->textPagesUrlProvider->getPortfolioUrl();
		$worksItemUri = $this->getWorksItemUri($params);
		$url = $worksUrl.$worksItemUri;
		
		return $url;
	}
	
	
	////////////////////////////////////////////////////// URIS //////////////////////////////////////////////////////
	
	/**
	 * Get works item uri.
	 */
	public function getWorksItemUri($params=[]) {
		$uri = '/'.$params['item']['url'];
		return $uri;
	}
}