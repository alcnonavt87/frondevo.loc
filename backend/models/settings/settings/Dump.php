<?php
namespace backend\models\settings\settings;

use Yii;
use yii\base\Model;

Class Dump extends Model {

    //Выбрать все таблицы в БД
    function getAllTables($nameDB = '')
    {
        if($nameDB == '') {
            $query = Yii::$app->db->createCommand('SHOW FULL TABLES');
        } else {
            $query = Yii::$app->db->createCommand('SHOW FULL TABLES FROM `'.$nameDB.'`');
        }
        return $query->queryAll();
    }
    
    //Забераем статус таблицы
    function getTableStatus($tableName, $nameDB = '')
    {
        if($nameDB == '') {
            $query = Yii::$app->db->createCommand('SHOW TABLE STATUS WHERE NAME = :tableName')
            ->bindValue(':tableName', $tableName);
        } else {
            $query = Yii::$app->db->createCommand('SHOW TABLE STATUS FROM `'.$nameDB.'` WHERE NAME = :tableName')
            ->bindValue(':tableName', $tableName);
        }
        return $query->queryAll();
    }
    
    //Формируем список полей таблицы
    function getTableFields($nameDB, $tableName)
    {
        if($nameDB <> '') {
            $db = '`'.$nameDB.'`.`'.$tableName.'`';
        } else {
            $db = '`'.$tableName.'`';
        }
        
        $query = Yii::$app->db->createCommand('SHOW FIELDS FROM '.$db);
        
        $fields = $query->queryAll();
        $fieldsList = '';
        $countFields = count($fields);
        
        if ($countFields) {
            $fieldsList = '(';
            for ($i=0; $i < $countFields; $i++) {
                $fieldsList .= '`'.$fields[$i]['Field'].'`,';
            }
            $fieldsList = substr($fieldsList,0,strlen($fieldsList) - 1) . ')';
	}
        
        return [$fieldsList, $fields];
    }


    function dumpTable($nameDB, $oneTable, $insertRows, $blockingInnoDBT, $file)
    {
        //определяем тип таблицы
        if($oneTable['tableType'] == 'VIEW') {
            if($nameDB <> '') {
                $db = '`'.$nameDB.'`.`'.$oneTable['name'].'`';
            } else {
                $db = '`'.$oneTable['name'].'`';
            }
            $query = Yii::$app->db->createCommand('SHOW CREATE VIEW '.$db);
            
            $dumpDate = $query->execute()->get('Create View', '').";\n\n";
            $viewHeader = "--\n-- Описание для VIEW ".$oneTable['name']."\n--\n";
            $viewHeader = $viewHeader."DROP VIEW IF EXISTS `".$oneTable['name']."`;\n";

            fwrite($file, $viewHeader.$dumpDate);
            fflush($file);
        } else {
            if($nameDB <> '') {
                $db = '`'.$nameDB.'`.`'.$oneTable['name'].'`';
            } else {
                $db = '`'.$oneTable['name'].'`';
            }
            $query = Yii::$app->db->createCommand('SHOW CREATE TABLE '.$db);
            $createTable = $query->queryOne();
            
            //$dumpDate = $query->execute()->get('Create Table', '').";\n\n";
            $dumpDate = $createTable['Create Table'].";\n\n";
            $viewHeader = "--\n-- Описание для TABLE ".$oneTable['name']."\n--\n";
            $viewHeader = $viewHeader."DROP TABLE IF EXISTS `".$oneTable['name']."`;\n";

            fwrite($file, $viewHeader.$dumpDate);
            fflush($file);
            
            //Определяем все столбцы таблицы
            $fl = $this->getTableFields($nameDB, $oneTable['name']);
            
            $fieldsList = $fl[0].' ';
            $firstField = $fl[1][0]['Field'];
            
            $tableFilds = $fl[1];
            $countTableFilds = count($tableFilds);
            
            $startField = 0;
            
            $insertHeader = "--\n-- Вывод данных для TABLE ".$oneTable['name']."\n--\n";
            fwrite($file, $insertHeader);
            
            $dumpData = '';
            
            do {
                $query = Yii::$app->db->createCommand('SELECT * FROM '.$db.' ORDER BY '.$db.'.`'.$firstField.'` ASC LIMIT '.$startField.', '.$insertRows);
                $data = $query->queryAll();
                
                $countData = count($data);
                
                //Если первый селект вернул данные
                if($startField == 0 AND $countData <> 0) {
                    $dumpData .= "/*!40000 ALTER TABLE `".$oneTable['name']."` DISABLE KEYS */;\n";
                }
                //Если первый селект НЕ вернул данные
                if($startField == 0 AND $countData == 0) {
                    $dumpData = "-- Нет данных для TABLE ".$oneTable['name']."\n\n";
                }
                
                //Формирование инсерта
                if($countData) {
                    $dumpData .= 'INSERT INTO `'.$oneTable['name'].'` '.$fieldsList.'VALUES'."\n";
                    for($i = 0; $i< $countData; $i++) {
                        $dumpData .= '(';
                        for($j = 0; $j < $countTableFilds; $j++) {
                            $fieldData = $data[$i][$tableFilds[$j]['Field']];
                            if (!isset($fieldData)) {
                                $dumpData .= 'NULL,';
                            } else {
                                if ($fieldData != '') $dumpData .= '\''.mysql_escape_string($fieldData).'\',';
                                else $dumpData .= '\'\',';
                            }
                        }
                        $dumpData = substr($dumpData,0,strlen($dumpData) - 1) ."),\n";
                    }
                    $dumpData = substr($dumpData,0,strlen($dumpData) - 2) .";\n";
                }
                
                //Если селект не первый и он вернул 0 записей
                if($startField <> 0 AND $countData == 0) {
                    $dumpData .= "/*!40000 ALTER TABLE `".$oneTable['name']."` ENABLE KEYS */;\n\n";
                }
                //Если селект первый и он вернул записей меньше чем $insertRows но больше 0
                if($startField == 0 AND $countData < $insertRows AND $countData > 0) {
                    $dumpData .= "/*!40000 ALTER TABLE `".$oneTable['name']."` ENABLE KEYS */;\n\n";
                }
                //Если селект не первый и он вернул записей меньше чем $insertRows
                if($startField <> 0 AND $countData < $insertRows) {
                    $dumpData .= "/*!40000 ALTER TABLE `".$oneTable['name']."` ENABLE KEYS */;\n\n";
                }
                
                fwrite($file, $dumpData);
                fflush($file);
                $dumpData = '';
                
                $startField = $startField + $insertRows;
                
                $this->setPercent();
            }
            while ($countData == $insertRows);
        }
    }
    
    function dumpForceDownload($dumpFileName)
    {
        if (file_exists($dumpFileName)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($dumpFileName));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($dumpFileName));
            ob_clean();
            flush();
            readfile($dumpFileName);
        }
    }

    //Инициализация сессионных переменных для дампа
    function dumpInitSessionVars()
    {
        Yii::$app->session->set('startDump', TRUE);   //Скрипт дампа запущен на выполнение
        Yii::$app->session->set('siseAll', 0);        //сумма размеров всех таблиц
        Yii::$app->session->set('tableName', '');     //имя текущей талицы
        Yii::$app->session->set('processed', 0);      //сумма размеров обработанных таблиц
        Yii::$app->session->set('precent', 0);        //процент обработанного дампа
        Yii::$app->session->set('sumDeltaSize', 0);   //сумма размеров частей таблицы которая находится в обработке
        Yii::$app->session->set('iterations', 0);     //Приблизительное колличество иттераций по текуцей таблице
        Yii::$app->session->set('deltaSize', 0);      //размер одной части обрабатываемой таблицы
        Yii::$app->session->set('tableSize', 0);      //размер текущей таблицы
    }
    
    //Удаление переменных из сесии
    function dumpDestroySessionVars()
    {
        Yii::$app->session->remove('siseAll');        //сумма размеров всех таблиц
        Yii::$app->session->remove('tableName');      //имя текущей талицы
        Yii::$app->session->remove('processed');      //сумма размеров обработанных таблиц
        Yii::$app->session->remove('precent');        //процент обработанного дампа
        Yii::$app->session->remove('sumDeltaSize');   //сумма размеров частей таблицы которая находится в обработке
        Yii::$app->session->remove('iterations');     //Приблизительное колличество иттераций по текуцей таблице
        Yii::$app->session->remove('deltaSize');      //размер одной части обрабатываемой таблицы
        Yii::$app->session->remove('tableSize');      //размер текущей таблицы
        Yii::$app->session->remove('startDump');      //Скрипт дампа запущен на выполнение
    }
    
    //Определение размера дампа
    function dumpSize($tables)
    {
        $countTables = count($tables);
        if($countTables) {
            $siseAll = 0;
            for($i = 0; $i < $countTables; $i++) {
                $siseAll = $siseAll + $tables[$i]['tableSize'];
            }
            //Определяемся с размером дампа и задаём время работы скримпа
            if($siseAll == 0) $siseAll = 1;
            
            return $siseAll;
        } else {
            return FALSE;
        }
    }

    //Задаём первоначальные значения таблицы
    function tableSetSessionVars($oneTable, $colRows)
    {
        if($oneTable['tableType'] == 'VIEW') {
            Yii::$app->session->set('tableName', $oneTable['name']);
            Yii::$app->session->set('tableSize', 0);
            Yii::$app->session->set('iterations', 0);
            Yii::$app->session->set('deltaSize', 0);
        } else {
            Yii::$app->session->set('tableName', $oneTable['name']);
            Yii::$app->session->set('tableSize', $oneTable['tableSize']);

            $iterations = ceil($oneTable['rows'] / $colRows);
            
            if($iterations > 0) {
                Yii::$app->session->set('iterations', $iterations);     //Приблизительное колличество иттераций по текуцей таблице

                $deltaSize = round($oneTable['tableSize'] / $iterations);
                Yii::$app->session->set('deltaSize', $deltaSize);       //размер одной части обрабатываемой таблицы
            } else {
                Yii::$app->session->set('iterations', 0);
                Yii::$app->session->set('deltaSize', 0);
            }
        }
    }
    
    //Устанавливаем процент после того как закончили с одной таблицей
    function setPercentAfteCompletedTable($oneTable)
    {
        $processed = Yii::$app->session->get('processed') + $oneTable['tableSize'];
        
        Yii::$app->session->set('processed', $processed);
        
        $siseAll = Yii::$app->session->get('siseAll');
        
        Yii::$app->session->set('precent', round($processed / $siseAll, 2)); 
        Yii::$app->session->set('iterations', 0);
        Yii::$app->session->set('deltaSize', 0);
        Yii::$app->session->set('tableSize', 0);
    }
    
    //устанавливаем процент после каждой итерации по таблице
    function setPercent()
    {
        $processed = Yii::$app->session->get('processed');
        $deltaSize = Yii::$app->session->get('deltaSize');
        $sumDeltaSize = Yii::$app->session->get('deltaSize') + $deltaSize;
        $siseAll = Yii::$app->session->get('siseAll');
        
        $precent = round(($processed + $sumDeltaSize) / $siseAll, 2);
        
        Yii::$app->session->set('sumDeltaSize', $sumDeltaSize);
        Yii::$app->session->set('precent', $precent);      
    }

    public function getNewDump()
    {
        $startDump = Yii::$app->session->get('startDump',FALSE);
        
        if(!$startDump) {
            $this->dumpInitSessionVars();
            $insertRows = Yii::$app->params['insertRows'];
            $nameDB = Yii::$app->params['nameDB'];
            $dumpPath = Yii::$app->params['dumpPath'];
            $blockingInnoDBT = Yii::$app->params['blockingInnoDBT'];

            $allTables = $this->getAllTables($nameDB);
            $tables = [];
            $countAllTables = count($allTables);
            if($countAllTables) {
                for($i = 0; $i < $countAllTables; $i++) {
                    $keys = array_keys($allTables[$i]);
                    $table['name'] = $allTables[$i][$keys[0]];
                    $table['tableType'] = $allTables[$i][$keys[1]];
                    $tableStatus = $this->getTableStatus($table['name'], $nameDB);
                    $table['rows'] = $tableStatus[0]['Rows'];
                    $table['tableSize'] = $tableStatus[0]['Data_length'];
                    $table['engine'] = $tableStatus[0]['Engine'];
                    array_push($tables, $table);
                }

            }
                        
            //Определяем размер дампа и сможем ли мы его обработать
            $toStart = $this->dumpSize($tables);
            
            if($toStart) {
                Yii::$app->session->set('siseAll', $toStart);
                
                $time = date("Y_m_d_G_i_s",time());
                $fileName = $_SERVER['DOCUMENT_ROOT'].'/'.$dumpPath.'dump_'.$nameDB.'_'.$time.'.sql';
                $zipName = $_SERVER['DOCUMENT_ROOT'].'/'.$dumpPath.'dump_'.$nameDB.'_'.$time.'.zip';
                $fp=fopen($fileName,'ab');
                flock ($fp,LOCK_EX);//блокировка файла
                $header = "--\n-- Отключение внешних ключей\n--\n/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;\n\n";
                $header = $header."--\n-- Установка кодировки, с использованием которой клиент будет посылать запросы на сервер\n--\nSET NAMES 'utf8';\n";
                fwrite($fp, $header);

                //Обрабатываем каждую таблицу и сохраняем в файле
                foreach ($tables as $oneTable) {
                    $this->tableSetSessionVars($oneTable, $insertRows);
                    
                    $this->dumpTable($nameDB, $oneTable, $insertRows, $blockingInnoDBT, $fp);
                    
                    $this->setPercentAfteCompletedTable($oneTable);
                }


                $bottom = "\n--\n-- Включение внешних ключей\n--\n/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;";
                fwrite($fp, $bottom);

                flock ($fp,LOCK_UN);//снятие блокировки
                fclose ($fp);//закрытие 

                $zip = new \ZipArchive;
                $zip->open($zipName, \ZIPARCHIVE::CREATE);
                $zip->addFile($fileName, 'dump_'.$nameDB.'_'.$time.'.sql');
                $zip->close();
                @unlink($fileName);

                $this->dumpForceDownload($zipName);
                
                $this->dumpDestroySessionVars();
            } else {
                $this->dumpDestroySessionVars();
            }
        }
    }
    
    public function getAllTablesData($nameDB = '')
    {
        $allTables = $this->getAllTables($nameDB);
        $countAllTables = count($allTables);
        $tables = [];
        if($countAllTables) {
            for($i = 0; $i < $countAllTables; $i++) {
                $keys = array_keys($allTables[$i]);
                $table['name'] = $allTables[$i][$keys[0]];
                $table['tableType'] = $allTables[$i][$keys[1]];
                $tableStatus = $this->getTableStatus($table['name'], $nameDB);
                $table['rows'] = $tableStatus[0]['Rows'];
                $table['tableSize'] = $tableStatus[0]['Data_length'];
                $table['engine'] = $tableStatus[0]['Engine'];
                array_push($tables, $table);
            }
        }
        
        //Определяем размер дампа и сможем ли мы его обработать
        $sizeDB = $this->dumpSize($tables);
        if(!$sizeDB) $sizeDB = 0;
        
        $table['name'] = 'ВСЕГО';
        $table['tableType'] = '';
        $table['rows'] = '';
        $table['tableSize'] = $sizeDB;
        $table['engine'] = '';
        array_push($tables, $table);
        
        return $tables;
    }
}

?>