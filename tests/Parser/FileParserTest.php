<?php
/**
 * Created by PhpStorm.
 * Author: mickael-dev
 * File: FileParserTest.php
 * Created: 08/12/2019 01:12
 */

declare(strict_types=1);

namespace ComposerLockParser\Tests\Parser;

use PHPUnit\Framework\TestCase;
use ComposerLockParser\Package\Package;
use ComposerLockParser\Parser\FileParser;
use ComposerLockParser\Package\PackageCollection;
use ComposerLockParser\Exception\FileNotFoundException;
use ComposerLockParser\Exception\InvalidComposerLockFileException;

class FileParserTest extends TestCase
{
    public const DS = DIRECTORY_SEPARATOR;

    /**
     * @expectedException ComposerLockParser\Exception\FileNotFoundException
     * @expectedExceptionMessage Sorry! This file was not found or does not exist
     */
    public function testFileDoesntExist(): void
    {
        $file = dirname(__DIR__).self::DS.'composer.lock';
        FileParser::parse($file);
    }

    /**
     * @expectedException ComposerLockParser\Exception\InvalidComposerLockFileException
     * @expectedExceptionMessage Sorry! It looks like this file is not a composer.lock file
     */
    public function testFileIsNotComposerLockTypeFile(): void
    {
        $file = dirname(__DIR__, 2).self::DS.'resources'.self::DS.'COMPOSER.lock';
        FileParser::parse($file);
    }

    public function testEmptyComposerLockFile(): void
    {
        $file = dirname(__DIR__).self::DS.'composer.lock';
        file_put_contents($file, "{}\n");

        $parser = FileParser::parse($file);

        $this->assertInstanceOf(PackageCollection::class, $parser);
        $this->assertEmpty($parser->getNameSpaces());
        $this->assertEmpty($parser->getPackages());
        $this->assertEmpty($parser->getArrayCopy());

        unlink($file);
    }

    public function testValidComposerLockFileWithNoPackage(): void
    {
        $file = dirname(__DIR__, 2).self::DS.'composer.lock';
        $parser = FileParser::parse($file);

        $this->assertInstanceOf(PackageCollection::class, $parser);
        $this->assertNull($parser->indexedBy);
        $this->assertEmpty($parser->getPackages());
        $this->assertEmpty($parser->getNameSpaces());

        foreach ($parser->getPackages() as $package) {
            $this->assertInstanceOf(Package::class, $package);
        }
    }

    public function testValidComposerLockFile(): void
    {
        $file = dirname(__DIR__, 2).self::DS.'resources'.self::DS.'composer.lock';
        $parser = FileParser::parse($file);

        $this->assertInstanceOf(PackageCollection::class, $parser);
        $this->assertNotNull($parser->indexedBy);
    }
}
