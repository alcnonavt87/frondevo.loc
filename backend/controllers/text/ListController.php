<?php
namespace backend\controllers\text;

use Yii;
use backend\models\AdminOthers;
use backend\models\text\Text;

/**
 * List controller
 */

class ListController extends \backend\controllers\AdminController
{
            
    public function actionIndex()
    {
        $isAjax = Yii::$app->getRequest()->isAjax;

        if (!$isAjax) {
            throw new BadRequestHttpException();
        } else {
            $id1Uri = Yii::$app->getRequest()->get('id');
            $pageLang = Yii::$app->getRequest()->get('id2');

            $myText = new Text();
            $allTextPages = $myText->getAllTextPages($pageLang, $id1Uri);

            $myOthers = new AdminOthers();
            $pageGroupData = $myOthers->getPageGroupData($id1Uri);

			// Добавляем необходимые пункты вручную
			$listTableItems = [];
			// Ход строительства
			$listTableItem = [];
			$listTableItem['id'] = 9;
			$listTableItem['pShow'] = 1;
			$listTableItem['pAlias'] = 'portfolio';
			$listTableItem['pH1'] = 'Портфолио';
			$listTableItem['pageGroup'] = 1;
			$listTableItem['location'] = 'before';
			$listTableItems['Сайты под ключ'][] = $listTableItem;
			foreach ($listTableItems[$pageGroupData[0]['groupName']] as $listTableItem) {
				$locateBefore = ($listTableItem['location'] == 'before');
				if ($locateBefore) {
					array_unshift($allTextPages, $listTableItem);
				} else {
					$allTextPages[] = $listTableItem;
				}
			}//echo '<pre>';print_r($allTextPages);echo '</pre>';exit;

			// Для ссылки "Редактировать страницу"
			$textPageIsset = ['Сайты под ключ'];
			$textPageData = in_array($pageGroupData[0]['groupName'], $textPageIsset)
				? $myOthers->getTextPageDataByMarkI($pageGroupData[0]['groupName'], ['id', 'idPageGroup'])
				: null;

            $content = '';
            
            if (is_file(Yii::$app->basePath.'/views/pages/TextListView.php')) {
                require Yii::$app->basePath.'/views/pages/TextListView.php';
            }

            return json_encode(['code' => '0', 'message' => '', 'content' => $content]);
        }
    }
}        
