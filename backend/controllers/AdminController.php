<?php 
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use backend\models\AdminOthers;

/**
 * Admin controller
 */
class AdminController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            if(Yii::$app->getUser()->getIdentity()->role < 50){
                                return TRUE;
                            }
                            Yii::$app->user->logout();
                            return $this->goHome();
                        }
                    ],
                ],
            ],
        ];
    }
    
    public function beforeAction($action)
    {
        $myOthers = new AdminOthers();
        $id1Uri = Yii::$app->getRequest()->get('id');
        if(!$id1Uri) {
            $id1Uri = 0;
        }
        $accessGranted = $myOthers->getUserAccess(Yii::$app->user->id, $id1Uri);

        if(!$accessGranted) {
            die(json_encode(['code' => '00107', 'message' => 'Отказано в доступе']));
        }
        
        return parent::beforeAction($action);
    }
    
    /**
     * Create header
     *
     * @param $text
     * @return string
     */
    public function createHeader($text) {
            return '<h2 class="catalog__section-header-text">' . $text . '</h2>';
    }

	/**
     * get input width className
     *
     * @param $width
     * @return string
     */
    function getInputWidth($width) {
            $result = '';
            switch ($width) {
                    case 60:
                            $result = 'input-width_60';
                            break;

                    case 160:
                            $result = 'input-width_160';
                            break;

                    case 400:
                            $result = 'input-width_400';
                            break;

                    case 600:
                            $result = 'input-width_600';
                            break;
            }

            return $result;
    }

	/**
     * get textarea width className
     *
     * @param $width
     * @return string
     */
    function getTextAreaWidth($width) {
            $result = '';

            switch ($width) {
                    case '400x60':
                            $result = 'text-area-width_400x60';
                            break;

                    case '400x100':
                            $result = 'text-area-width_400x100';
                            break;

                    case '800x500':
                            $result = 'text-area-width_800x500';
                            break;
            }

            return $result;
    }

	/**
     * Create text input field
     *
     * @param $param
     * @return string
     */
    public function createInput($param) {

        $width = $this->getInputWidth($param['width']);

        if(!isset($param['attr'])) {
                $param['attr'] = '';
        }

        if(isset($param['dataCopy']) AND isset($param['titleCopy'])) {
                $buttonCopy = '<span class="button button__copy" data-copy="'.$param['dataCopy'].'" title="'.$param['titleCopy'].'"></span>';
        } else {
                $buttonCopy = '';
        }

        if(isset($param['genUrl']) AND isset($param['titleUrl'])) {
                $buttonGen = '<span class="button button__generate" data-copy="'.$param['genUrl'].'" title="'.$param['titleUrl'].'"></span>';
        } else {
                $buttonGen = '';
        }

        if(!isset($param['placeholder'])) {
                $param['placeholder'] = $param['text'];
        }

        if (isset($param['dataCount'])) {
                $dataCount = 'data-count="'.$param['dataCount'].'"';
                $inputCounter = '<div class="input-counter">'.$param['dataCount'].'</div>';
        } else {
                $dataCount = '';
                $inputCounter = '';
        }
		
		if (isset($param['defText'])) {
			$defText = '<span>'.$param['defText'].'</span>';
		} else {
			$defText = '';
		}

        $html = '<div class="input-row input-wrap">
            <label class="input__label" for="' . $param['id'] . '">' . $param['text'] . '</label>
            <input id="' . $param['id'] . '" placeholder="' . $param['placeholder'] . '" class="input catalog_input ' . $width . '" type="text" name="' . $param['name'] . '" value="' . $this->getCodeStr($param['value']) . '" ' . $param['attr'] . ' ' . $dataCount . '/>' . $defText . '
            '.$buttonCopy.$buttonGen.$inputCounter.'
        </div>';

        return $html;
    }

    public function createTextArea($param) {

        $width = $this->getTextAreaWidth($param['width']);

        if(!isset($param['attr'])) {
                $param['attr'] = '';
        }

        if(!isset($param['placeholder'])) {
                $param['placeholder'] = $param['text'];
        }

        if (isset($param['dataCount'])) {
                $dataCount = 'data-count="'.$param['dataCount'].'"';
                $inputCounter = '<div class="input-counter">'.$param['dataCount'].'</div>';
        } else {
                $dataCount = '';
                $inputCounter = '';
        }

        $html = '<div class="input-row input-wrap">
            <label class="input__label" for="' . $param['id'] . '">' . $param['text'] . '</label>
            <textarea placeholder="' . $param['placeholder'] . '" id="' . $param['id'] . '" name="' . $param['name'] . '" class="text-area ' . $width . '" ' . $param['attr'] . ' ' . $dataCount . '>' . $param['value'] . '</textarea>
            '.$inputCounter.'
        </div>';

        return $html;
    }

	/**
     * Create checkbox
     *
     * @param $param
     * @return string
     */
    public function createCheckBox($param) {
        $html = '<div class="input__check-box-wrap">
            <input id="' . $param['id'] . '" name="' . $param['name'] . '" class="check-box" type="checkbox" ' . $param['attr'] . ' value="' . $param['value'] . '">
            <label for="' . $param['id'] . '" class="check-box__label">' . $param['text'] . '</label>
        </div>';

        return $html;
    }

	/**
     * Create checkBox group
     *
     * @param $param
     * @return string
     */
    public function createCheckBoxGroup($param) {

        $checkBoxList = $param['list'];
        $checkBoxListCount = count($checkBoxList);

        $html = '';
        $html .= '<div id="idSubCat">';
        if (isset($param['scroll']) && $param['scroll']) {
                $html .= '<div class="scroll-container" data-module="scroll_container"><div>';
        }

        $html .= '<div class="input-checkbox-row">';

        for ($i = 0; $i < $checkBoxListCount; $i++) {
                $html .= $this->createCheckBox($checkBoxList[$i]);
        }

        $html .= '</div>';

        if (isset($param['scroll']) && $param['scroll']) {
                $html .= '</div></div>';
        }
        $html .= '</div>';

        return $html;
    }

	/**
     * Create checkbox row
     *
     * @param $param
     * @return string
     */
    public function createCheckBoxRow($param) {
        $html = '<div class="input-checkbox-row">
                ' .
        $this->createCheckBox($param)
        . '
        </div>';

        return $html;
    }

	/**
     * Create radio button
     *
     * @param {array} $param
     * @param {string} $sub_class
     * @return string
     */
    public function createRadioButton($param, $sub_class) {

        if (!$sub_class || empty($sub_class)) {
            $sub_class = '';
        }

        $html = '<div class="radio-wrap ' . $sub_class . '">
            <input id="' . $param['id'] . '" name="' . $param['name'] . '" class="radio" type="radio" ' . $param['attr'] . ' value="' . $param['value'] . '">
            <label for="' . $param['id'] . '" class="radio__label">' . $param['text'] . '</label>
        </div>';

        return $html;
    }

    /**
     * Create radio group
     *
     * @param $param
     * @return string
     */
    public function createRadioGroup($param) {

        $radioList = $param['list'];
        $radioListCount = count($radioList);

        $html = '<div class="input-radio-row group">';

        if (isset($param['header']) && !empty($param['header'])) {
            $html .= '<h3 class="radio__header">' . $param['header'] . '</h3>';
        }

        for ($i = 0; $i < $radioListCount; $i++) {
            $html .= $this->createRadioButton($radioList[$i], 'radio_inline');
        }

        $html .= '</div>';

        return $html;
    }

    /**
     * Create radio button row
     *
     * @param $param
     * @return string
     */
    public function createRadioButtonRow($param) {
        $html = '<div class="input-radio-row">
            ' .
            $this->createRadioButton($param, '')
            . '
            </div>';

        return $html;
    }

    /**
     * Create select menu
     *
     * @param $param
     * @return string
     */
    public function createSelect($param) {

        $width = $this->getInputWidth($param['width']);

        $html = '<div class="select-wrap">
            <label class="input__label">' . $param['text'] . '</label>
            <select class="select ' . $width . '" name="' . $param['name'] . '" data-module="select" ' . $param['attr'] . '>' . $param['value'] . '</select>
        </div>';

        return $html;
    }

    /**
     * Create link
     */
    public function createLink($param) {
        $typesToClasses = [
			'link' => 'link',
			'linkGray' => 'link gray',
			'btnAdd' => 'button btn__add',
		];
		
		// css-class
		$class = (isset($param['type']) && isset($typesToClasses[$param['type']]))
			? $typesToClasses[$param['type']]
			: 'link';
		
		// other attributes
		$attrsPairs = isset($param['attrs']) ? $param['attrs'] : [];
		$attrs = [];
		foreach ($attrsPairs as $attrName => $attrVal) {
			$attrs[] = $attrName.'="'.$attrVal.'"';
		}
		$attrs = implode(' ', $attrs);
		
		$html = '<a href="'.$param['href'].'" class="'.$class.'" '.$attrs.'>'.$param['text'].'</a>';
        return $html;
    }

    /**
     * Create tabs
     */
    public function createTabs($param) {
		$html = '';
		
		$tabsControls = [];
		$tabsListItems = [];
		foreach ($param['list'] as $item) {
			$tabsControls[] = $this->createTabControl($item);
			$tabsListItems[] = $this->createTabListItem($item);
		}
		
		// controls
		$tabsControls = implode("\n\t", $tabsControls);
		
		// tabs items
		$tabsListItems = implode("\n\n\t\t", $tabsListItems);
		
		$tabsList = '<!-- tabs  list -->
	<ul class="tabs__list">';
		$tabsList .= $tabsListItems;
		$tabsList .= '</ul>
	<!--/tabs  list -->';
		
		$html .= $tabsControls;
		$html .= $tabsList;
		
		return $html;
	}

    /**
     * Create tab control
     */
    private function createTabControl($param) {
		$checked = (isset($param['checked']) && $param['checked']) ? 'checked' : '';
		$html = '<input id="'.$param['id'].'" type="radio" name="tabs-controls" '.$checked.' class="input-control">';
		return $html;
	}

    /**
     * Create tab list item
     */
    private function createTabListItem($param) {
		$html = '<!-- tabs  item -->
		<li class="tabs__item">
			<label for="'.$param['id'].'" class="button">'.$param['text'].'</label>
		</li>
		<!--/tabs  item -->';
		return $html;
	}

    public function getCodeStr($str) {
        $search = array("«", "»", "‘", "’", "“", "”", '"', "'", "<", ">");
        $replace = array("&laquo;", "&raquo;", "&lsquo;", "&rsquo;", "&ldquo;", "&rdquo;", "&quot;", "&apos;", "&lsaquo;", "&rsaquo;");
        return str_replace ($search , $replace , $str);
    }
}
