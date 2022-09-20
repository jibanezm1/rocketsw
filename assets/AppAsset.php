<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "web/nifty/css/bootstrap.min.css",
        "web/nifty/css/nifty.min.css",
        // "web/nifty/css/estilos.css"
        "web/nifty/css/demo/nifty-demo-icons.min.css",
        "web/nifty/plugins/themify-icons/themify-icons.css",
        "web/nifty/plugins/themify-icons/themify-icons.min.css",
        "web/nifty/css/demo/nifty-demo-icons.min.css",
        "web/nifty/plugins/pace/pace.min.css",
        "web/nifty/css/demo/nifty-demo.min.css",
        "web/nifty/plugins/ionicons/css/ionicons.min.css"
    ];
    public $js = [
        // "web/nifty/js/jquery.min.js",
        'js/juanpablo.js',
        "web/nifty/plugins/pace/pace.min.js",
        "web/nifty/js/bootstrap.min.js",
        "web/nifty/js/nifty.min.js",
        "web/nifty/plugins/flot-charts/jquery.flot.min.js",
        "web/nifty/plugins/flot-charts/jquery.flot.resize.min.js",
        "web/nifty/plugins/flot-charts/jquery.flot.tooltip.min.js",
        "web/nifty/plugins/morris-js/morris.min.js",
        "web/nifty/plugins/morris-js/raphael-js/raphael.min.js",
        "web/nifty/plugins/sparkline/jquery.sparkline.min.js",
        "web/nifty/js/demo/dashboard.js",
        "web/nifty/js/demo/morris-js.js",
        'web/nifty/js/demo/icons.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',

    ];
}
