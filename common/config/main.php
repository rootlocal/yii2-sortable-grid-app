<?php

use yii\caching\FileCache;
use yii\db\Connection;

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(__DIR__, 2) . '/vendor',
    'components' => [
        'cache' => [
            'class' => FileCache::class,
        ],

        'db' => [
            'class' => Connection::class,
            'dsn' => 'sqlite:' . realpath(__DIR__ . '/../../') . "/sqlite.db",
            'charset' => 'utf8',
            'enableSchemaCache' => true,
        ],
    ],
];
