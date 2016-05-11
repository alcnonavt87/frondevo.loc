<?php
namespace backend\controllers\advantagepsdhmtl5;

use Yii;
use backend\models\AdminOthers;
use backend\models\advantagepsdhmtl5\Advantagepsdhmtl5;

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
			$myAdvantagepsdhmtl5 = new Advantagepsdhmtl5();
			
			$myOthers->clearTempDir();
			$_SESSION['images'] = [];

			// Получаем запись
            $advantagepsdhmtl5Item = $myAdvantagepsdhmtl5->get($idRecord, $pageLang);//echo '<pre>';print_r($advantagepsdhmtl5Item);echo '</pre>';exit;

			if (!empty($advantagepsdhmtl5Item)) {
				//Навигационное меню
                $langs = $myOthers->getAllLangs();
				

				// Множество текстовых полей "Перечень преимуществ"
				$list = $myOthers->getManyFieldsElementMultiLangs('advantagepsdhmtl5_list', $idRecord, $pageLang);
				if (!$list) {
					$list = $myOthers->getManyFieldsElementEmpty();
				}/* UpdateCode */


				$content = '';
                $navMenu = '';

                if (is_file(Yii::$app->basePath.'/views/pages/Advantagepsdhmtl5EditView.php')) {
                    require Yii::$app->basePath.'/views/pages/Advantagepsdhmtl5EditView.php';
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