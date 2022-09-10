<?php

use yii\caching\FileCache;
use yii\db\Connection;
use yii\i18n\Formatter;
use yii\i18n\PhpMessageSource;

return [
    'language' => 'ru-RU',
    'sourceLanguage' => 'en-US',
    'charset' => 'utf-8',
    'timeZone' => 'Europe/Moscow',

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

        'formatter' => [
            'class' => Formatter::class,
            'locale' => 'ru-RU',
            'thousandSeparator' => ' ',
            'decimalSeparator' => ',',
            'nullDisplay' => '-',
            'currencyCode' => 'RUB',
            'defaultTimeZone' => 'Europe/Moscow',
            'timeZone' => 'Europe/Moscow',
            'dateFormat' => 'dd.MM.yyyy', //'d.MM.Y',
            'timeFormat' => 'H:mm:ss',
            'datetimeFormat' => 'php:d.m.y H:i',
        ],

        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => PhpMessageSource::class,
                    'basePath' => dirname(__DIR__, 2) . '/messages',
                ],

                'app' => [
                    'class' => PhpMessageSource::class,
                    'basePath' => dirname(__DIR__, 2) . '/messages',
                ],
            ],
        ],

        'assetManager' => [
            'linkAssets' => true,
            'appendTimestamp' => true,
        ],

    ],
];
