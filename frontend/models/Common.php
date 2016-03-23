<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Common model
 */
class Common extends Model
{
    /**
     * Получить хост
     */
    public static function getHostName() {
		$hostName = Yii::$app->params['hostProtocol'].$_SERVER['HTTP_HOST'];
		return $hostName;
	}

    /**
     * Получить язык
     */
    public function getLang($params=[]) {
        // определяем условия для языка по-умолчанию
        $firstUri = Yii::$app->request->get('id', '');
		$defaultLang = !in_array($firstUri, Yii::$app->params['siteLangs']);
		
		$lang = $defaultLang ? Yii::$app->params['defLang'] : $firstUri;
        return $lang;
    }

    /**
     * Получить uris
     */
    public function getUris($lang) {
        // определяем условия для "сдвига" uris
        $urisShifted = ($lang != Yii::$app->params['defLang']);
		
		if ($urisShifted) {
			$firstUri = Yii::$app->request->get('id2', '');
			$secondUri = Yii::$app->request->get('id3', '');
			$thirdUri = Yii::$app->request->get('id4', '');
		} else {
			$firstUri = Yii::$app->request->get('id', '');
			$secondUri = Yii::$app->request->get('id2', '');
			$thirdUri = Yii::$app->request->get('id3', '');
		}
        
        return [
			$firstUri,
			$secondUri,
			$thirdUri
		];
    }

    /**
     * Получить uri языка
     */
    public function getLangUri($lang) {
        // определяем условия когда uri языка - пустая строка
        $emptyLangUri = ($lang == Yii::$app->params['defLang']);
        
		$uri = $emptyLangUri ? '' : '/'.$lang;
		return $uri;
    }

    /**
     * Получить uri страницы для получения контента страницы
     */
    public function getPageUri($pagesUrls, $uris) {
        // определяем случай индексной страницы
        $indexUri = $this->isIndexPage($uris['firstUri']);
		
        // определяем условия когда для получения контента страницы
		// используем первый uri
		$firstUri = (!$uris['secondUri'] && in_array($uris['firstUri'], $pagesUrls) || $uris['secondUri'] && !in_array($uris['secondUri'], $pagesUrls));
		
        // определяем условия когда для получения контента страницы
		// используем второй uri
		$secondUri = ($uris['secondUri']
			//страница должна существовать (отсекаем случай 404-й страницы)
			&& in_array($uris['firstUri'], $pagesUrls)
			//страница должна быть текстовой
			&& in_array($uris['secondUri'], $pagesUrls)
		);
		
		if ($indexUri) {
			$pageUri = $this->getDbIndexUri();
		} else if ($firstUri) {
			$pageUri = $uris['firstUri'];
		} else if ($secondUri) {
			$pageUri = $uris['secondUri'];
		} else {
			$pageUri = false;
		}
		
        return $pageUri;
    }

    /**
     * Находимся ли мы на индексной странице
     */
    public function isIndexPage($firstUri) {
        return ($firstUri == '');
    }

    /**
     * Получить uri индексной страницы
     */
    public function getDbIndexUri() {
        return 'index';
    }
}
