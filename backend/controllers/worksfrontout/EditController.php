<?php
namespace backend\controllers\worksfrontout;

use Yii;
use backend\models\AdminOthers;
use backend\models\worksfrontout\Worksfrontout;

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
			$myWorksfrontout = new Worksfrontout();
			
			$myOthers->clearTempDir();
			$_SESSION['images'] = [];

			// Получаем запись
            $worksfrontoutItem = $myWorksfrontout->get($idRecord, $pageLang);//echo '<pre>';print_r($worksfrontoutItem);echo '</pre>';exit;

			if (!empty($worksfrontoutItem)) {
				//Навигационное меню
                $langs = $myOthers->getAllLangs();
				

				// Множество текстовых полей "Перечень пунктов описания работы"
				$descrworksfrontoutlist = $myOthers->getManyFieldsElementMultiLangs('worksfrontout_descrworksfrontoutlist', $idRecord, $pageLang);
				if (!$descrworksfrontoutlist) {
					$descrworksfrontoutlist = $myOthers->getManyFieldsElementEmpty();
				}/* UpdateCode */


				$content = '';
                $navMenu = '';

                if (is_file(Yii::$app->basePath.'/views/pages/WorksfrontoutEditView.php')) {
                    require Yii::$app->basePath.'/views/pages/WorksfrontoutEditView.php';
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