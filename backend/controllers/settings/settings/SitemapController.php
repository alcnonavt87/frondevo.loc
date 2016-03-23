<?php 
namespace backend\controllers\settings\settings;

use Yii;
use vendor\SitemapBuilder\SitemapBuilder;

/**
 * Sitemap controller
 */
class SitemapController extends \backend\controllers\AdminController
{
        
    public function actionIndex()
    {
        $isAjax = Yii::$app->getRequest()->isAjax;

        if (!$isAjax) {
            throw new BadRequestHttpException();
        } else {
            $id1Uri = Yii::$app->getRequest()->get('id');
            $settingsPageUri = Yii::$app->getRequest()->get('id2');
            $pageLang = Yii::$app->getRequest()->get('id3');

            $sitemapBuilder = new SitemapBuilder($pageLang);
			$result = $sitemapBuilder->build();
            
			if ($result) {
                $json_data = json_encode(['code' => '0', 'message' => 'Удачно обновлён файл "sitemap.xml"']);
            } else {
                $json_data = json_encode(['code' => '01201', 'message' => 'Ошибка записи в файл "sitemap.xml"']);
            }

            echo $json_data;
        }
    }
}