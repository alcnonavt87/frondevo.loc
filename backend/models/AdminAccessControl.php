<?php
namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * AdminAccessControl
 */
class AdminAccessControl extends Model
{
    public $confData;
    
    public function init()
    {
        //$configFile = require(__DIR__ . '/../../backend/config/myconfig.php');
        $listIPs = Yii::$app->params['listIPs'];
        
        if (!isset($listIPs)) {
            $this->confData = NULL;
        } else {
            $this->confData = ['listIPs' => $listIPs];
        }
        
        parent::init();
    }
    
    
    /**
     * Метод опредеряет входит или нет текущий IP - адрес в список разрешённых IP - адресов и/или диапазона IP - адресов.
     *
     * @param array $listIPs список разрешённых IP - адресов и/или диапазона IP - адресов.
     * @param string $currentIP текущий IP - адрес
     * @return boolean текущий IP - адрес TRUE - входит или FALSE - не входит в список разрешённых IP - адресов и/или диапазона IP - адресов.
     */
    public function ipAccess() {
        if(isset($this->confData['listIPs'])) {
            $listIPs = $this->confData['listIPs'];
            $entryFlag = FALSE;
            $currentIP = sprintf("%u\n", ip2long(Yii::$app->getRequest()->getUserIP()));

            foreach ($listIPs as $ip) {
                $countIP = count($ip);
                if($countIP == 1) {
                    $resolvedIP = ip2long($ip[0]);
                    if(!$resolvedIP) {
                        continue;
                    }
                    if($currentIP == sprintf("%u\n", $resolvedIP)) {
                        $entryFlag = TRUE;
                        break;
                    }
                }       
                if($countIP == 2) {
                    $resolvedIPStart = ip2long($ip[0]);
                    if(!$resolvedIPStart) {
                        continue;
                    }
                    $resolvedIPEnd = ip2long($ip[1]);
                    if(!$resolvedIPEnd) {
                        continue;
                    }
                    if($currentIP >= sprintf("%u\n", $resolvedIPStart) AND $currentIP <= sprintf("%u\n", $resolvedIPEnd)) {
                        $entryFlag = TRUE;
                        break;
                    }
                }
            }
        }
        else
        {
            $entryFlag = TRUE;
        }
        
        return $entryFlag;
    }

    /*
     * 
     */
    public function adminRightsAccess($role)
    {
        if($role < 50){
            return TRUE;
        }
        return FALSE;
    }
}
