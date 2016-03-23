<?php
namespace vendor\UrlProvider;

use Yii;
use frontend\models\Root;

/**
 * TextPagesUrlProvider class.
 */
class TextPagesUrlProvider extends UrlProvider
{
	var $indexUrl;
	var $pagesUrls;
	
	function __construct($lang, $options=[]) {
		parent::__construct($lang);
		$this->indexUrl = parent::getIndexUrl();
		
		$needPagesUris = !isset($options['joinUris']);
		if ($needPagesUris) {
			$myRoot = new Root($lang);
			$this->pagesUrls = $myRoot->getPagesUrls();
		} else {
			$this->pagesUrls = $this->getPagesUrls($options['items']);
		}
	}
	
	
	/**
	 * Get pages urls.
	 */
	public function getPagesUrls($pages, $params=[]) {
		$pagesUrls = [];
		
		foreach ($pages as $item) {
			$pagesUrls[$item['pAlias']] = $item['url'];
		}
        
        return $pagesUrls;
	}
	
	
	////////////////////////////////////////////////////// URLS //////////////////////////////////////////////////////
	
	/**
	 * Get sites by keys url.
	 */
	public function getSitesByKeysUrl($params=[]) {
		$sitesbykeysUri = $this->getSitesbykeysUri();
		$url = $this->indexUrl.$sitesbykeysUri;
		return $url;
	}
	
	/**
	 * Get works url.
	 */
	public function getPortfolioUrl($params=[]) {
		$sitesbykeysUri = $this->getSitesbykeysUri();
		$portfolioUri = $this->getPortfolioUri();
		$url = $this->indexUrl.$sitesbykeysUri.$portfolioUri;
		return $url;
	}
	
	/**
	 * Gete filter url.
	 */
	public function geteFilterUrl($params=[]) {
		$sitesbykeysUri = $this->getSitesbykeysUri();
		$portfolioUri = $this->getPortfolioUri();
		$filterUri = $this->getFilterUri($params);
		$url = $this->indexUrl.$sitesbykeysUri.$portfolioUri.$filterUri;
		return $url;
	}
	
	
	////////////////////////////////////////////////////// URIS //////////////////////////////////////////////////////
	
	/**
	 * Get sitesbykeys uri.
	 */
	public function getSitesbykeysUri($params=[]) {
		$alias = 'sitesbykeys';
		$uri = '/'.$this->pagesUrls[$alias];
		return $uri;
	}
	
	/**
	 * Get portfolio uri
	 */
	public function getPortfolioUri($params=[]) {
		$alias = 'portfolio';
		$uri = '/'.$this->pagesUrls[$alias];
		return $uri;
	}
	
	/**
	 * Get filter uri
	 */
	public function getFilterUri($params=[]) {
		$uri = '/'.$params['item']['url'];
		return $uri;
	}
}