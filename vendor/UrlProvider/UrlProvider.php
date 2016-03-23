<?php
namespace vendor\UrlProvider;

use Yii;
use frontend\models\Common;

/**
 * UrlProvider class.
 */
class UrlProvider
{
	var $lang;
	var $hostName;
	var $langUri;
	
	const cartAPIConstUri = '/cartAPI';
	
	function __construct($lang, $options=[]) {
        $this->lang = $lang;
		$myCommon = new Common();
        $this->hostName = isset($options['hostName']) ? $options['hostName'] : $myCommon->getHostName();
		$this->langUri = $myCommon->getLangUri($lang);
	}
	
	
	/////////////////////////////////////////////////////// URLS ///////////////////////////////////////////////////////
	
	/**
	 * Get index url.
	 */
	public function getIndexUrl($params=[]) {
		$indexUri = $this->getIndexUri();
		$url = $this->hostName.$this->langUri.$indexUri;
		return $url;
	}
	
	
	/////////////////////////////////////////////////////// URIS ///////////////////////////////////////////////////////
	
	/**
	 * Get index uri.
	 */
	public function getIndexUri($params=[]) {
		$uri = '';
		return $uri;
	}
}