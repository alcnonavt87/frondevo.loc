<?php
namespace backend\controllers\text\pages;

use Yii;
use backend\models\AdminOthers;
use backend\models\text\pages\Psd2html5;


/**
 * Psd2html5Edit controller
 */
class Psd2html5EditController extends \backend\controllers\AdminController {
            
    public function actionIndex()
    {
        $isAjax = Yii::$app->request->isAjax;

        if (!$isAjax) {
            throw new BadRequestHttpException();
        } else {
            $id1Uri = $idPageGroup = Yii::$app->request->get('id');
            $idPage = $idRecord = Yii::$app->request->get('id2');
            $pageLang = Yii::$app->request->get('id3');
            
            $admPanelUri = Yii::$app->homeUrl;
            $defLang = Yii::$app->params['defLang'];
			
            $myOthers = new AdminOthers();
			$myOthers->clearTempDir();
			$_SESSION['images'] = [];

            $myTextPage = new Psd2html5();
            $page = $myTextPage->getPageByIdAndLang($idPage, $pageLang);//echo '<pre>';print_r($page);echo '</pre>';exit;

            if(count($page) == 0) {
                $page = $myTextPage->getEmptyLangPageById($idPage);
            }

            if  (isset($page[0])) {
                $pagesItem = $page[0];
				
				//Навигационное меню
                $langs = $myTextPage->getAllLangs();

                //Хлебные крошки
                $pageGroupData = $myOthers->getPageGroupData($id1Uri);
                $textPageHeader = $myOthers->getTextPageHeader($idPage, $defLang);

				// Группа чекбоксов "Выбор ссылок отображаемых в футере"
				$links = $myOthers->getChGrSourceIdsMultiLangs('links', 'title', $pageLang);
				$linksIds = $myOthers->getChGrTargetIds('pages_links', 'idPages', 'idLinks', $idRecord);

				// Группа чекбоксов "Выбор работ отображаемых на странице"
				$worksfrontout = $myOthers->getChGrSourceIdsMultiLangs('worksfrontout', 'pH1', $pageLang);
				$worksfrontoutIds_100 = $myOthers->getChGrTargetIds('pages_worksfrontout', 'idPages', 'idWorksfrontout', 100);
                $worksfrontoutIds_101 = $myOthers->getChGrTargetIds('pages_worksfrontout', 'idPages', 'idWorksfrontout', 101);
                $worksfrontoutIds_102 = $myOthers->getChGrTargetIds('pages_worksfrontout', 'idPages', 'idWorksfrontout', 102);
                $worksfrontoutIds_103 = $myOthers->getChGrTargetIds('pages_worksfrontout', 'idPages', 'idWorksfrontout', 103);/* UpdateCode */

                // Ссылка на преимущества
                $advPageGroupData = $myOthers->getPageGroupDataByMarkI('Наши преимущества для PSTtoHTML', ['id', 'groupName']);

                $content = '';
                $navMenu = '';
                
                if (is_file(Yii::$app->basePath.'/views/pages/Psd2html5PageEditView.php')) {
                    require Yii::$app->basePath.'/views/pages/Psd2html5PageEditView.php';
                }

                return json_encode(['code' => '0', 'message' => '', 'content' => $content, 'navMenu' => $navMenu]);
            }
        }
    }
}
