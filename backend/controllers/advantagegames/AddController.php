<?php
namespace backend\controllers\advantagegames;

use Yii;
use backend\models\AdminOthers;
use backend\models\advantagegames\Advantagegames;

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
			$myAdvantagegames = new Advantagegames();
			
			$myOthers->clearTempDir();
			$_SESSION['images'] = [];
			

			// Получаем запись
            $advantagegamesItem = $myAdvantagegames->getEmpty();//echo '<pre>';print_r($advantagegamesItem);echo '</pre>';exit;

			//Навигационное меню
			$langs = $myOthers->getAllLangs();

			// Множество текстовых полей "Перечень преимуществ"
			$list = $myOthers->getManyFieldsElementEmpty();/* UpdateCode */


			$content = '';
			$navMenu = '';

			if (is_file(Yii::$app->basePath.'/views/pages/AdvantagegamesEditView.php')) {
				require Yii::$app->basePath.'/views/pages/AdvantagegamesEditView.php';
			}

			return json_encode(['code' => '0', 'message' => '', 'content' => $content, 'navMenu' => $navMenu]);
        } else {
            throw new HTTP_Exception_404('Нет такой страницы.');
        }
    }
}