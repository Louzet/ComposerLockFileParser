<?php

/**
 * Author: mickael Louzet @micklouzet
 * File: RegistrationController.php
 * Created: 05/12/2019
 */

declare(strict_types=1);

namespace Louzet\ComposerLockFileParser;

use Louzet\ComposerLockFileParser\ParserCollection;

interface FileParserInterface {

    /**
     *
     * @param string $filePath
     * @return ParserCollection
     */
    public static function parse(string $filePath);

}