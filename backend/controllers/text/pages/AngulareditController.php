<?php
namespace backend\controllers\text\pages;

use Yii;
use backend\models\AdminOthers;
use backend\models\text\pages\Angular;


/**
 * AngularEdit controller
 */
class AngularEditController extends \backend\controllers\AdminController {
            
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

            $myTextPage = new Angular();
            $page = $myTextPage->getPageByIdAndLang($idPage, $pageLang);
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

				// Множество текстовых полей "Пункты поддержки"
				$causesAngularlist = $myOthers->getManyFieldsElementMultiLangs('pages_causesAngularlist', $idRecord, $pageLang);
				if (!$causesAngularlist) {
					$causesAngularlist = $myOthers->getManyFieldsElementEmpty();
				}

				// Множество текстовых полей "Пункты поддержки"
				$causesAngularlist1 = $myOthers->getManyFieldsElementMultiLangs('pages_causesAngularlist1', $idRecord, $pageLang);
				if (!$causesAngularlist1) {
					$causesAngularlist1 = $myOthers->getManyFieldsElementEmpty();
				}

				// Группа чекбоксов "Выбор ссылок отображаемых в футере"
				$links = $myOthers->getChGrSourceIdsMultiLangs('links', 'title', $pageLang);
				$linksIds = $myOthers->getChGrTargetIds('pages_links', 'idPages', 'idLinks', $idRecord);

				// Группа чекбоксов "Выбор работ отображаемых на странице"
				$worksfrontout = $myOthers->getChGrSourceIdsMultiLangs('worksfrontout', 'pH1', $pageLang);
				$worksfrontoutIds = $myOthers->getChGrTargetIds('pages_worksfrontout', 'idPages', 'idWorksfrontout', $idRecord);/* UpdateCode */

                $content = '';
                $navMenu = '';
                
                if (is_file(Yii::$app->basePath.'/views/pages/AngularPageEditView.php')) {
                    require Yii::$app->basePath.'/views/pages/AngularPageEditView.php';
                }

                return json_encode(['code' => '0', 'message' => '', 'content' => $content, 'navMenu' => $navMenu]);
            }
        }
    }
}
