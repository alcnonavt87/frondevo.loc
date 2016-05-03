<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Claims model
 */
class Claims extends Model
{
	private $lang;

	function __construct($lang)
	{
		$this->lang = $lang;
	}

	/**
	 * Список заявок
	 */
	public function getList($params = [])
	{
		$fields = '';
		$join = '';
		$where = '1';
		$orderBy = '`c`.`id`';
		$pUrl = '';
		$url = '';
		$url2 = '';

		// условия
		$criteria = $this->getCriteria($params);
		$fields .= $criteria['fields'];
		$join .= $criteria['join'];
		$where .= $criteria['where'];
		$pUrl .= $criteria['pUrl'];
		$url .= $criteria['url'];
		$url2 .= $criteria['url2'];

		// сортировка
		if (isset($params['sorting'])) {
			if ($params['sorting'] == 'dateDesc') { // по дате поступления в обратном порядке
				$orderBy = '`date` DESC';
			}
		}

		// лимит
		if (isset($params['limit'])) {
			$limit = ' LIMIT ' . $params['limit'];
		} else {
			$limit = '';
		}

		// оффсет
		if (isset($params['offset'])) {
			$offset = ' OFFSET ' . $params['offset'];
		} else {
			$offset = '';
		}

		// включить в выборку поля
		if (isset($params['includeFields'])) {

		}

		// запрос
		$query = Yii::$app->db->createCommand('SELECT DISTINCT
            `c`.`id`, `c`.`date`, `c`.`phone`, `c`.`email`,
			`cc`.`name`
			' . $fields . '
		FROM
			`claims` `c`
			LEFT JOIN `claims_content` `cc`
				ON `cc`.`idClaims` = `c`.`id`
			' . $join . '
		WHERE
			' . $where . '
		ORDER BY
			' . $orderBy
				. $limit
				. $offset);

		if ($pUrl) {
			$query->bindValue(':pUrl', $pUrl);
		}

		if ($url) {
			$query->bindValue(':url', $url);
		}

		if ($url2) {
			$query->bindValue(':url2', $url2);
		}

		//echo '<pre>';print_r($query);echo '</pre>';exit;
		$result = $query->queryAll();

		return $result;
	}
	public function getEmails()
	{

		// запрос
		$query = Yii::$app->db->createCommand('SELECT
             `s`.`emailClaim`
		FROM
			`settings` `s`'
				);

		$result = $query->queryAll();
		return $result;
	}
	/**
	 * Формирование условий
	 */
	public function getCriteria($params = [])
	{
		$fields = '';
		$join = '';
		$where = '';
		$pUrl = '';
		$url = '';
		$url2 = '';

		// фильтр по имени
		if (isset($params['name'])) {
			$where .= ' AND `cc`.`name` LIKE :url';
			$url = '%' . $params['name'] . '%';
		}

		// фильтр по телефону
		if (isset($params['phone'])) {
			$where .= ' AND `c`.`phone` LIKE :url2';
			$url2 = '%' . $params['phone'] . '%';
		}

		return [
				'fields' => $fields,
				'join' => $join,
				'where' => $where,
				'pUrl' => $pUrl,
				'url' => $url,
				'url2' => $url2,
		];
	}

	/**
	 * Сохранить заявку в БД
	 */
	public function save($inputData, $params = [])
	{
		// раскладываем входящий массив данных на переменные
		extract($inputData);

		// инициализируем данные, которые могут отсутствовать
		// (присутствовать не во всех формах)
		/*$price = isset($price) ? $price : null;
		$location = isset($location) ? $location : null;
		$parameters = isset($parameters) ? $parameters : null;
		$propertytype = isset($propertytype) ? $propertytype : null;
		$comment = isset($comment) ? $comment : null;*/

		// числовые поля для вставки в БД подготавливаем сразу
		//$price = (int)$price;
		//$comment = addslashes($comment);

		// запрос (основная таблица)

		$query = Yii::$app->db->createCommand("INSERT INTO
			`claims`
				(`tel`, `email`)
		VALUES
			(:tel, :email)")
				->bindValue('tel', $tel)
				->bindValue('email', $email);

		$result = $query->execute();
		$idClaims = Yii::$app->db->lastInsertId;

		// запрос (таблица контента)
		$query = Yii::$app->db->createCommand("INSERT INTO
			`claims_content`
				(`idClaims`, `name`, `contact`, `desc`)
		VALUES
			('{$idClaims}', :name, :contact, :desc)")
				->bindValue('name', $name)
				->bindValue('contact', $contact)
				->bindValue('desc', $desc);
		//echo '<pre>';print_r($query);echo '</pre>';exit;

		return $query->execute();
	}
}
