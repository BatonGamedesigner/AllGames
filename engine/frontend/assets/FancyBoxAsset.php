<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 11.02.2016
 * Time: 9:52
 */
namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class FancyBoxAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'js/yes-fancybox/jquery.fancybox.css',
    ];
    public $js = [
        'js/yes-fancybox/jquery.fancybox.pack.js',
        'js/yes-fancybox/init.js'
//        '//code.jquery.com/ui/1.11.4/jquery-ui.js'
    ];
    public $depends = [
        'frontend\assets\AppAsset'
    ];
}
