<?php
namespace backend\controllers\text\pages;

use Yii;
use backend\models\AdminOthers;
use backend\models\text\pages\Contacts;


/**
 * ContactsEdit controller
 */
class ContactsEditController extends \backend\controllers\AdminController {
            
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

            $myTextPage = new Contacts();
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
                $textPageHeader = $myOthers->getTextPageHeader($idPage, $defLang);/* UpdateCode */

                $content = '';
                $navMenu = '';
                
                if (is_file(Yii::$app->basePath.'/views/pages/ContactsPageEditView.php')) {
                    require Yii::$app->basePath.'/views/pages/ContactsPageEditView.php';
                }

                return json_encode(['code' => '0', 'message' => '', 'content' => $content, 'navMenu' => $navMenu]);
            }
        }
    }
}
