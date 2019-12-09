<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use ComposerLockParser\Parser\FileParser;

$parser = FileParser::parse('resources/composer.lock');

if ($parser->nameExists('bower-asset/bootstrap')) {
    // do some stuff
    print_r($parser->getByName('bower-asset/bootstrap'));
}