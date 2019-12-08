<?php

/**
 * Author: mickael Louzet @micklouzet
 * File: FileParser.php
 * Created: 05/12/2019
 */

declare(strict_types=1);

namespace ComposerLockParser\Parser;

use ComposerLockParser\Package\Package;
use ComposerLockParser\Package\PackageCollection;
use ComposerLockParser\Exception\FileNotFoundException;
use ComposerLockParser\Exception\InvalidComposerLockFileException;

class FileParser implements FileParserInterface
{
    /**
     * {@inheritDoc}
     */
    public static function parse(string $filePath): PackageCollection
    {
        if (strcmp(pathinfo($filePath)['basename'], 'composer.lock') !== 0) {
            throw new InvalidComposerLockFileException();
        }

        if (false === \file_exists($filePath)) {
            throw new FileNotFoundException();
        }

        $data = \json_decode(\file_get_contents($filePath), true, 512, JSON_THROW_ON_ERROR);

        if (empty($data)) {
            return new PackageCollection();
        }

        $packages = new PackageCollection();

        if (!$data || !isset($data['packages'])) {
            return new PackageCollection();
        }

        foreach ($data['packages'] as $package) {
            $packages[] = Package::factory($package);
        }
        return $packages;
    }
}
