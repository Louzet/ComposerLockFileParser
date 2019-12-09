&nbsp;
[![Latest Unstable Version](https://poser.pugx.org/louzet/composer-lock-file-parser/v/unstable)](https://packagist.org/packages/louzet/composer-lock-file-parser)
[![PHP](https://img.shields.io/badge/PHP-7.3%2B-blue.svg)](https://php.net/migration72)
[![Build Status](https://travis-ci.com/Louzet/ComposerLockFileParser.svg?branch=master)](https://travis-ci.com/Louzet/ComposerLockFileParser)
[![Quality Score](https://scrutinizer-ci.com/g/louzet/composerLockFileParser/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/louzet/ComposerLockFileParser/)

<!-- [![Total Downloads](https://img.shields.io/packagist/dt/louzet/composer-lock-file-parser.svg?style=flat-square)](https://packagist.org/packages/louzet/composer-lock-file-parser) -->

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require louzet/composer-lock-file-parser
```

## Usage

``` php
<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use ComposerLockParser\Parser\FileParser;

$parser = FileParser::parse('path/to/composer.lock');

```

Firstly, we need to import the FileParser factory, and parse our composer.lock file. &nbsp;
Now, **$parser** is a PackageCollection object, with some methods to output some information. &nbsp;

```markdown
<?php

print_r($parser->getPackages());

array (size=10)
  'bower-asset/bootstrap' => 
    object(ComposerLockParser\Package\Package)[2]
      private 'name' => string 'bower-asset/bootstrap' (length=21)
      private 'version' => string 'v3.2.0' (length=6)
      private 'source' => 
        array (size=3)
          'type' => string 'git' (length=3)
          'url' => string 'https://github.com/twbs/bootstrap.git' (length=37)
          'reference' => string 'c068162161154a4b85110ea1e7dd3d7897ce2b72' (length=40)
      private 'dist' => 
        array (size=4)
          'type' => string 'zip' (length=3)
          'url' => string 'https://api.github.com/repos/twbs/bootstrap/zipball/c068162161154a4b85110ea1e7dd3d7897ce2b72' (length=92)
          'reference' => string 'c068162161154a4b85110ea1e7dd3d7897ce2b72' (length=40)
          'shasum' => string '' (length=0)
      private 'require' => 
        array (size=1)
          'bower-asset/jquery' => string '>=1.9.0' (length=7)
      private 'requireDev' => 
        array (size=0)
          empty
      private 'suggest' => 
        array (size=0)
          empty
      private 'type' => string 'bower-asset-library' (length=19)
      private 'extra' => 
        array (size=2)
          'bower-asset-main' => 
            array (size=7)
              ...
          'bower-asset-ignore' => 
            array (size=8)
              ...
      private 'autoload' => 
        array (size=0)
          empty
      private 'notificationUrl' => string '' (length=0)
      private 'license' => 
        array (size=0)
          empty
      private 'authors' => 
        array (size=0)
          empty
      private 'description' => string 'The most popular front-end framework for developing responsive, mobile first projects on the web.' (length=97)
      private 'homepage' => string '' (length=0)
      private 'keywords' => 
        array (size=8)
          0 => string 'css' (length=3)
          1 => string 'framework' (length=9)
          2 => string 'front-end' (length=9)
          3 => string 'js' (length=2)
          4 => string 'less' (length=4)
          5 => string 'mobile-first' (length=12)
          6 => string 'responsive' (length=10)
          7 => string 'web' (length=3)
      private 'time' => null
  'bower-asset/jquery' => 
    object(ComposerLockParser\Package\Package)[4] ...
```

Each element inside **$parser->getPackages()** is an **Package** entity, than you can manipulate.
###### Other usages
```php
<?php
declare(strict_types=1);

require_once 'vendor/autoload.php';

use ComposerLockParser\Parser\FileParser;

$parser = FileParser::parse('resources/composer.lock');

if ($parser->nameExists('bower-asset/bootstrap')) {
    // do some stuff
    print_r($parser->getByName('bower-asset/bootstrap'));
}

```


### Security

If you discover any security related issues, please email micklouzet@hotmail.fr instead of using the issue tracker.

## Credits

- [Mickael Louzet](https://github.com/louzet)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
