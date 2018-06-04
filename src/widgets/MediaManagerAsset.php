<?php

namespace mlcsthor\mediamanager\widgets;

use yii\web\AssetBundle;

class MediaManagerAsset extends AssetBundle
{

    public $sourcePath = '@vendor/mlcsthor/yii2-media-manager/assets';
    public $css = [
        'mm.min.css',
    ];
    public $js = [
        'mm.min.js',
    ];
    public $depends = [
    ];
    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];

}
