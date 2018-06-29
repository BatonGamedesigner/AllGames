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
class BlogAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
    ];
    public $js = [
        'libs/parallax.js-1.4.2/parallax.min.js',
        'libs/tinycolor/dist/tinycolor-min.js'
    ];
    public $depends = [
        'frontend\assets\AppAsset'
    ];
}
