<?php
namespace backend\controllers\advantagepsdhmtl5;

use Yii;
use backend\models\AdminOthers;
use backend\models\advantagepsdhmtl5\Advantagepsdhmtl5;

class ListController extends \backend\controllers\AdminController
{
	public function actionIndex()
	{
        $isAjax = Yii::$app->getRequest()->isAjax;

        if ($isAjax) {
			$id1Uri = $idPageGroup = Yii::$app->getRequest()->get('id');
			$id2Uri = $pageLang = Yii::$app->getRequest()->get('id2');

			if (!$pageLang) {
				$pageLang = Yii::$app->params['defLang'];
			}

			$limit = Yii::$app->getRequest()->get('limit', 20);
			$offset = 0;// limit
			$filters = Yii::$app->getRequest()->get('filters', [
				// filter
			]);
            $page = Yii::$app->getRequest()->get('page', 1);

			$myOthers = new AdminOthers();
			$myAdvantagepsdhmtl5 = new Advantagepsdhmtl5();
			

			// Подготавливаем данные для хлебных крошек
			$pageGroupData = $myOthers->getPageGroupDataI($idPageGroup, ['groupName']);/* UpdateCode */

			// Получаем записи
			$advantagepsdhmtl5 = $myAdvantagepsdhmtl5->getMany($filters, $limit, $offset, $pageLang);//echo '<pre>';print_r($advantagepsdhmtl5);echo '</pre>';exit;


			$content = '';

            if (is_file(Yii::$app->basePath.'/views/pages/Advantagepsdhmtl5ListView.php')) {
                require Yii::$app->basePath.'/views/pages/Advantagepsdhmtl5ListView.php';
            }

            $json_data = json_encode(['code' => '0', 'message' => '', 'content' => $content]);
            return $json_data;
        } else {
            throw new CHttpException(404, 'Нет такой страницы.');
        }
    }
}