<?php

/**
 * Author: mickael Louzet @micklouzet
 * File: FileParserInterface.php
 * Created: 05/12/2019
 */

declare(strict_types=1);

namespace ComposerLockParser\Parser;

use ComposerLockParser\Package\PackageCollection;

interface FileParserInterface {

    /**
     *
     * @param string $filePath
     * @return PackageCollection
     */
    public static function parse(string $filePath): PackageCollection;

}