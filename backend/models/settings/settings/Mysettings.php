<?php
namespace backend\models\settings\settings;

use Yii;
use yii\base\Model;

/**
 * Mysettings
 */
class Mysettings extends Model
{
    public function getSettings($lang) {
        $query = Yii::$app->db->createCommand('SELECT
			`sc`.`address`,
			`sc`.`copyright`,
			`s`.`emailCall`,
			`s`.`emailClaim`,
			`s`.`snVkontakte`,
			`s`.`snFacebook`,
			`s`.`snTwitter`
		FROM
			`settings` `s`
			LEFT JOIN `settings_content` `sc`
				ON `sc`.`idSettings` = `s`.`id` AND `sc`.`lang` = :lang')
            ->bindValue(':lang', $lang);

        return $query->queryOne();
    }

    public function upDateMySettings($fields, $lang) {
        extract($fields);

        $query = Yii::$app->db->createCommand('UPDATE
			`settings` `s`, `settings_content` `sc`
        SET
			`sc`.`address` = :address,
			`sc`.`copyright` = :copyright,
			`s`.`emailCall` = :emailCall,
			`s`.`emailClaim` = :emailClaim,
			`s`.`snVkontakte` = :snVkontakte,
			`s`.`snFacebook` = :snFacebook,
			`s`.`snTwitter` = :snTwitter
		WHERE
			`sc`.`idSettings` = `s`.`id` AND `sc`.`lang` = :lang')
            ->bindValue(':address', $address)
            ->bindValue(':copyright', $copyright)
            ->bindValue(':emailCall', $emailCall)
            ->bindValue(':emailClaim', $emailClaim)
            ->bindValue(':snVkontakte', $snVkontakte)
            ->bindValue(':snFacebook', $snFacebook)
            ->bindValue(':snTwitter', $snTwitter)
            ->bindValue(':lang', $lang);

        return $query->execute();
    }
}

