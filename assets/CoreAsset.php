<?php
/**
 * Created by PhpStorm.
 * User: manideep.bollu
 * Date: 12/7/2014
 * Time: 3:43 AM
 */

namespace app\assets;

use yii\web\AssetBundle;

class CoreAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

        'bootstrap/css/bootstrap.min.css',
        'css/font-awesome.css',
        'css/themify-icons.css',
        'css/animate.min.css',

        'css/skins/palette.css',
        'css/fonts/font.css',
        'css/main.css',
        'css/scintin.css',
    ];
    public $js = [
        'plugins/modernizr.js',

        'bootstrap/js/bootstrap.js',
        'plugins/jquery.slimscroll.min.js',
        'plugins/jquery.easing.min.js',
        'plugins/appear/jquery.appear.js',
        'plugins/jquery.placeholder.js',
        'plugins/fastclick.js',

        'js/offscreen.js',
        'js/main.js',
        'js/customJs/chat.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}