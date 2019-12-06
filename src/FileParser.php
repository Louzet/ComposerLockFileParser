<?php

/**
 * Author: mickael Louzet @micklouzet
 * File: FileParser.php
 * Created: 05/12/2019
 */

declare(strict_types=1);

namespace Louzet\ComposerLockFileParser;

use Louzet\ComposerLockFileParser\ParserCollection;
use Symfony\Component\PropertyAccess\PropertyAccess;

class FileParser implements FileParserInterface
{
    /**
     * {@inheritDoc}
     */
    public static function parse(string $filePath): ParserCollection
    {
        if (!\is_file($filePath)) {
            return new ParserCollection();
        }

        if (!$json = \file_get_contents($filePath)) {
            return new ParserCollection();
        }

        $data = \json_decode($json, true);
        $components = [];

        if (!$data || !isset($data['packages'])) {
            return new ParserCollection();
        }
        foreach ($data['packages'] as $vendor => $package) {
            $accessor = PropertyAccess::createPropertyAccessorBuilder()
                ->enableExceptionOnInvalidIndex()
                ->getPropertyAccessor();

            $array = [];

            $component = [
                'name' => $package['name'],
                'version' => $package['version'],
                'source' => $package['source'],
                'require' => $package['require'] ?? [],
                'description' => $package['description'],
                'keywords' => $package['keywords'],
                'time' => $package['time'],
            ];

            $accessor->setValue($array, "[name]", $component);
            $components[] = $component;
        }

        return new ParserCollection($components);
    }

    // public function byVendor(string $vendor)
    // {
    //     if (0 !== \strpos($package['name'], "vendor/")) {
    //         continue;
    //     }
    // }
}
