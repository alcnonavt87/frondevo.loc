<?php
namespace backend\controllers\works;

use Yii;
use backend\models\AdminOthers;
use backend\models\works\Works;

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
			$myWorks = new Works();
			
			$myOthers->clearTempDir();
			$_SESSION['images'] = [];
			

			// Получаем запись
            $worksItem = $myWorks->getEmpty();//echo '<pre>';print_r($worksItem);echo '</pre>';exit;

			//Навигационное меню
			$langs = $myOthers->getAllLangs();

			// Селект "Фильтр"
			$filters = $myOthers->getSelectOptionsMultiLangs('filters', 'title', $pageLang);

			// Множество текстовых полей "Пункты результата"
			$resultlist1 = $myOthers->getManyFieldsElementEmpty();/* UpdateCode */


			$content = '';
			$navMenu = '';

			if (is_file(Yii::$app->basePath.'/views/pages/WorksEditView.php')) {
				require Yii::$app->basePath.'/views/pages/WorksEditView.php';
			}

			return json_encode(['code' => '0', 'message' => '', 'content' => $content, 'navMenu' => $navMenu]);
        } else {
            throw new HTTP_Exception_404('Нет такой страницы.');
        }
    }
}