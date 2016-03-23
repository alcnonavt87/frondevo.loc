<?php
namespace backend\models\settings;

use Yii;
use yii\base\Model;

/**
 * Settings
 */
class Settings extends Model
{
    public function getAllSettingsPages($id, $idPageGroup)
    {
        $query = Yii::$app->db->createCommand('SELECT COUNT(*) AS `count` FROM `user` u WHERE u.id = :id AND (u.role > 10 AND u.role < 50)')
            ->bindValue(':id', $id);

        $userRole = $query->queryOne();
        if($userRole['count']) {
            $query = Yii::$app->db->createCommand('SELECT COUNT(*) `count` FROM access_list al WHERE al.idUser = :id AND al.idPageGroup = :idPageGroup')
                ->bindValue(':id', $id)
                ->bindValue(':idPageGroup', $idPageGroup);

            $access = $query->queryOne();

            if(!$access['count']) {
                $query = Yii::$app->db->createCommand('SELECT sp.id, sp.settingsName FROM settings_pages sp WHERE sp.id = 0');
            } else {
                $query = Yii::$app->db->createCommand('SELECT sp.id, sp.settingsName FROM settings_pages sp ORDER BY sp.id ASC');
            }
        } else {
            $query = Yii::$app->db->createCommand('SELECT sp.id, sp.settingsName FROM settings_pages sp ORDER BY sp.id ASC');
        }
        
        return $query->queryAll();
    }
    
    public function getSettingsPageAdminClass($id)
    {
        $query = Yii::$app->db->createCommand('SELECT sp.adminClass FROM settings_pages sp WHERE sp.id = :id')
	->bindValue(':id', $id);
        
        $adminClass = $query->queryOne();
        if(isset($adminClass['adminClass'])) {
            return $adminClass['adminClass'];
        }
        return '';
    }
}
