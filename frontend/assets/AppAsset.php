<?php

namespace frontend\assets;

use rmrevin\yii\fontawesome\AssetBundle as FontAwesomeAsset;
use yii\bootstrap5\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    /** @var string */
    public $baseUrl = '@web';
    /** @var string[] */
    public $css = ['css/site.css'];
    /** @var array */
    public $js = [];
    /** @var string[] */
    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
        FontAwesomeAsset::class,
    ];


    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->sourcePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'files';
    }
}
