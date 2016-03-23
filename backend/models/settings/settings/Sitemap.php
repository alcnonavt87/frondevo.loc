<?php
namespace backend\models\settings\settings;

use Yii;
use yii\base\Model;

/**
 * Sitemap
 */
Class Sitemap extends Model {

    //получить данные страницы
    function newSiteMapUris() {
        $query = Yii::$app->db->createCommand('SELECT p.pUrl, p.priority, p.changefreq 
            FROM
              pages p
            WHERE
              p.parentId = 1 AND p.pShow = 1');
        
        $uris = $query->queryAll();

        return $uris;
    }
}

?>