<?php
namespace backend\controllers\text\pages;

use Yii;
use backend\models\AdminOthers;
use backend\models\text\pages\Frontendout;


/**
 * FrontendoutEdit controller
 */
class FrontendoutEditController extends \backend\controllers\AdminController {
            
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

            $myTextPage = new Frontendout();
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

				// Множество текстовых полей "Виды клиентов"
				$ourclientslist = $myOthers->getManyFieldsElementMultiLangs('pages_ourclientslist', $idRecord, $pageLang);
				if (!$ourclientslist) {
					$ourclientslist = $myOthers->getManyFieldsElementEmpty();
				}

				// Множественные изображения "Лого наших клиентов"
				$imageourclientslogo = $myOthers->getImgManyMultiLangs('pages_imageourclientslogo', 'idPages', $idRecord, $pageLang);

				// Множественные изображения "Лого компаний"
				$imageourcompanieslogo = $myOthers->getImgManyMultiLangs('pages_imageourcompanieslogo', 'idPages', $idRecord, $pageLang);

				// Множество текстовых полей "Пункты сроков"
				$garanties1list = $myOthers->getManyFieldsElementMultiLangs('pages_garanties1list', $idRecord, $pageLang);
				if (!$garanties1list) {
					$garanties1list = $myOthers->getManyFieldsElementEmpty();
				}

				// Множество текстовых полей "Пункты поддержки"
				$garanties2list = $myOthers->getManyFieldsElementMultiLangs('pages_garanties2list', $idRecord, $pageLang);
				if (!$garanties2list) {
					$garanties2list = $myOthers->getManyFieldsElementEmpty();
				}


				// Группа чекбоксов "Выбор ссылок отображаемых в футере"
				$links = $myOthers->getChGrSourceIdsMultiLangs('links', 'title', $pageLang);
				$linksIds = $myOthers->getChGrTargetIds('pages_links', 'idPages', 'idLinks', $idRecord);

				// Группа чекбоксов "Выбор работ отображаемых на странице"
				$worksfrontout = $myOthers->getChGrSourceIdsMultiLangsforFrontout('worksfrontout', 'pH1', $pageLang);
				$worksfrontoutIds = $myOthers->getChGrTargetIds('pages_worksfrontout', 'idPages', 'idWorksfrontout', $idRecord);/* UpdateCode */



                $content = '';
                $navMenu = '';
                
                if (is_file(Yii::$app->basePath.'/views/pages/FrontendoutPageEditView.php')) {
                    require Yii::$app->basePath.'/views/pages/FrontendoutPageEditView.php';
                }

                return json_encode(['code' => '0', 'message' => '', 'content' => $content, 'navMenu' => $navMenu]);
            }
        }
    }
}
