<?php

require __DIR__ . '/../vendor/autoload.php';

use ZayMedia\Captcha\Captcha;
use ZayMedia\Captcha\CacheAdapters\SimpleFileCacheAdapter;

$antiBotLinks = Captcha::make('1', new SimpleFileCacheAdapter(__DIR__ . '/cache'), 60);

var_dump($antiBotLinks->generateLinks());
