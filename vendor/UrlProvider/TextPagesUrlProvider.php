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
			$this->pagesUrls = $myRoot->getPagesUrls();//echo '<pre>';print_r($this->pagesUrls);echo '</pre>';exit;
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
	 * Get landing page url.
	 */
	public function getLandingpageUrl ($params=[]) {
		$landingpageUri = $this->getLandingPageUri();
		$url = $this->indexUrl.$landingpageUri;
		return $url;
	}
	/**
	 * Get commercial url.
	 */
	public function getCommercialUrl($params=[]) {
		$commercialUri = $this->getCommercialUri();
		$url = $this->indexUrl.$commercialUri;
		return $url;
	}

	/**
	 * Get contacts url.
	 */
	public function getContactsUrl($params=[]) {
		$commercialUri = $this->getContactslUri();
		$url = $this->indexUrl.$commercialUri;
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


	/**
	 * Get outsourcing url.
	 */
	public function getOutsourcingUrl($params=[]) {
		$OutsourcingUri = $this->getOutsourcingUri();
		$url = $this->indexUrl.$OutsourcingUri;
		return $url;
	}
	/**
	 * Get FrontendOut url.
	 */
	public function getFrontendOutUrl($params=[]) {
		$FrontendOutUri = $this->getFrontendOutUri();
		$OutsourcingUri = $this->getOutsourcingUri();
		$url = $this->indexUrl.$OutsourcingUri.$FrontendOutUri;
		return $url;
	}
	/**
	 * Get Psd2html5 url.
	 */
	public function getPsd2html5Url($params=[]) {
		$Psd2html5Uri = $this->getPsd2html5Uri();
		$OutsourcingUri = $this->getOutsourcingUri();
		$url = $this->indexUrl.$OutsourcingUri.$Psd2html5Uri;
		return $url;
	}
	/**
	 * Get Javascript url.
	 */

	public function getJavascriptUrl($params=[]) {
		$JavascriptUri = $this->getJavascriptUri();
		$OutsourcingUri = $this->getOutsourcingUri();
		$url = $this->indexUrl.$OutsourcingUri.$JavascriptUri;
		return $url;
	}
	/**
	 * Get Games url.
	 */

	public function getGamesUrl($params=[]) {
		$GamesUri = $this->getGamesUri();
		$OutsourcingUri = $this->getOutsourcingUri();
		$url = $this->indexUrl.$OutsourcingUri.$GamesUri;
		return $url;
	}
	/**
	 * Get Javascript url.
	 */

	public function getAnimationsUrl($params=[]) {
		$AnimationsUri = $this->getAnimationsUri();
		$OutsourcingUri = $this->getOutsourcingUri();
		$url = $this->indexUrl.$OutsourcingUri.$AnimationsUri;
		return $url;
	}
	/**
	 * Get Angular url.
	 */
	public function getAngularUrl($params=[]) {
		$AngularUri = $this->getAngularUri();
		$OutsourcingUri = $this->getOutsourcingUri();
		$url = $this->indexUrl.$OutsourcingUri.$AngularUri;
		return $url;
	}
	/**
	 * Get Portfolifrontout url.
	 */
	public function getPortfolifrontoutUrl($params=[]) {
		$PortfolioFrontOutUri = $this->getPortfolioFrontOut();
		$OutsourcingUri = $this->getOutsourcingUri();
		$url = $this->indexUrl.$OutsourcingUri.$PortfolioFrontOutUri;

		return $url;

	}

	/**
	 * Get filterfrontout url.
	 */
	public function getFilterFrontOutUrl($params=[]) {
		$otusorceUri = $this->getOutsourcingUri();
		$portfoliofrontoutUri = $this->getPortfolioFrontOut();
		$filterUri = $this->getFilterUri($params);
		$url = $this->indexUrl.$otusorceUri.$portfoliofrontoutUri.$filterUri;
		return $url;
	}


	////////////////////////////////////////////////////// URIS //////////////////////////////////////////////////////
	
	/**
	 * Get commercial uri.
	 */
	public function getCommercialUri($params=[]) {
		$alias = 'commercial';
		$uri = '/'.$this->pagesUrls[$alias];
		return $uri;
	}
	/**
	 * Get commercial uri.
	 */
	public function getContactslUri($params=[]) {
		$alias = 'contacts';
		$uri = '/'.$this->pagesUrls[$alias];
		return $uri;
	}



	/**
	 * Get outsourcing uri.
	 */
	public function getOutsourcingUri($params=[]) {
		$alias = 'outsourcing';
		$uri = '/'.$this->pagesUrls[$alias];
		return $uri;
	}

	/**
	 * Get FrontendOut uri.
	 */
	public function getFrontendOutUri($params=[]) {
		$alias = 'frontendout';
		$uri = '/'.$this->pagesUrls[$alias];
		return $uri;
	}
	/**
	 * Get FrontendOut uri.
	 */
	public function getPsd2html5Uri($params=[]) {
		$alias = 'psd2html5';
		$uri = '/'.$this->pagesUrls[$alias];
		return $uri;
	}
	/**
	 * Get FrontendOut uri.
	 */
	public function getJavascriptUri($params=[]) {
		$alias = 'javascript';
		$uri = '/'.$this->pagesUrls[$alias];
		return $uri;
	}
	/**
	 * Get Games uri.
	 */
	public function getGamesUri($params=[]) {
		$alias = 'games';
		$uri = '/'.$this->pagesUrls[$alias];
		return $uri;
	}
	/**
	 * Get Animations uri.
	 */
	public function getAnimationsUri($params=[]) {
		$alias = 'animations';
		$uri = '/'.$this->pagesUrls[$alias];
		return $uri;
	}
	/**
	 * Get Angular uri.
	 */
	public function getAngularUri($params=[]) {
		$alias = 'angular';
		$uri = '/'.$this->pagesUrls[$alias];
		return $uri;
	}
	/**
	 * Get portfoliofrontout uri.
	 */
	public function getPortfolioFrontOut($params=[]) {
		$alias = 'portfoliofrontout';
		$uri = '/'.$this->pagesUrls[$alias];
		return $uri;
	}

	/**
	 * Get sitesbykeys uri.
	 */
	public function getSitesbykeysUri($params=[]) {
		$alias = 'sitesbykeys';
		$uri = '/'.$this->pagesUrls[$alias];
		return $uri;
	}
	/**
	 * Get landing page uri.
	 */
	public function getLandingPageUri($params=[]) {
		$alias = 'landingpage';
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

	/**
	 * Get filter uri
	 */
	public function getFilterFrontOutUri($params=[]) {
		$uri = '/'.$params['item']['url'];
		return $uri;
	}
}
