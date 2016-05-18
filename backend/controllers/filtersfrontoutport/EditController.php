<?php
namespace backend\controllers\filtersfrontoutport;

use Yii;
use backend\models\AdminOthers;
use backend\models\filtersfrontoutport\Filtersfrontoutport;

class EditController extends  \backend\controllers\AdminController
{
	public function actionIndex()
	{
        $isAjax = Yii::$app->getRequest()->isAjax;

        if ($isAjax) {
            $id1Uri = $idPageGroup = Yii::$app->getRequest()->get('id');
            $id2Uri = $idRecord = Yii::$app->getRequest()->get('id2');
			$id3Uri = $pageLang = Yii::$app->getRequest()->get('id3');
			
			if (!$pageLang) {
				$pageLang = Yii::$app->params['defLang'];
			}

			$myOthers = new AdminOthers();
			$myFiltersfrontoutport = new Filtersfrontoutport();
			
			$myOthers->clearTempDir();
			$_SESSION['images'] = [];

			// Получаем запись
            $filtersfrontoutportItem = $myFiltersfrontoutport->get($idRecord, $pageLang);//echo '<pre>';print_r($filtersfrontoutportItem);echo '</pre>';exit;

			if (!empty($filtersfrontoutportItem)) {
				//Навигационное меню
                $langs = $myOthers->getAllLangs();
				/* UpdateCode */


				$content = '';
                $navMenu = '';

                if (is_file(Yii::$app->basePath.'/views/pages/FiltersfrontoutportEditView.php')) {
                    require Yii::$app->basePath.'/views/pages/FiltersfrontoutportEditView.php';
                }

                return json_encode(['code' => '0', 'message' => '', 'content' => $content, 'navMenu' => $navMenu]);
            } else {
                return json_encode(['code' => '00202', 'message' => 'Запись не найдена', 'content' => '', 'navMenu' => '']);
            }
        } else {
            throw new HTTP_Exception_404('Нет такой страницы.');
        }
    }
}