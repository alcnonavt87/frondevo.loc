<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 16.05.2016
 * Time: 14:05
 */

namespace frontend\models;
use Yii;
use yii\base\Model;

class AdvantagesGames extends Model



{
    private $lang;

    function __construct($lang)
    {
        $this->lang = $lang;
    }

    public function getAdvantagesFromMultiField($multifields=[]) {


        $query = Yii::$app->db->createCommand('SELECT
			 `a`.`id`, `c`.`title`,`c`.`paragraph`
		FROM
				`advantagegames` `a`
			LEFT JOIN `advantagegames_content` `c`
				ON `c`.`idAdvantagegames` = `a`.`id` AND `c`.`lang` = :lang')

            ->bindValue(':lang', $this->lang);

        $result = $query->queryAll();

        if ($result) {
            // информация из множественных полей
            foreach ($result as $key => $item) {
                $data = $this->getMultiFieldsData($result[$key]['id']);
                $result[$key]['advlist'] =  $data;
            }
        }
        return $result;
    }

    public function getMultiFieldsData($itemId) {
        $query = Yii::$app->db->createCommand('SELECT
			`pe`.`text`
		FROM
			`advantagegames_list` `pe`, `advantagegames` `p`
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
