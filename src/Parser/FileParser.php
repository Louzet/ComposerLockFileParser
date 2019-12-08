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
use ComposerLockParser\Exception\FileContentExeption;
use ComposerLockParser\Exception\FileNotFoundException;

class FileParser implements FileParserInterface
{
    /**
     * {@inheritDoc}
     */
    public static function parse(string $filePath): PackageCollection
    {
        if (!\is_file($filePath)) {
            throw new FileNotFoundException('Sorry! This file was not found or does not exist');
        }

        if (false === $content = \file_get_contents($filePath)) {
            throw new FileContentExeption('An error has occured while reading your file !');
        }

        $data = \json_decode($content, true, 512, JSON_THROW_ON_ERROR);

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
