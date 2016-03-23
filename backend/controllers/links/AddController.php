<?php
namespace backend\controllers\links;

use Yii;
use backend\models\AdminOthers;
use backend\models\links\Links;

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
			$myLinks = new Links();
			
			$myOthers->clearTempDir();
			$_SESSION['images'] = [];
			

			// Получаем запись
            $linksItem = $myLinks->getEmpty();//echo '<pre>';print_r($linksItem);echo '</pre>';exit;

			//Навигационное меню
			$langs = $myOthers->getAllLangs();
				

			// Селект "Текстовая страница"
			$textpages = $myOthers->getSelectTextpagesOptionsMultiLangs('pages', 'pH1', $pageLang);/* UpdateCode */


			$content = '';
			$navMenu = '';

			if (is_file(Yii::$app->basePath.'/views/pages/LinksEditView.php')) {
				require Yii::$app->basePath.'/views/pages/LinksEditView.php';
			}

			return json_encode(['code' => '0', 'message' => '', 'content' => $content, 'navMenu' => $navMenu]);
        } else {
            throw new HTTP_Exception_404('Нет такой страницы.');
        }
    }
}