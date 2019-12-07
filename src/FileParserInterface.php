<?php

/**
 * Author: mickael Louzet @micklouzet
 * File: FileParserInterface.php
 * Created: 05/12/2019
 */

declare(strict_types=1);

namespace ComposerLockFileParser;

use ComposerLockFileParser\ParserCollection;

interface FileParserInterface {

    /**
     *
     * @param string $filePath
     * @return ParserCollection
     */
    public static function parse(string $filePath);

}