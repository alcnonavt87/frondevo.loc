<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;
use yii\web\View;
use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MainAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'frontend/web/markup/css/main.css',
    ];
    public $js = [
        'frontend/web/markup/js/lib/lib.min.js',
        'frontend/web/markup/js/main.min.js',
    ];
    public $jsOptions = [
        'position' =>  View::POS_HEAD,
    ];
}