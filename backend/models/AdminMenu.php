<?php
namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * AdminMenu
 */
class AdminMenu extends Model
{
    public function getUrl($id)
    {
        $query = Yii::$app->db->createCommand('select p.pUrl from pages p where p.id = :id')
        ->bindValue(':id', $id);
        
        $pUrl = $query->queryOne();
        if($pUrl) {
            return $pUrl;
        } else {
            return '';
        }
    }
    
    public function getPageGroup($idUser)
    {
        $query = Yii::$app->db->createCommand('SELECT COUNT(*) AS `count`
        FROM `user` u 
        WHERE u.id = :id AND (u.role > :roleMin AND u.role < :roleMax)')
        ->bindValue(':id', $idUser)
        ->bindValue(':roleMin', 10)
        ->bindValue(':roleMax', 50);        
        
        $manager = $query->queryOne();
        
        if($manager['count']) {
            $query = Yii::$app->db->createCommand('SELECT distinct p.id, p.groupName, p.cssKlass, p.addParam, p.quickButton, p.picking
            FROM pagegroup p, access_list al
            WHERE (p.groupLevel = 1 AND p.idParentGroup = 0 AND p.id = al.idPageGroup AND al.idUser = :idUser AND p.ignoreMenu <> 1
					-- AND p.hide = 0
				)
                  OR (p.adminClass = "Controller_Admin_Settings")
            ORDER BY p.picking ASC')
            ->bindValue(':idUser', $idUser);   
        } else {
            $query = Yii::$app->db->createCommand('SELECT p.id, p.groupName, p.cssKlass, p.addParam, p.quickButton, p.picking
            FROM pagegroup p 
            WHERE p.groupLevel = 1 AND p.idParentGroup = 0 AND p.ignoreMenu <> 1
			-- AND p.hide = 0
            ORDER BY p.picking ASC');
        }

        return $query->queryAll();
    }
}
