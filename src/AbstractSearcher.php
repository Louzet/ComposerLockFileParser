<?php

/**
 * Author: mickael Louzet @micklouzet
 * File: AbstractSearcher.php
 * Created: 05/12/2019
 */

declare(strict_types=1);

namespace Louzet\ComposerLockFileParser;

abstract class AbstractSearcher {

    /**
     * Allow to find packages on composer.lock parse-collection result by vendor name
     * @example $parser = FileParser::parse('./resources/composer.lock')->vendorName('jquery')
     *
     * @param string $vendorName
     * @return array
     */
    abstract public function vendorName(string $vendorName = ''): array;
}
