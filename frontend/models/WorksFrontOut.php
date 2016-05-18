<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Works model
 */
class WorksFrontOut extends Model
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
			`worksfrontout` `w`
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
            IF(`w`.`image` <> "", CONCAT("'.Yii::$app->params['pics']['worksfrontout']['path'].'preview-", `w`.`image`), "") as imgPath,
			`w`.`imageWidth2` as imgW, `w`.`imageHeight2` as imgH, `wc`.`imageTitle` as imgT,

			`wc`.`pH1` as title, `wc`.`description`
			'.$fields.'
		FROM
			`worksfrontout` `w`
			LEFT JOIN `worksfrontout_content` `wc`
				ON `wc`.`idWorksfrontout` = `w`.`id` AND `wc`.`lang` = :lang
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
            $join .= ' JOIN `filtersfrontoutport` `f`
				ON `f`.`id` = `w`.`idFiltersfrontoutport` AND `f`.`url` = :pUrl';
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
            `wc`.`pTitle`, `wc`.`pDescription`, `wc`.`pH1`, `wc`.`pContent` as content,`wc`.`linkworksfrontout`
     FROM
            `worksfrontout` `w`, `worksfrontout_content` `wc`
        WHERE
            `w`.`pUrl` = :pUrl AND
			`wc`.`idWorksfrontout` = `w`.`id` AND
			`wc`.`lang` = :lang')
            ->bindValue(':pUrl', $pUrl)
            ->bindValue(':lang', $this->lang);

        $result = $query->queryOne();

        if ($result) {
            // информация из множественных полей
            foreach ($result as $key => $item) {
                $data = $this->getMultiFieldsData($result['id']);
                $result['desclist'] =  $data;
            }
        }
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

    public function getLinksItem($id) {
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
			JOIN `works_links` `wl`
				ON `wl`.`idLinks` = `l`.`id`AND `wl`.`idWorks` = :id
		ORDER BY
			`l`.`order`')
            ->bindValue(':lang', $this->lang)
            ->bindValue(':id', $id);

        //echo '<pre>';print_r($query);echo '</pre>';exit;
        $result = $query->queryAll();

        return $result;
    }





    public function getWorksForFrontendOut($alias, $params=[]) {
        // запрос
        $query = Yii::$app->db->createCommand('SELECT
            `w`.`id`,
			`wc`.`pTitle`

		FROM
			`worksfrontout` `w`
			LEFT JOIN `worksfrontout_content` `wc`
				ON `wc`.`idWorksfrontout` = `w`.`id` AND `wc`.`lang` = :lang
			LEFT JOIN `pages_frontendoutworks` `p`
				ON `p`.`idFrontendoutworks` = `w`.`id`
			JOIN `pages` `p2`
				ON `p2`.`id` = `p`.`idPages` AND `p2`.`pAlias` = :alias
		ORDER BY
			`w`.`id`')
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
        $orderBy = '`w`.`order`,`w`.`dateCreated` DESC';
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
             IF(`w`.`imageworksfrontout` <> "", CONCAT("'.Yii::$app->params['pics']['worksfrontout']['path'].'general-", `w`.`imageworksfrontout`), "") as imgPath,
			`wc`.`pH1` as title, `wc`.`pDescription`
			'.$fields.'
		FROM
			`worksfrontout` `w`
			LEFT JOIN `worksfrontout_content` `wc`
				ON `wc`.`idWorksfrontout` = `w`.`id` AND `wc`.`lang` = :lang
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

        if ($result) {
            // информация из множественных полей
            foreach ($result as $key => $item) {
                $data = $this->getMultiFieldsData($result[$key]['id']);
                $result[$key]['desclist'] =  $data;
            }
        }
        return $result;
    }

    public function getMultiFieldsData($itemId) {
        $query = Yii::$app->db->createCommand('SELECT
			`pe`.`text`
		FROM
			`worksfrontout_descrworksfrontoutlist` `pe`, `worksfrontout` `p`
		WHERE
			`pe`.`idRel` = `p`.`id` AND
			`p`.`id` = ' . $itemId . ' AND
			`pe`.`lang` = :lang')
            ->bindValue(':lang', $this->lang);

        $result = $query->queryAll();

        $emptyResult = (count($result) == 1 && $result[0]['text'] == '');
        $result = !$emptyResult ? $result : [];
        return $result;
    }

}
