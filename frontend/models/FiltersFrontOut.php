<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Filters model
 */
class FiltersFrontOut extends Model
{
    private $lang;

    function __construct($lang) {
        $this->lang = $lang;
    }
    public function getListforPsdHtml($params=[]) {
        $fields = '';
        $join = '';
        $where = '';
        $orderBy = '`f`.`order`';
        $pUrl = '';

        // условия
        $criteria = $this->getCriteria($params);
        $fields .= $criteria['fields'];
        $join .= $criteria['join'];
        $where .= $criteria['where'];
        $pUrl .= $criteria['pUrl'];

        // сортировка
        if (isset($params['sorting'])) {

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
            `pw`.`idPages`, `f`.`id`, `f`.`url`,
			`fc`.`title`
			'.$fields.'
		FROM
			`pages_worksfrontout` `pw`
			LEFT JOIN `filterspsdhtml` `f`
			ON `f`.`id` = `pw`.`idPages`
			LEFT JOIN `filterspsdhtml_content` `fc`
				ON `fc`.`idFilterspsdhtml` = `f`.`id` AND `fc`.`lang` = :lang
			'.$join.'
		WHERE
			`f`.`show` <> 0'.$where.'
		GROUP BY `idPages`
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
     * Список новостей
     */
    public function getList($params=[]) {
        $fields = '';
        $join = '';
        $where = '';
        $orderBy = '`f`.`order`';
        $pUrl = '';

        // условия
        $criteria = $this->getCriteria($params);
        $fields .= $criteria['fields'];
        $join .= $criteria['join'];
        $where .= $criteria['where'];
        $pUrl .= $criteria['pUrl'];

        // сортировка
        if (isset($params['sorting'])) {

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
            `f`.`id`, `f`.`url`,
			`fc`.`pTitle`
			'.$fields.'
		FROM
			`filtersfrontoutport` `f`
			LEFT JOIN `filtersfrontoutport_content` `fc`
				ON `fc`.`idFiltersfrontoutport` = `f`.`id` AND `fc`.`lang` = :lang
			'.$join.'
		WHERE
			`f`.`show` <> 0'.$where.'
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

        return [
            'fields' => $fields,
            'join' => $join,
            'where' => $where,
            'pUrl' => $pUrl,
        ];
    }

    /**
     * Проверка является ли uri третьего уровня uri фильтра
     */
    public function isFilterUri($url) {
        // запрос
        $query = Yii::$app->db->createCommand('SELECT
            COUNT(`f`.`id`)
		FROM
			`filtersfrontoutport` `f`
		WHERE
			`f`.`url` = :url')
            ->bindValue(':url', $url);

        //echo '<pre>';print_r($query);echo '</pre>';exit;
        $result = $query->queryScalar();

        return (bool)$result;
    }
    public function isFilterUriPdshtml($url) {
        // запрос
        $query = Yii::$app->db->createCommand('SELECT
            COUNT(`f`.`id`)
		FROM
			`filterspsdhtml` `f`
		WHERE
			`f`.`url` = :url')
            ->bindValue(':url', $url);

        //echo '<pre>';print_r($query);echo '</pre>';exit;
        $result = $query->queryScalar();

        return (bool)$result;
    }
}
