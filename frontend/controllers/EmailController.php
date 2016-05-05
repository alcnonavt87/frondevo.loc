<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use frontend\models\Claims;
use vendor\UrlProvider\TextPagesUrlProvider;
use vendor\UrlProvider\SimpleModuleUrlProvider;

/**
 * Email controller
 */
class EmailController extends CommonController
{

	protected $myCommon;
	private $from;
	private $to;
	private $inputData;
	private $myClaims;
	private $myEmails;

	protected $lang;
	protected $firstUri;

	const DEBUGGING = 0;
	
	public function init() {
		parent::init();
		$this->myClaims = new Claims($this->lang);
		$this->hostName = $this->myCommon->getHostName();
		$this->from = Yii::$app->params['emails']['from'];
		$this->myEmails = explode(";",$this->myClaims->getEmails()[0]['emailClaim']);
		$this->to = $this->myEmails;
		$this->inputData = $_POST;


		// Язык
		$this->lang = $this->myCommon->getLang();
		// Настройка языкового окружения
        switch ($this->lang) {
            case 'en':
                Yii::$app->language = 'en-US';
                break;
            case 'ru':
                Yii::$app->language = 'ru-RU';
                break;
            case 'ua':
                Yii::$app->language = 'uk-UA';
                break;
            default :
                Yii::$app->language = 'en-US';
        }
	}

    public function actionIndex() {
        $isAjax = Yii::$app->getRequest()->isAjax;
        $emptyInputData = empty($this->inputData);

		// обозначаем условия неверного запроса
		// (пустой массив входящих данных (POST))
		$wrongRequest = $emptyInputData;//echo '<pre>';print_r($wrongRequest);echo '</pre>';exit;

		// и если запрос неверный, преращаем выполнение
		if ($wrongRequest) {
			throw new BadRequestHttpException();
		}

        //if (YII_ENV == 'dev' || $isAjax) {
			if ($this->firstUri == 'commercial') {
				echo $this->actionCommercial();
			} else {
				throw new BadRequestHttpException();
			}
		/*} else {
			throw new BadRequestHttpException();
		}*/
    }

	/**
	 * Заявка коммерческая (со страницы commercial)
	 */
    public function actionCommercial() {
		// раскладываем входящий массив данных на переменные
        extract($this->inputData);

		// сохраняем заявку в БД
		$this->myClaims->save($this->inputData);

		// инициализируем компонент отправки писем
		$message = Yii::$app->mailer->compose();

		// устанавливаем тему письма
		$subject = 'Request from frondevo.com';
		$message->setSubject($subject);

		// устанавливаем отправителя
		$message->setFrom($this->from);

		// устанавливаем получателя
		$message->setTo($this->to);

		// формируем содержание письма
          $referrer = Yii::$app->request->referrer;
		  $body = Yii::t('app', 'Name').": <b>{$name}</b><br>
           E-mail: <b>{$email}</b><br>
		  ".Yii::t('app', 'Phone').": <b>{$tel}</b><br>
          ".Yii::t('app', 'The contact person').": <b>{$contact}</b><br>
          ".Yii::t('app', 'Short description').": <b>{$desc}</b><br>"; //echo '<pre>';print_r($body);echo '</pre>';exit;
		  $message->setHtmlBody($body);


		// устанавливаем ответ на передачу письма
		$answer = Yii::t('app', 'Commercial request sent successfully.');

		// отправляем письмо
		$status= $message->send();

		$result = array(
			//'status' => isset($status) ? $status : 0,
			'message' => $answer
		);

		// возвращаемся на страницу объекта
		/*if (!self::DEBUGGING) {
			return $this->redirect($referrer);
		}*/

		$result = json_encode($result);
		echo $result;
    }
}
