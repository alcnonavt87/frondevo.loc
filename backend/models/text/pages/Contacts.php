<?php
namespace backend\models\text\pages;

use Yii;
use yii\base\Model;
use corpsepk\yii2emt\EMTypograph;

/**
 * Contacts
 */

Class Contacts extends Model
{
    
    public function getPageByIdAndLang($id,$lang) {
        $query = Yii::$app->db->createCommand('SELECT
            `a`.`id`, `a`.`pShow`, `b`.`Url`,
            `b`.`pTitle`, `b`.`pDescription`, `b`.`pKeyWords`, `b`.`pH1`,
            `b`.`pMenuName`, `b`.`pBreadCrumbs`, `b`.`pContent`
			, `snVkontakte`, `snFacebook`, `snTwitter`, `snBahance`, `snInstagram`, `snBall`, `snPinterest`/*get*/
        FROM
            `pages` `a`, `content` `b`
        WHERE
            `a`.`id` = :id AND `a`.`id` = `b`.`pageId` AND `b`.`lang` = :lang')
        ->bindValue(':id', $id)
	->bindValue(':lang', $lang);
        
        return $query->queryAll();
    }
    
    public function getEmptyLangPageById($id)
    {
        $query = Yii::$app->db->createCommand('SELECT
        `a`.`id`, `a`.`pShow`, `b`.`Url`,
         "" AS `pTitle`, "" AS `pDescription`, "" AS `pKeyWords`, "" AS `pH1`, "" AS `pMenuName`, "" AS `pBreadCrumbs`, "" AS `pContent`
		FROM
            `pages` `a`, `content` `b`
        WHERE
             `a`.`id` = :id AND `a`.`id` = `b`.`pageId` AND `b`.`lang` = :lang')
        ->bindValue(':id', $id);
        
        return $query->queryAll();
    }

	public function editUpDatePage($pageId, $lang, $pTitle, $pDescription, $pKeyWords, $pH1, $pMenuName, $pBreadCrumbs, $pContent) {
        $EMTypograph = new EMTypograph();
        $EMTypograph->setup([
            'Text.paragraphs' => 'off',
            'OptAlign.oa_oquote' => 'off',
            'Nobr.spaces_nobr_in_surname_abbr' => 'off',
        ]);
        $EMTypograph->set_text($pTitle);
        $pTitle= $EMTypograph->apply();
        $EMTypograph->setup([
            'Text.paragraphs' => 'off',
            'OptAlign.oa_oquote' => 'off',
            'Nobr.spaces_nobr_in_surname_abbr' => 'off',
        ]);
        $EMTypograph->set_text($pDescription );
        $pDescription = $EMTypograph->apply();

        $EMTypograph->set_text($pH1 );
        $EMTypograph->setup([
            'Text.paragraphs' => 'off',
            'OptAlign.oa_oquote' => 'off',
            'Nobr.spaces_nobr_in_surname_abbr' => 'off',
        ]);
        $pH1 = $EMTypograph->apply();
        $query = Yii::$app->db->createCommand('UPDATE `content`
        SET `pTitle` = :pTitle, `pDescription` = :pDescription, `pKeyWords` = :pKeyWords, `pH1` = :pH1,
            `pMenuName` = :pMenuName, `pBreadCrumbs` = :pBreadCrumbs, `pContent` = :pContent
        WHERE `pageId` = :pageId AND `lang` = :lang')
        ->bindValue(':pageId', $pageId)
        ->bindValue(':lang', $lang)
        ->bindValue(':pTitle', $pTitle)
        ->bindValue(':pDescription', $pDescription)
        ->bindValue(':pKeyWords', $pKeyWords)
        ->bindValue(':pH1', $pH1)
        ->bindValue(':pMenuName', $pMenuName)
        ->bindValue(':pBreadCrumbs', $pBreadCrumbs)        
        ->bindValue(':pContent', $pContent);
        
        return $query->execute();
    }
	public function update($id, $postBase, $postContent, $lang) {
		$data = $postBase;
		
		if (isset($postContent)) {
			$data = array_merge($data, $postContent);
		}
		
		if (empty($data)) return false;
		
		$set = array();
		foreach ($data as $key => $item) {
			$set[] = '`'.$key.'`="'.addslashes($item).'"';
		}
		$set = implode(',', $set);
		
		$query = Yii::$app->db->createCommand('UPDATE
			`pages`, `content`
		SET
			'.$set.'
		WHERE
			`id` = :id AND
			`pageId` = `id` AND
			`lang` = :lang')
		->bindValue(':id', $id)
        ->bindValue(':lang', $lang);
		
		return $query->execute();
	}
    
    public function getAllLangs()
    {
        $query = Yii::$app->db->createCommand('SELECT l.sName, l.bName, l.fullName FROM langs l ORDER BY l.id ASC');
        return $query->queryAll();
    }
    
    public function getLangPageIs($id, $lang)
    {
        $query = Yii::$app->db->createCommand('SELECT count(*) AS `count`
           FROM
                content c
           WHERE
             c.pageId = :id
             AND c.lang = :lang')
        ->bindValue(':id', $id)
	->bindValue(':lang', $lang);
        
        $count = $query->queryOne();
        return $count['count'];
    }
    
    public function addLangPage($id, $lang)
    {
        $query = Yii::$app->db->createCommand('INSERT INTO `content`
            (`pageId`, `lang`, `pH1`, `pContent`) VALUES (:pageId, :lang, "", "")')
            ->bindValue(':pageId', $id)
            ->bindValue(':lang', $lang);
        
        return $query->execute();
    }
}// End     