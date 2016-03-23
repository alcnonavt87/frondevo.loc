<?php
namespace backend\controllers\filters;

use Yii;
use backend\models\AdminOthers;
use backend\models\filters\Filters;

class AddController extends  \backend\controllers\AdminController
{
	public function actionIndex()
	{
        $isAjax = Yii::$app->getRequest()->isAjax;

        if ($isAjax) {
			$id1Uri = $idPageGroup = Yii::$app->getRequest()->get('id');
			$idRecord = 0;
			$id2Uri = $pageLang = Yii::$app->getRequest()->get('id2');

			if (!$pageLang) {
				$pageLang = Yii::$app->params['defLang'];
			}

			$myOthers = new AdminOthers();
			$myFilters = new Filters();
			
			$myOthers->clearTempDir();
			$_SESSION['images'] = [];
			

			// Получаем запись
            $filtersItem = $myFilters->getEmpty();//echo '<pre>';print_r($filtersItem);echo '</pre>';exit;

			//Навигационное меню
			$langs = $myOthers->getAllLangs();/* UpdateCode */


			$content = '';
			$navMenu = '';

			if (is_file(Yii::$app->basePath.'/views/pages/FiltersEditView.php')) {
				require Yii::$app->basePath.'/views/pages/FiltersEditView.php';
			}

			return json_encode(['code' => '0', 'message' => '', 'content' => $content, 'navMenu' => $navMenu]);
        } else {
            throw new HTTP_Exception_404('Нет такой страницы.');
        }
    }
}