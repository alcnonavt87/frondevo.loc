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
            IF(`w`.`image` <> "", CONCAT("'.Yii::$app->params['pics']['works']['path'].'preview-", `w`.`image`), "") as imgPath,
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
            IF(`w`.`image` <> "", CONCAT("'.Yii::$app->params['pics']['works']['path'].'general-", `w`.`image`), "") as imgPath,
            IF(`w`.`imagebg` <> "", CONCAT("'.Yii::$app->params['pics']['works']['path'].'generalbg-", `w`.`imagebg`), "") as imgPathbg,
            IF(`w`.`imagebg` <> "", CONCAT("'.Yii::$app->params['pics']['works']['path'].'mediumbg-", `w`.`imagebg`), "") as imgPathbgmd,
            IF(`w`.`imagebg` <> "", CONCAT("'.Yii::$app->params['pics']['works']['path'].'smallbg-", `w`.`imagebg`), "") as imgPathbgsm,
            IF(`w`.`mainpage` <> "", CONCAT("'.Yii::$app->params['pics']['works']['path'].'generalmp-", `w`.`mainpage`), "") as imgPathmp,
            IF(`w`.`mainpage` <> "", CONCAT("'.Yii::$app->params['pics']['works']['path'].'bigmp-", `w`.`mainpage`), "") as imgPathmpbig,
            IF(`w`.`mainpage` <> "", CONCAT("'.Yii::$app->params['pics']['works']['path'].'mediummp-", `w`.`mainpage`), "") as imgPathmpmd,
            IF(`w`.`mainpage` <> "", CONCAT("'.Yii::$app->params['pics']['works']['path'].'smallmp-", `w`.`mainpage`), "") as imgPathmpsm,
            IF(`w`.`addpage` <> "", CONCAT("'.Yii::$app->params['pics']['works']['path'].'generaladd-", `w`.`addpage`), "") as imgPathadd,
			`w`.`imageWidth` as imgW, `w`.`imageHeight` as imgH, `wc`.`imageTitle` as imgT,
            `wc`.`pTitle`, `wc`.`pDescription`,`wc`.`description`, `wc`.`pH1`, `wc`.`pContent` as content,`wc`.`client`,`wc`.`services`,`wc`.`launch`,`wc`.`aboutProject`,`wc`.`task`,`wc`.`add`,
            `wc`.`descrofsolut`,`wc`.`linkwork`,`wc`.`results`as result,`wc`.`solutions`

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
	public function getWorksContentFromMultiField($alias,$multifields=[]) {


		$query = Yii::$app->db->createCommand('SELECT
			`id`
		FROM
			`works`,`works_content`
		WHERE
			`pUrl` = :alias AND
			`lang` = :lang')
				->bindValue(':alias', $alias)
				->bindValue(':lang', $this->lang);

		$result = $query->queryOne();

		if ($result) {
			// информация из множественных полей
			foreach ($multifields as $multifield) {
				$result[$multifield] = $this->getMultiFieldsData($multifield, $result['id']);
			}
		}
		return $result;
	}

	public function getMultiFieldsData($entity, $itemId) {
		$query = Yii::$app->db->createCommand('SELECT
			`pe`.`id`, `pe`.`text`
		FROM
			`works_'.$entity.'` `pe`, `works` `p`
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
			`l`.`order`')
        ->bindValue(':lang', $this->lang)
        ->bindValue(':alias', $alias);
		
		//echo '<pre>';print_r($query);echo '</pre>';exit;
		$result = $query->queryAll();
		
		return $result;
    }

	public function getWorksForSitesByKeys() {
		// запрос
		$query = Yii::$app->db->createCommand('SELECT
		   `p`.`idWorks1`, `p`.`idWorks2`, `p`.`idWorks3`, `p`.`idWorks4`, `p`.`idWorks5`, `p`.`idWorks6`, `p`.`idWorks7`,
		   `p`.`sbkimgwork1`,`p`.`sbkimgwork2`,`p`.`sbkimgwork3`,`p`.`sbkimgwork4`,`p`.`sbkimgwork5`,`p`.`sbkimgwork6`,`p`.`sbkimgwork7`,
		    `c`.`sbkdeskwork1`,`c`.`sbkdeskwork2`,`c`.`sbkdeskwork3`,`c`.`sbkdeskwork4`,`c`.`sbkdeskwork5`,`c`.`sbkdeskwork6`,`c`.`sbkdeskwork7`,
		    `w`.`pUrl` as url, `w2`.`pUrl` as url1,`w3`.`pUrl` as url2,`w4`.`pUrl` as url3,`w5`.`pUrl` as url4,`w6`.`pUrl` as url5,`w7`.`pUrl` as url6
		FROM
			`pages` `p`
			JOIN `content` `c`
				ON `c`.`pageid` = `p`.`id` AND `c`.`lang` = :lang
		   JOIN `works` `w`
				ON `w`.`id`=`p`.`idWorks1`
		   LEFT JOIN  `works` `w2`
			   ON `w2`.`id`=`p`.`idWorks2`
			LEFT JOIN  `works` `w3`
			   ON `w3`.`id`=`p`.`idWorks3`
			LEFT JOIN `works` `w4`
			   ON `w4`.`id`=`p`.`idWorks4`
			LEFT JOIN `works` `w5`
			   ON `w5`.`id`=`p`.`idWorks5`
			LEFT JOIN `works` `w6`
			   ON `w6`.`id`=`p`.`idWorks6`
			LEFT JOIN `works` `w7`
			   ON `w7`.`id`=`p`.`idWorks7`
		  ')

				->bindValue(':lang', $this->lang);

		//echo '<pre>';print_r($query);echo '</pre>';exit;
		$result = $query->queryAll();

		return $result;
	}


	/*Список работ для вывода на странице Sites by keys*/
	public function getListForSitesByKeys($alias, $params=[]) {
		// запрос
		$query = Yii::$app->db->createCommand('SELECT
		   `w`.`id`, `w`.`pUrl` as url,
            IF(`w`.`image` <> "", CONCAT("'.Yii::$app->params['pics']['works']['path'].'mediumsbk-", `w`.`image`), "") as imgPath,
			`w`.`imageWidth2` as imgW, `w`.`imageHeight2` as imgH, `wc`.`imageTitle` as imgT,`wc`.`worksdesсsbk`,

			`wc`.`pH1` as title
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
            IF(`w`.`imageprtf` <> "", CONCAT("'.Yii::$app->params['pics']['works']['path'].'generalprtf-", `w`.`imageprtf`), "") as imgPath,
			`w`.`imageWidth2` as imgW, `w`.`imageHeight2` as imgH, `wc`.`imageTitle` as imgT,

			`wc`.`pH1` as title, `wc`.`pDescription`
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
