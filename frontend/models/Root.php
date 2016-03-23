<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use vendor\UrlProvider\UrlProvider;
use vendor\UrlProvider\TextPagesUrlProvider;

/**
 * Root model
 */
class Root extends Model
{
    private $lang;
	
	function __construct($lang) {
		$this->lang = $lang;
	}
	
    public function getPageIdAndClassName($pUrl) {
        $query = Yii::$app->db->createCommand('SELECT
			`id`, `class`
		FROM
			`pages`
		WHERE
			`pUrl` = :pUrl AND
			pShow = 1')
        ->bindValue(':pUrl', $pUrl);
        
        return $query->queryOne();
    }
	
    /**
     * Получить урл страницы по алиасу
     */
    public function getPageUrlByAlias($alias) {
        $query = Yii::$app->db->createCommand('SELECT
			`pUrl` as url
		FROM
			`pages`
		WHERE
			`alias` = :alias')
        ->bindValue(':alias', $alias);
        
        return $query->queryScalar();
    }
	
    public function getPageContent($pUrl='index', $fields=[]) {
        $fields = !empty($fields) ? ', '.implode(', ', $fields) : '';
		
		$query = Yii::$app->db->createCommand('SELECT
			`id`, `pTitle`, `pDescription`, `pKeyWords`, `pH1`, `pMenuName`, `pBreadCrumbs`, `pContent`,
			`pAlias` as alias
			'.$fields.'
		FROM
			`pages`, `content`
		WHERE
			`pUrl` = :pUrl AND
			`pageId` = `id` AND
			`lang` = :lang')
        ->bindValue(':pUrl', $pUrl)
        ->bindValue(':lang', $this->lang);
        
        return $query->queryOne();
    }
	
    public function getPageContentByAlias($alias, $fields=[], $imagefields=[], $multifields=[], $multiimage=[]) {
        $fields = !empty($fields) ? ', '.implode(', ', $fields) : '';
		
		// информация из одиночных изображений
		foreach ($imagefields as $imagefield) {
			$imagefieldUcfirsted = ucfirst($imagefield);
			$fields .= ', IF(`pages`.`'.$alias.$imagefieldUcfirsted.'` <> "", CONCAT("/'.Yii::$app->params['pics']['pages']['path'].'original-", `pages`.`'.$alias.$imagefieldUcfirsted.'`), "") as '.$imagefield.'PathOriginal';
			$counter = 1;
			foreach (Yii::$app->params['pics']['pages'][$alias][$imagefield.'Sizes'] as $sizeName => $sizes) {
				$index = ($counter > 1) ? (string)$counter : '';
				$fields .= ', IF(`pages`.`'.$alias.$imagefieldUcfirsted.'` <> "", CONCAT("/'.Yii::$app->params['pics']['pages']['path'].''.$sizeName.'-", `pages`.`'.$alias.$imagefieldUcfirsted.'`), "") as '.$imagefield.'Path'.ucfirst($sizeName);
				$fields .= ', `pages`.`'.$alias.$imagefieldUcfirsted.'Width'.$index.'` as '.$imagefield.'W'.$index;
				$fields .= ', `pages`.`'.$alias.$imagefieldUcfirsted.'Height'.$index.'` as '.$imagefield.'H'.$index;
				$counter++;
			}
			$fields .= ', `content`.`'.$alias.$imagefieldUcfirsted.'Title` as '.$imagefield.'T';
		}
		
		$query = Yii::$app->db->createCommand('SELECT
			`id`
			'.$fields.'
		FROM
			`pages`, `content`
		WHERE
			`pAlias` = :alias AND
			`pageId` = `id` AND
			`lang` = :lang')
        ->bindValue(':alias', $alias)
        ->bindValue(':lang', $this->lang);
        
        $result = $query->queryOne();
		
		if ($result) {
			// информация из множественных полей
			foreach ($multifields as $multifield) {
				$result[$multifield] = $this->getMultiFieldsData($multifield, $result['id']);
			}
			
			// информация из множественных изображений
			foreach ($multiimage as $multiimageItem) {
				$result[$multiimageItem] = $this->getMultiImageData($multiimageItem, $result['id']);
			}
		}
        
		return $result;
    }
	
    public function getPagesContent($params=[]) {
        $where = '';
			
		if (isset($params['ignoreSitemap'])) { //фильтр по карте сайта
			$where .= ' AND
		`p`.`ignoreSitemap` <> 1';
		}
		
		$query = Yii::$app->db->createCommand('SELECT
			`p`.`id`, `c`.`pTitle`, `c`.`pDescription`, `c`.`pKeyWords`, `c`.`pH1`, `c`.`pMenuName` as menu, `c`.`pBreadCrumbs` as breadcrumb, `c`.`pContent`,
			`p`.`pUrl` as url, `p`.`pAlias`
		FROM
			`pages` `p`, `content` `c`
		WHERE
			`c`.`pageId` = `p`.`id` AND
			`c`.`lang` = :lang'.$where)
        ->bindValue(':lang', $this->lang);
        
        $result = $query->queryAll();
		
		$pagesContent = [];
		foreach ($result as $item) {
			$pagesContent[$item['pAlias']] = $item;
		}
        
        return $pagesContent;
    }
	
    public function getProjectContent() {
		$pagesContent = $this->getPagesContent();
		$statPagesContent = [];
		return array_merge($pagesContent, $statPagesContent);
	}
	
    public function getPagesUrls() {
		$query = Yii::$app->db->createCommand('SELECT
			`p`.`id`, `p`.`pUrl` as url, `p`.`pAlias` as alias
		FROM
			`pages` `p`');
        
        $result = $query->queryAll();
		
		$pagesUrls = [];
		foreach ($result as $item) {
			$pagesUrls[$item['alias']] = $item['url'];
		}
        
        return $pagesUrls;
	}
	
    public function getModuleUrls($table) {
		$query = Yii::$app->db->createCommand('SELECT
			`pUrl` as url, `alias`
		FROM
			`'.$table.'`');
        
        $result = $query->queryAll();
		
		$moduleUrls = [];
		foreach ($result as $item) {
			$moduleUrls[$item['alias']] = $item['url'];
		}
        
        return $moduleUrls;
	}
	
    public function getModuleContent($table, $pUrl, $fields=[]) {
        $lang = $this->lang;
		
		$fields = !empty($fields) ? ', '.implode(', ', $fields) : '';
		
		$query = Yii::$app->db->createCommand('SELECT
			`t`.`id`, `tc`.`pTitle`, `tc`.`pDescription`, `tc`.`pKeyWords`, `tc`.`pH1`, `tc`.`pMenuName` as menu, `tc`.`pBreadCrumbs` as breadcrumb, `tc`.`pContent`,
			`t`.`pUrl` as url, `t`.`alias`
			'.$fields.'
		FROM
			`'.$table.'` `t`, `'.$table.'_content` `tc`
		WHERE
			`pUrl` = :pUrl AND
			`id'.ucfirst($table).'` = `id` AND
			`lang` = :lang')
        ->bindValue(':pUrl', $pUrl)
        ->bindValue(':lang', $lang);
        
        return $query->queryOne();
    }
	
	/**
	 * Информация из таблицы отражающей поле типа "мультифилд"
	 */
    public function getMultiFieldsData($entity, $itemId) {
		$query = Yii::$app->db->createCommand('SELECT
			`pe`.`id`, `pe`.`text`
		FROM
			`pages_'.$entity.'` `pe`, `pages` `p`
		WHERE
			`pe`.`idRel` = `p`.`id` AND
			`p`.`id` = '.$itemId.' AND
			`pe`.`lang` = :lang')
		->bindValue(':lang', $this->lang);
		
		$result = $query->queryAll();
		
		$emptyResult = (count($result) == 1 && $result[0]['text'] == '');
		$result = !$emptyResult ? $result : [];
		return $result;
	}
	
	/**
	 * Информация из таблицы отражающей поле типа "множественные изображения"
	 */
    public function getMultiImageData($entity, $itemId) {
		$query = Yii::$app->db->createCommand('SELECT
			`pe`.`id`, IF(`pe`.`img` <> "", CONCAT("/'.Yii::$app->params['pics']['pages']['path'].'medium-", `pe`.`img`), "") as img,
			`pe`.`imgWidth` as imgW, `pe`.`imgHeight` as imgH,
			`pe`.`id`, IF(`pe`.`img` <> "", CONCAT("/'.Yii::$app->params['pics']['pages']['path'].'original-", `pe`.`img`), "") as imgOriginal,
			`pe`.`id`, IF(`pe`.`img` <> "", CONCAT("/'.Yii::$app->params['pics']['pages']['path'].'general-", `pe`.`img`), "") as imgGeneral,
			`pe`.`id`, IF(`pe`.`img` <> "", CONCAT("/'.Yii::$app->params['pics']['pages']['path'].'mob-", `pe`.`img`), "") as imgMob,
			`pec`.`imgTitle` as imgT
		FROM
			`pages_'.$entity.'` `pe`, `pages_'.$entity.'_content` `pec`, `pages` `p`
		WHERE
			`pe`.`idPages` = `p`.`id` AND
			`p`.`id` = '.$itemId.' AND
			`pec`.`idImg` = `pe`.`id` AND `pec`.`lang` = :lang
		ORDER BY `order`')
		->bindValue(':lang', $this->lang);
		
		$result = $query->queryAll();
		return $result;
	}
	
	
	
    public static function getCodeStr($str) {
		$search = ["«", "»", "‘", "’", "“", "”", '"', "'", "<", ">"];
		$replace = ["&laquo;", "&raquo;", "&lsquo;", "&rsquo;", "&ldquo;", "&rdquo;", "&quot;", "&apos;", "&lsaquo;", "&rsaquo;"];
		return str_replace ($search , $replace , $str);
	}
}
