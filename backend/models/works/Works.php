<?php
namespace backend\models\works;

use yii\base\Model;
use Yii;
use backend\models\AdminOthers;
use corpsepk\yii2emt\EMTypograph;

Class Works extends Model
{
	var $frontendPath;
	var $myOthers;

    function __construct() {
        $this->frontendPath = '/frontend/web/';
		$this->myOthers = new AdminOthers();
	}

	/*getCount*/

	public function getMany($filters, $limit, $offset, $lang) {
		/*getManyFilterGet*/
		
		// пагинация
		if ($limit) {
			$limit = ' LIMIT '.(int)$limit;
			$offset = ' OFFSET '.(int)$offset;
		}
		
		// основной запрос
		$query = Yii::$app->db->createCommand('SELECT
			`id`, `pH1`, `dateCreated`, `show`
			/*getManyListTableFields*/
		FROM
			`works`, `works_content`
		WHERE
			TRUE/*getManyFilterWhereClause*/ AND
			`idWorks` = `id` AND
			`lang` = :lang
		ORDER BY
			`order` ASC,`id` DESC '
		.$limit
		.$offset)
		->bindValue(':lang', $lang);
		
		return $query->queryAll();
	}

	/*getFilterWhere*/

	public function upDateProperty($id, $name, $value) {
        $query = Yii::$app->db->createCommand()->update('works', [$name => $value], 'id = :id', [':id' => $id]);
        return $query->execute();
    }

	public function add($postBase, $postContent, $lang) {
		if (empty($postBase)) return false;

		$fields = [];
		$values = [];
		foreach ($postBase as $key => $item) {
			$fields[] = '`'.$key.'`';
			$values[] = '"'.addslashes($item).'"';
		}
		$fields = implode(',', $fields);
		$values = implode(',', $values);
		
		$query = Yii::$app->db->createCommand('INSERT INTO
			`works`
				('.$fields.')
		VALUES
			('.$values.')');

		$result = $query->execute();
        $rowId = (int)Yii::$app->db->lastInsertID;

		// таблица контента
		if ($result) {
			$fields = array();
			$values = array();
			foreach ($postContent as $key => $item) {
				$fields[] = '`'.$key.'`';
				$values[] = '"'.addslashes($item).'"';
			}
			$fields = !empty($fields) ? ', '.implode(',', $fields) : '';
			$values = !empty($values) ? ', '.implode(',', $values) : '';
			
			$query = Yii::$app->db->createCommand('INSERT INTO
				`works_content`
					(`idWorks`, `lang`'.$fields.')
			VALUES
				(:idWorks, :lang'.$values.')')
			->bindValue(':idWorks', $rowId)
			->bindValue(':lang', $lang)
			->execute();
			
			// пустые записи для оставшихся языков
			$allLangs = $this->myOthers->getAllLangs();
			$values = [];
			foreach ($allLangs as $item) {
				$values[] = $item['sName'];
			}
			array_splice($values, array_search($lang, $values), 1);
			
			$query = Yii::$app->db->createCommand('INSERT INTO
				`works_content`
					(`idWorks`, `lang`)
			VALUES
				(:idWorks, "'.$values[0].'"),
				(:idWorks, "'.$values[1].'")')
			->bindValue(':idWorks', $rowId)
			->execute();
		}

		return [
			$result,
			$rowId
		];
	}

	public function get($id, $lang) {
		$query = Yii::$app->db->createCommand('SELECT
			`id`, `pH1`, `pTitle`, `pUrl`, `pDescription`, `pKeyWords`, `pBreadCrumbs`, `show`, `pContent`
			, `description`, `idFilters`, `image`, `imageTitle`, `image`, `imageTitle`, `image`, `imageTitle`, `image`, `imageTitle`, `image`, `imageTitle`, `imageprtf`, `imageprtfTitle`, `imagebg`, `imagebgTitle`, `description`, `client`, `services`, `launch`, `aboutProject`, `task`, `descrofsolut`, `linkwork`, `mainpage`, `mainpageTitle`, `add`, `addpage`, `addpageTitle`, `results`, `worksdesсsbk`, `solutions`/*get*/
		FROM
			`works`, `works_content`
		WHERE
			`id` = :id AND
			`idWorks` = `id` AND
			`lang` = :lang')
		->bindValue(':id', $id)
		->bindValue(':lang', $lang);
		
		return $query->queryOne();
	}

	public function getEmpty() {
		$result = [
			'pH1' => '', 'pTitle' => '', 'pUrl' => '', 'pDescription' => '', 'pKeyWords' => '', 'pBreadCrumbs' => '', 'show' => 0, 'pContent' => '',
			 'description' => '', 'idFilters' => 0, 'image' => '', 'imageprtf' => '', 'imagebg' => '', 'client' => '', 'services' => '', 'launch' => '', 'aboutProject' => '', 'task' => '', 'descrofsolut' => '', 'linkwork' => '', 'mainpage' => '', 'add' => '', 'addpage' => '', 'results' => '', 'worksdesсsbk' => '',  'solutions' => '',/*getEmpty*/
		];
		
		return $result;
	}

	public function update($id, $postBase, $postContent, $lang) {

		$EMTypograph = new EMTypograph();
		$EMTypograph->setup([
				'Text.paragraphs' => 'off',
				'OptAlign.oa_oquote' => 'off',
				'Nobr.spaces_nobr_in_surname_abbr' => 'off',
				'OptAlign.all' => 'off',
		]);
		$EMTypograph->set_text($postContent['description']);
		$postContent['description']= $EMTypograph->apply();

		$EMTypograph->setup([
				'Text.paragraphs' => 'off',
				'OptAlign.oa_oquote' => 'off',
				'Nobr.spaces_nobr_in_surname_abbr' => 'off',
				'OptAlign.all' => 'off',
		]);
		$EMTypograph->set_text($postBase['pUrl']);
		$postBase['pUrl']= $EMTypograph->apply();


		$EMTypograph->set_text($postContent['client'] );
		$postContent['client']  = $EMTypograph->apply();

		$EMTypograph->set_text($postContent['pTitle'] );
		$EMTypograph->setup([
				'Text.paragraphs' => 'off',
				'OptAlign.oa_oquote' => 'off',
				'Nobr.spaces_nobr_in_surname_abbr' => 'off',
				'OptAlign.all' => 'off',
		]);
		$postContent['pTitle'] = $EMTypograph->apply();


		$EMTypograph->setup([
				'Text.paragraphs' => 'off',
				'OptAlign.oa_oquote' => 'off',
				'Nobr.spaces_nobr_in_surname_abbr' => 'off',
				'OptAlign.all' => 'off',
		]);
		$EMTypograph->set_text($postContent['pDescription']);
		$EMTypograph->setup([
				'Text.paragraphs' => 'off',
				'OptAlign.oa_oquote' => 'off',
				'Nobr.spaces_nobr_in_surname_abbr' => 'off',
				'OptAlign.all' => 'off',
		]);
		$postContent['pDescription'] = $EMTypograph->apply();

		$EMTypograph->set_text($postContent['results']);
		$EMTypograph->setup([
				'Text.paragraphs' => 'off',
				'OptAlign.oa_oquote' => 'off',
				'Nobr.spaces_nobr_in_surname_abbr' => 'off',
				'OptAlign.all' => 'off',

		]);
		$postContent['results'] = $EMTypograph->apply();
		$data = $postBase;
		if (isset($postContent)) {
			$data = array_merge($data, $postContent);
		}
		
		if (empty($data)) return false;
		
		$set = [];
		foreach ($data as $key => $item) {
			$set[] = '`'.$key.'`="'.addslashes($item).'"';
		}
		$set = implode(',', $set);

		$query = Yii::$app->db->createCommand('UPDATE
			`works`, `works_content`
		SET
			'.$set.'
		WHERE
			`id` = :id AND
			`idWorks` = `id` AND
			`lang` = :lang')
		->bindValue(':id', $id)
		->bindValue(':lang', $lang);
		
		return $query->execute();
	}

	public function delete($id) {
		// удаляем с диска одиночные изображения
		$imagesOne = [
			 '`image`', '`image`', '`image`', '`image`', '`image`', '`imageprtf`', '`imagebg`', '`mainpage`', '`addpage`',/*deleteImagesOne*/
		];
		$imagesOne = array_unique($imagesOne);
		if ($imagesOne) {
			$imagesOne = implode(',', $imagesOne);
		
			$query = Yii::$app->db->createCommand('SELECT
				'.$imagesOne.'
			FROM
				`works`
			WHERE
				`id` = :id')
			->bindValue(':id', $id);
			
			$fileNames = $query->queryAll();
			
			foreach ($fileNames[0] as $item) {
				$filePath = $_SERVER['DOCUMENT_ROOT'].$this->frontendPath.'p/works/original-'.$item;
				$this->myOthers->deleteImgFromDisk($filePath);
				
				$filePath = $_SERVER['DOCUMENT_ROOT'].$this->frontendPath.'p/works/medium-'.$item;
				$this->myOthers->deleteImgFromDisk($filePath);
			}
		}
		
		// удаляем с диска множественные изображения
		$imagesMany = [
			/*deleteImagesMany*/
		];
		$imagesMany = array_unique($imagesMany);
		foreach ($imagesMany as $item) {
			$query = Yii::$app->db->createCommand('SELECT
				`img`
			FROM
				`works_'.$item.'`
			WHERE
				`idWorks` = :id')
			->bindValue(':id', $id);
			
			$fileNames = $query->queryAll();
			
			foreach ($fileNames as $item) {
				$filePath = $_SERVER['DOCUMENT_ROOT'].$this->frontendPath.'p/works/original-'.$item['img'];
				$this->myOthers->deleteImgFromDisk($filePath);
				
				$filePath = $_SERVER['DOCUMENT_ROOT'].$this->frontendPath.'p/works/medium-'.$item['img'];
				$this->myOthers->deleteImgFromDisk($filePath);
			}
		}
			
		// удаляем запись
		$query = Yii::$app->db->createCommand('DELETE FROM
			`works`
		WHERE
			`id` = :id')
		->bindValue(':id', $id);
		
		return $query->execute();
	}



	public function getStatuses() {
		return [
			'В наличии' => 1,
			'Под заказ' => 2,
		];
	}
	
}