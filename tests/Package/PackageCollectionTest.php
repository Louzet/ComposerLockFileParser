<?php
/**
 * Created by PhpStorm.
 * Author: mickael-dev
 * File: PackageCollectionTest.php
 * Created: 08/12/2019 04:03
 */

declare(strict_types=1);

namespace ComposerLockParser\Tests\Package;

use PHPUnit\Framework\TestCase;
use ComposerLockParser\Package\Package;
use ComposerLockParser\Package\PackageCollection;

class PackageCollectionTest extends TestCase
{
    public const DS = DIRECTORY_SEPARATOR;

    /** @var array */
    private $fixtures;

    /** @var PackageCollection */
    private $packageCollection;

    public function setUp()
    {
        $this->fixtures = require dirname(__DIR__, 2).self::DS.'resources'.self::DS.'fixtures.php';
        $this->packageCollection = new PackageCollection();
        foreach ($this->fixtures as $fixture) {
            $package = Package::factory($fixture);
            $this->packageCollection[] = $package;
        }
    }

    public function tearDown()
    {
        $this->packageCollection = null;
    }

    public function testGetIndexedByName(): void
    {
        $packageThreeArray = $this->returnThirdPackageFake();

        $package1 = $this->packageCollection->offsetGet(0);
        $package2 = $this->packageCollection->offsetGet(1);

        $this->packageCollection->nameExists('name 1');

        $package3 = Package::factory($packageThreeArray);
        $this->packageCollection[] = $package3;

        $this->assertTrue($this->packageCollection->nameExists('name 1'));
        $this->assertTrue($this->packageCollection->namespaceExists('Name\SpaceOne'));
        $this->assertEquals($package1, $this->packageCollection->getByName('name 1'));
        $this->assertEquals($package1, $this->packageCollection->getByNamespace('Name\SpaceOne'));

        $this->assertTrue($this->packageCollection->nameExists('name 2'));
        $this->assertTrue($this->packageCollection->namespaceExists('Name\SpaceTwo'));
        $this->assertEquals($package2, $this->packageCollection->getByName('name 2'));
        $this->assertEquals($package2, $this->packageCollection->getByNamespace('Name\SpaceTwo'));

        $this->assertTrue($this->packageCollection->nameExists('name 3'));
        $this->assertTrue($this->packageCollection->namespaceExists('Name\SpaceThree'));
        $this->assertEquals($package3, $this->packageCollection->getByName('name 3'));
        $this->assertEquals($package3, $this->packageCollection->getByNamespace('Name\SpaceThree'));

        $this->assertEquals(3, $this->packageCollection->count());

        $this->packageCollection->offsetUnset(2);
    }

    public function testGetIndexedByNameWithEmptyIndexedName(): void
    {
        $this->packageCollection->indexedBy['name'] = [];
        $copy = $this->packageCollection->getArrayCopy();
        $count = \count($copy);
        for ($i = 1; $i <= $count; $i++) {
            $this->assertEquals($this->packageCollection->getPackages()['name '.$i], $copy[$i - 1]);
        }
    }

    public function testGetByNameUnexpected(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->packageCollection->getByName('name 4');
    }

    public function testGetByNamespaceUnexpected(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->packageCollection->getByNamespace('Name\SpaceFour');
    }

    public function testGetNamespaces(): void
    {
        $this->assertArrayHasKey('Name\SpaceOne', $this->packageCollection->getNameSpaces());
        $this->assertArrayHasKey('Name\SpaceTwo', $this->packageCollection->getNameSpaces());
        $this->assertArrayNotHasKey('Name\SpaceThree', $this->packageCollection->getNameSpaces());
    }

    public function testExchangeArrayObject(): void
    {
        $this->packageCollection->exchangeArray(['Amsterdam', 'Paris', 'Londres']);

        $this->assertSame($this->packageCollection->getArrayCopy(), ['Amsterdam', 'Paris', 'Londres']);
        $newPackage = Package::factory($this->returnThirdPackageFake());
        $this->packageCollection[] = $newPackage;

        $this->assertContains($newPackage, $this->packageCollection->getArrayCopy());
        $this->assertCount(4, $this->packageCollection->getArrayCopy());

        $this->assertNotEmpty($this->packageCollection->indexedBy['name']);
    }

    private function returnThirdPackageFake(): array
    {
        return [
            'name' => 'name 3',
            'version' => 'version 3',
            'source' => ['source value'],
            'dist' => ['dist value'],
            'require' => ['require value', 'require value 2'],
            'require-dev' => ['requireDev value'],
            'suggest' => ['suggest value'],
            'type' => 'type value',
            'extra' => ['suggest value'],
            'autoload' => [
                'psr-4' => [
                    "Name\\SpaceThree\\" => 'lib/'
                ]
            ],
            'notification-url' => 'notificationUrl value3',
            'license' => ['MIT'],
            'authors' => ['author lambda four, author lambda five, author lambda six'],
            'description' => 'description value',
            'homepage' => 'homepage value',
            'keywords' => ['keywords value', 'another keyword', 'again'],
            'time' => '2019-12-08 04:42:35',
        ];
    }
}
