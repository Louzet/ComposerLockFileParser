<?php

/**
 * Author: mickael Louzet @micklouzet
 * File: RegistrationController.php
 * Created: 05/12/2019
 */

declare(strict_types=1);

namespace Louzet\ComposerLockFileParser;

use Louzet\ComposerLockFileParser\ParserCollection;

class FileParser implements FileParserInterface
{
    /**
     * {@inheritDoc}
     */
    public static function parse(string $filePath): ParserCollection
    {
        if (!\is_file($filePath)) {
            return [];
        }

        if (!$json = \file_get_contents($filePath)) {
            return [];
        }

        $data = \json_decode($json, true);

        $components = [];

        if (!$data || !isset($data['packages'])) {
            return [];
        }
        foreach ($data['packages'] as $package) {
            $components[] = [
                'name' => $package['name'],
                'version' => $package['version'],
                'source' => $package['source'],
                'require' => $package['require'] ?? [],
                'description' => $package['description'],
                'keywords' => $package['keywords'],
                'time' => $package['time'],
            ];
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
