<?php

require_once './vendor/autoload.php';

$str = "hello\t\nworld";

use Lackoxygen\Toolkits\Str;

$ok = \Lackoxygen\Toolkits\Collection::make('hello world');

var_dump($ok);
