<?php
namespace backend\controllers\text\pages;

use Yii;
use backend\models\AdminOthers;
use backend\models\text\pages\Sitesbykeys;


/**
 * SitesbykeysEdit controller
 */
class SitesbykeysEditController extends \backend\controllers\AdminController {
            
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

            $myTextPage = new Sitesbykeys();
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



				// Группа чекбоксов "Отображаемые работы"
				$works = $myOthers->getChGrSourceIdsMultiLangs('works', 'pTitle', $pageLang);
				$worksIds = $myOthers->getChGrTargetIds('pages_works', 'idPages', 'idWorks', $idRecord);

				// Множество текстовых полей "Пункты этапа"
				$sbkstagelist1 = $myOthers->getManyFieldsElementMultiLangs('pages_sbkstagelist1', $idRecord, $pageLang);
				if (!$sbkstagelist1) {
					$sbkstagelist1 = $myOthers->getManyFieldsElementEmpty();
				}

				// Множество текстовых полей "Пункты этапа"
				$sbkstagelist2 = $myOthers->getManyFieldsElementMultiLangs('pages_sbkstagelist2', $idRecord, $pageLang);
				if (!$sbkstagelist2) {
					$sbkstagelist2 = $myOthers->getManyFieldsElementEmpty();
				}

				// Множество текстовых полей "Пункты этапа"
				$sbkstagelist3 = $myOthers->getManyFieldsElementMultiLangs('pages_sbkstagelist3', $idRecord, $pageLang);
				if (!$sbkstagelist3) {
					$sbkstagelist3 = $myOthers->getManyFieldsElementEmpty();
				}

				// Множество текстовых полей "Пункты этапа"
				$sbkstagelist4 = $myOthers->getManyFieldsElementMultiLangs('pages_sbkstagelist4', $idRecord, $pageLang);
				if (!$sbkstagelist4) {
					$sbkstagelist4 = $myOthers->getManyFieldsElementEmpty();
				}

				// Множество текстовых полей "Пункты этапа"
				$sbkstagelist5 = $myOthers->getManyFieldsElementMultiLangs('pages_sbkstagelist5', $idRecord, $pageLang);
				if (!$sbkstagelist5) {
					$sbkstagelist5 = $myOthers->getManyFieldsElementEmpty();
				}

				// Множество текстовых полей "Пункты этапа"
				$sbkstagelist6 = $myOthers->getManyFieldsElementMultiLangs('pages_sbkstagelist6', $idRecord, $pageLang);
				if (!$sbkstagelist6) {
					$sbkstagelist6 = $myOthers->getManyFieldsElementEmpty();
				}

				

				// Множество текстовых полей "Пункты P.S."
				$sbkpslist = $myOthers->getManyFieldsElementMultiLangs('pages_sbkpslist', $idRecord, $pageLang);
				if (!$sbkpslist) {
					$sbkpslist = $myOthers->getManyFieldsElementEmpty();
				}

				// Группа чекбоксов "Ссылки"
				$links = $myOthers->getChGrSourceIdsMultiLangs('links', 'title', $pageLang);
				$linksIds = $myOthers->getChGrTargetIds('pages_links', 'idPages', 'idLinks', $idRecord);/* UpdateCode */

                $content = '';
                $navMenu = '';
                
                if (is_file(Yii::$app->basePath.'/views/pages/SitesbykeysPageEditView.php')) {
                    require Yii::$app->basePath.'/views/pages/SitesbykeysPageEditView.php';
                }

                return json_encode(['code' => '0', 'message' => '', 'content' => $content, 'navMenu' => $navMenu]);
            }
        }
    }
}
