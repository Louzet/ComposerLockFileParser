<?php
/**
 * Created by PhpStorm.
 * Author: mickael-dev
 * File: fixtures.php
 * Created: 08/12/2019 04:05
 */

declare(strict_types=1);

return [
    [
        'name' => 'name 1',
        'version' => 'version 1',
        'source' => ['source value'],
        'dist' => ['dist value'],
        'require' => ['require value'],
        'require-dev' => ['requireDev value'],
        'suggest' => ['suggest value'],
        'type' => 'type value',
        'extra' => ['suggest value'],
        'autoload' => [
            'psr-4' => [
                "Name\\SpaceOne\\" => 'src/'
            ]
        ],
        'notification-url' => 'notificationUrl valuel',
        'license' => ['GPL'],
        'authors' => ['author lambda one, author lambda two'],
        'description' => 'description value',
        'homepage' => 'homepage value',
        'keywords' => ['keywords value'],
        'time' => '2019-12-07 13:53:00',
    ],
    [
        'name' => 'name 2',
        'version' => 'version 2',
        'source' => ['source value'],
        'dist' => ['dist value'],
        'require' => ['require value'],
        'require-dev' => ['requireDev value'],
        'suggest' => ['suggest value'],
        'type' => 'type value',
        'extra' => ['suggest value'],
        'autoload' => [
            'psr-0' => [
                "Name\\SpaceTwo\\" => 'src/'
            ]
        ],
        'notification-url' => 'notificationUrl value2',
        'license' => ['MIT'],
        'authors' => ['author lambda three'],
        'description' => 'description value',
        'homepage' => 'homepage value',
        'keywords' => ['keywords value'],
        'time' => '2019-12-08 04:06:00',
    ]
];