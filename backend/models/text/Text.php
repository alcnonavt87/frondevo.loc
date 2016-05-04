<?php
namespace backend\models\text;

use Yii;
use yii\base\Model;

/**
 * Text
 */
class Text extends Model
{
    
    public function getAllTextPages($lang, $idPageGroup)
    {
         $query = Yii::$app->db->createCommand('SELECT p.id, p.pShow, p.pAlias, IFNULL(c.pH1, "---") AS `pH1` 
            FROM pages p LEFT JOIN content c ON p.id = c.pageId AND c.lang = :lang 
            WHERE p.idPageGroup = :idPageGroup AND p.ignoreListTable <> 1
            ORDER BY p.id')
	->bindValue(':lang', $lang)
        ->bindValue(':idPageGroup', $idPageGroup); 
        
        return $query->queryAll();
    }
    
    public function getTextPageAdminClass($id)
    {
        $query = Yii::$app->db->createCommand('SELECT p.adminClass FROM pages p WHERE p.id = :id')
	->bindValue(':id', $id);
        
        $adminClass = $query->queryOne();
        return $adminClass["adminClass"];
    }
    
    public function upDateProperty($id, $name, $value)
    {      
        $query = Yii::$app->db->createCommand()->update('pages', [$name => $value], 'id = :id', [':id' => $id]);
        return $query->execute();
    }
    
}    