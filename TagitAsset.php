<?php

namespace xj\tagit;

use yii\web\AssetBundle;

/**
 * 
 * @author xjflyttp <xjflyttp@gmail.com>
 */
class TagitAsset extends AssetBundle
{

    public $sourcePath = '@bower/tag-it';
    public $basePath = '@webroot/assets';
    public $js = ['js/tag-it.js'];
    public $css = [
        'css/jquery.tagit.css',
        'css/tagit.ui-zendesk.css',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\jui\JuiAsset',
    ];

}
