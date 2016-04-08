<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Works model
 */
class Works extends Model
{
	private $lang;
	
	function __construct($lang) {
		$this->lang = $lang;
	}
	
	/**
	 * Кол-во работ
	 */
    public function getListCount($params=[]) {
		$join = '';
		$where = '';
		$pUrl = '';
		
		// условия
		$criteria = $this->getCriteria($params);
		$join .= $criteria['join'];
		$where .= $criteria['where'];
		$pUrl .= $criteria['pUrl'];
		
		// запрос
		$query = Yii::$app->db->createCommand('SELECT
			COUNT(`w`.`id`)
		FROM
			`works` `w`
			'.$join.'
		WHERE
			`w`.`show` <> 0'.$where);
        
		if ($pUrl) {
			$query->bindValue(':pUrl', $pUrl);
		}
		
		//echo '<pre>';print_r($query);echo '</pre>';exit;
		$result = $query->queryScalar();
		
		return $result;
    }
	
	/**
	 * Список работ
	 */
    public function getList($params=[]) {
		$fields = '';
		$join = '';
		$where = '';
		$orderBy = '`w`.`id`';
		$pUrl = '';
		
		// условия
		$criteria = $this->getCriteria($params);
		$fields .= $criteria['fields'];
		$join .= $criteria['join'];
		$where .= $criteria['where'];
		$pUrl .= $criteria['pUrl'];

		// сортировка
		if (isset($params['sorting'])) {
			if ($params['sorting'] == 'createdDesc') { //по убыванию даты добавления
				$orderBy = '`w`.`dateCreated` DESC';
			}
		}
		
		// лимит
		if (isset($params['limit'])) {
			$limit = ' LIMIT '.$params['limit'];
		} else {
			$limit = '';
		}
		
		// оффсет
		if (isset($params['offset'])) {
			$offset = ' OFFSET '.$params['offset'];
		} else {
			$offset = '';
		}
		
		// запрос
		$query = Yii::$app->db->createCommand('SELECT
            `w`.`id`, `w`.`pUrl` as url, `w`.`dateCreated`,
            IF(`w`.`image` <> "", CONCAT("/'.Yii::$app->params['pics']['works']['path'].'preview-", `w`.`image`), "") as imgPath,
			`w`.`imageWidth2` as imgW, `w`.`imageHeight2` as imgH, `wc`.`imageTitle` as imgT,

			`wc`.`pH1` as title, `wc`.`description`
			'.$fields.'
		FROM
			`works` `w`
			LEFT JOIN `works_content` `wc`
				ON `wc`.`idWorks` = `w`.`id` AND `wc`.`lang` = :lang
			'.$join.'
		WHERE
			`w`.`show` <> 0'.$where.'
		ORDER BY
			'.$orderBy
		.$limit
		.$offset)
        ->bindValue(':lang', $this->lang);
        
		if ($pUrl) {
			$query->bindValue(':pUrl', $pUrl);
		}
		
		//echo '<pre>';print_r($query);echo '</pre>';exit;
		$result = $query->queryAll();
		
		return $result;
    }

	/**
	 * Формирование условий
	 */
	public function getCriteria($params=[]) {
		$fields = '';
		$join = '';
		$where = '';
		$pUrl = '';

		// работы в пределах фильтра
		if (isset($params['filter'])) {
			$join .= ' JOIN `filters` `f`
				ON `f`.`id` = `w`.`idFilters` AND `f`.`url` = :pUrl';
			$pUrl = $params['filter'];

		}

		return [
			'fields' => $fields,
			'join' => $join,
			'where' => $where,
			'pUrl' => $pUrl,
		];
	}

	/**
	 * Единица работы
	 */
    public function getItem($pUrl) {
		// запрос
		$query = Yii::$app->db->createCommand('SELECT
            `w`.`id`, `w`.`pUrl` as url, `w`.`dateCreated` as publishDate,
            IF(`w`.`image` <> "", CONCAT("/'.Yii::$app->params['pics']['works']['path'].'general-", `w`.`image`), "") as imgPath,
            IF(`w`.`imagebg` <> "", CONCAT("/'.Yii::$app->params['pics']['works']['path'].'generalbg-", `w`.`imagebg`), "") as imgPathbg,
            IF(`w`.`imagebg` <> "", CONCAT("/'.Yii::$app->params['pics']['works']['path'].'mediumbg-", `w`.`imagebg`), "") as imgPathbgmd,
            IF(`w`.`imagebg` <> "", CONCAT("/'.Yii::$app->params['pics']['works']['path'].'smallbg-", `w`.`imagebg`), "") as imgPathbgsm,
			`w`.`imageWidth` as imgW, `w`.`imageHeight` as imgH, `wc`.`imageTitle` as imgT,
            `wc`.`pTitle`, `wc`.`description`, `wc`.`pH1`, `wc`.`pContent` as content,`wc`.`client`,`wc`.`services`,`wc`.`launch`,`wc`.`aboutProject`,`wc`.`task`

        FROM
            `works` `w`, `works_content` `wc`
        WHERE
            `w`.`pUrl` = :pUrl AND
			`wc`.`idWorks` = `w`.`id` AND
			`wc`.`lang` = :lang')
        ->bindValue(':pUrl', $pUrl)
        ->bindValue(':lang', $this->lang);

        $result = $query->queryOne();

		return $result;
    }
	
	/**
	 * Список ссылок (для плашки сссылок в футере)
	 */
    public function getLinks($alias, $params=[]) {
		// запрос
		$query = Yii::$app->db->createCommand('SELECT
            `l`.`id`,
			`lc`.`title`,
			`p`.`urlMethod`
		FROM
			`links` `l`
			LEFT JOIN `links_content` `lc`
				ON `lc`.`idLinks` = `l`.`id` AND `lc`.`lang` = :lang
			LEFT JOIN `pages` `p`
				ON `p`.`id` = `l`.`idTextpages`
			JOIN `pages_links` `pl`
				ON `pl`.`idLinks` = `l`.`id`
			JOIN `pages` `p2`
				ON `p2`.`id` = `pl`.`idPages` AND `p2`.`pAlias` = :alias
		ORDER BY
			`l`.`id`')
        ->bindValue(':lang', $this->lang)
        ->bindValue(':alias', $alias);
		
		//echo '<pre>';print_r($query);echo '</pre>';exit;
		$result = $query->queryAll();
		
		return $result;
    }

	/*Список работ для вывода на странице Sites by keys*/
	public function getListForSitesByKeys($alias, $params=[]) {
		// запрос
		$query = Yii::$app->db->createCommand('SELECT
		   `w`.`id`, `w`.`pUrl` as url,
            IF(`w`.`image` <> "", CONCAT("/'.Yii::$app->params['pics']['works']['path'].'mediumsbk-", `w`.`image`), "") as imgPath,
			`w`.`imageWidth2` as imgW, `w`.`imageHeight2` as imgH, `wc`.`imageTitle` as imgT,

			`wc`.`pH1` as title, `wc`.`description`
		FROM
			`works` `w`
			LEFT JOIN `works_content` `wc`
				ON `wc`.`idWorks` = `w`.`id` AND `wc`.`lang` = :lang
		    JOIN `pages_works` `pw`
				ON `w`.`id`=`pw`.`idWorks`
		    JOIN `pages` `p`
				ON `p`.`id` = `pw`.`idPages`AND `p`.`pAlias` = :alias')
				->bindValue(':lang', $this->lang)
				->bindValue(':alias', $alias);
		//echo '<pre>';print_r($query);echo '</pre>';exit;
		$result = $query->queryAll();

		return $result;
	}
	/*Список работ для вывода на странице Portfolio*/
	public function getListForPortfolio($params=[]) {
		$fields = '';
		$join = '';
		$where = '';
		$orderBy = '`w`.`id`';
		$pUrl = '';

		// условия
		$criteria = $this->getCriteria($params);
		$fields .= $criteria['fields'];
		$join .= $criteria['join'];
		$where .= $criteria['where'];
		$pUrl .= $criteria['pUrl'];

		// сортировка
		if (isset($params['sorting'])) {
			if ($params['sorting'] == 'createdDesc') { //по убыванию даты добавления
				$orderBy = '`w`.`dateCreated` DESC';
			}
		}

		// лимит
		if (isset($params['limit'])) {
			$limit = ' LIMIT '.$params['limit'];
		} else {
			$limit = '';
		}

		// оффсет
		if (isset($params['offset'])) {
			$offset = ' OFFSET '.$params['offset'];
		} else {
			$offset = '';
		}

		// запрос
		$query = Yii::$app->db->createCommand('SELECT
            `w`.`id`, `w`.`pUrl` as url, `w`.`dateCreated`,
            IF(`w`.`image` <> "", CONCAT("/'.Yii::$app->params['pics']['works']['path'].'generalprtf-", `w`.`imageprtf`), "") as imgPath,
			`w`.`imageWidth2` as imgW, `w`.`imageHeight2` as imgH, `wc`.`imageTitle` as imgT,

			`wc`.`pH1` as title, `wc`.`description`
			'.$fields.'
		FROM
			`works` `w`
			LEFT JOIN `works_content` `wc`
				ON `wc`.`idWorks` = `w`.`id` AND `wc`.`lang` = :lang
			'.$join.'
		WHERE
			`w`.`show` <> 0'.$where.'
		ORDER BY
			'.$orderBy
				.$limit
				.$offset)
				->bindValue(':lang', $this->lang);

		if ($pUrl) {
			$query->bindValue(':pUrl', $pUrl);
		}

		//echo '<pre>';print_r($query);echo '</pre>';exit;
		$result = $query->queryAll();

		return $result;
	}

	/**
	 * Формирование условий
	 */
	public function getCriteriaForPortfolio($params=[]) {
		$fields = '';
		$join = '';
		$where = '';
		$pUrl = '';

		// работы в пределах фильтра
		if (isset($params['filter'])) {
			$join .= ' JOIN `filters` `f`
				ON `f`.`id` = `w`.`idFilters` AND `f`.`url` = :pUrl';
			$pUrl = $params['filter'];

		}

		return [
				'fields' => $fields,
				'join' => $join,
				'where' => $where,
				'pUrl' => $pUrl,
		];
	}
}
