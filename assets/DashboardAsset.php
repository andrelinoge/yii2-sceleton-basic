<?php
namespace app\assets;

use yii\web\AssetBundle;


class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl  = '@web/modules/dashboard';

    public $css = [
        'css/main.min.css',
        'bootstrap/css/bootstrap.min.css',
        'icons/elegant/style.css',
        'icons/elusive/css/elusive-webfont.css',
        'icons/flags/flags.css',
        'lib/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css'
    ];

    public $js = [
        '../../js/application.js',
        'js/init_theme.js',
        'js/jqueryCookie.min.js',
        'bootstrap/js/bootstrap.min.js',
        'lib/typeahead/typeahead.bundle.min.js',
        'js/fastclick.min.js',
        'lib/jquery-match-height/jquery.matchHeight-min.js',
        'lib/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
    //    'yii\bootstrap\BootstrapAsset',
    ];
}
