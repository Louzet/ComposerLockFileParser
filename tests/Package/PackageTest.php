<?php
/**
 * Created by PhpStorm.
 * Author: mickael-dev
 * File: PackageTest.php
 * Created: 07/12/2019 13:51
 */

declare(strict_types=1);

namespace ComposerLockFileParser\Tests\Package;

use PHPUnit\Framework\TestCase;
use ComposerLockParser\Package\Package;

class PackageTest extends TestCase
{
    public function testPackageConstructor(): void
    {
        $packageInfo = [
            'name' => 'name value',
            'version' => 'version value',
            'source' => ['source value'],
            'dist' => ['dist value'],
            'require' => ['require value'],
            'require-dev' => ['requireDev value'],
            'suggest' => ['suggest value'],
            'type' => 'type value',
            'extra' => ['suggest value'],
            'autoload' => [
                'psr-4' => [
                    "Name\\Space\\" => 'src/'
                ]
            ],
            'notification-url' => 'notificationUrl valuel',
            'license' => ['license value'],
            'authors' => ['authors value'],
            'description' => 'description value',
            'homepage' => 'homepage value',
            'keywords' => ['keywords value'],
            'time' => '2019-12-07 13:53:00',
        ];

        $package = Package::factory($packageInfo);

        $this->assertEquals($packageInfo['name'], $package->getName());
        $this->assertEquals($packageInfo['version'], $package->getVersion());
        $this->assertEquals($packageInfo['source'], $package->getSource());
        $this->assertEquals($packageInfo['dist'], $package->getDist());
        $this->assertEquals($packageInfo['require'], $package->getRequire());
        $this->assertEquals($packageInfo['require-dev'], $package->getRequireDev());
        $this->assertEquals($packageInfo['suggest'], $package->getSuggest());
        $this->assertEquals($packageInfo['type'], $package->getType());
        $this->assertEquals($packageInfo['extra'], $package->getExtra());
        $this->assertEquals($packageInfo['autoload'], $package->getAutoload());
        $this->assertEquals(trim(key($packageInfo['autoload']['psr-4']), '\\'), $package->getNamespace());
        $this->assertEquals($packageInfo['notification-url'], $package->getNotificationUrl());
        $this->assertEquals($packageInfo['license'], $package->getLicense());
        $this->assertEquals($packageInfo['authors'], $package->getAuthors());
        $this->assertEquals($packageInfo['description'], $package->getDescription());
        $this->assertEquals($packageInfo['homepage'], $package->getHomepage());
        $this->assertEquals($packageInfo['keywords'], $package->getKeywords());
        $this->assertEquals(new \DateTime($packageInfo['time']), $package->getTime());
        $this->assertEquals('Name\\Space', $package->getNamespace());
    }
}
