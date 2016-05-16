<?php
namespace backend\controllers\advantageanimations;

use Yii;
use backend\models\AdminOthers;
use backend\models\advantageanimations\Advantageanimations;

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
			$myAdvantageanimations = new Advantageanimations();
			
			$myOthers->clearTempDir();
			$_SESSION['images'] = [];
			

			// Получаем запись
            $advantageanimationsItem = $myAdvantageanimations->getEmpty();//echo '<pre>';print_r($advantageanimationsItem);echo '</pre>';exit;

			//Навигационное меню
			$langs = $myOthers->getAllLangs();

			// Множество текстовых полей "Перечень преимуществ"
			$list = $myOthers->getManyFieldsElementEmpty();/* UpdateCode */


			$content = '';
			$navMenu = '';

			if (is_file(Yii::$app->basePath.'/views/pages/AdvantageanimationsEditView.php')) {
				require Yii::$app->basePath.'/views/pages/AdvantageanimationsEditView.php';
			}

			return json_encode(['code' => '0', 'message' => '', 'content' => $content, 'navMenu' => $navMenu]);
        } else {
            throw new HTTP_Exception_404('Нет такой страницы.');
        }
    }
}