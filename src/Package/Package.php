<?php

/**
 * Author: mickael Louzet @micklouzet
 * File: Package.php
 * Created: 07/12/2019
 */

declare(strict_types=1);

namespace ComposerLockParser\Package;

use DateTime;

class Package {
    
    /** @var string */
    private $name;
    
    /** @var string */
    private $version;
    
    /** @var array */
    private $source;
    
    /** @var array */
    private $dist;
    
    /** @var array */
    private $require;
    
    /** @var array */
    private $requireDev;
    
    /** @var array */
    private $suggest;
    
    /** @var string */
    private $type;
    
    /** @var array */
    private $extra;
    
    /** @var array */
    private $autoload;
    
    /** @var string */
    private $notificationUrl;
    
    /** @var array */
    private $license;
    
    /** @var array */
    private $authors;
    
    /** @var string */
    private $description;
    
    /** @var string */
    private $homepage;
    
    /** @var array */
    private $keywords;
    
    /** @var Datetime */
    private $time;

    private function __construct(string $name, string $version, array $source, array $dist, array $require,
        array $requireDev, array $suggest, string $type, array $extra, array $autoload, string $notificationUrl, array $license, array $authors, string $description, string $homepage,
        array $keywords, $time)
    {
        $this->name = $name;
        $this->version = $version;
        $this->source = $source;
        $this->dist = $dist;
        $this->require = $require;
        $this->requireDev = $requireDev;
        $this->suggest = $suggest;
        $this->type = $type;
        $this->extra = $extra;
        $this->autoload = $autoload;
        $this->license = $license;
        $this->notificationUrl = $notificationUrl;
        $this->authors = $authors;
        $this->description = $description;
        $this->homepage = $homepage;
        $this->keywords = $keywords;
        $this->time = $time;
    }
    public static function factory(array $packageInfo)
    {
        return new self(
            $packageInfo['name'],
            $packageInfo['version'],
            isset($packageInfo['source']) ? $packageInfo['source'] : [],
            isset($packageInfo['dist']) ? $packageInfo['dist'] : [],
            isset($packageInfo['require']) ? $packageInfo['require'] : [],
            isset($packageInfo['require-dev']) ? $packageInfo['require-dev'] : [],
            isset($packageInfo['suggest']) ? $packageInfo['suggest'] : [],
            isset($packageInfo['type']) ? $packageInfo['type'] : '',
            isset($packageInfo['extra']) ? $packageInfo['extra'] : [],
            isset($packageInfo['autoload']) ? $packageInfo['autoload'] : [],
            isset($packageInfo['notification-url']) ? $packageInfo['notification-url'] : '',
            isset($packageInfo['license']) ? $packageInfo['license'] : [],
            isset($packageInfo['authors']) ? $packageInfo['authors'] : [],
            isset($packageInfo['description']) ? $packageInfo['description'] : '',
            isset($packageInfo['homepage']) ? $packageInfo['homepage'] : '',
            isset($packageInfo['keywords']) ? $packageInfo['keywords'] : [],
            isset($packageInfo['time']) ? new DateTime($packageInfo['time']) : null
        );
    }
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @return string
     */
    public function getHomepage(): string
    {
        return $this->homepage;
    }

    /**
     * @return array
     */
    public function getSource(): array
    {
        return $this->source;
    }

    /**
     * @return array
     */
    public function getDist(): array
    {
        return $this->dist;
    }

    /**
     * @return array
     */
    public function getRequire(): array
    {
        return $this->require;
    }

    /**
     * @return array
     */
    public function getRequireDev(): array
    {
        return $this->requireDev;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getAutoload(): array
    {
        return $this->autoload;
    }

    /**
     * @return string
     */
    public function getNamespace(): string
    {
        $namespace = [];
        if (isset($this->autoload['psr-0'])) {
            $namespace = $this->autoload['psr-0'];
        } elseif (isset($this->autoload['psr-4'])) {
            $namespace = $this->autoload['psr-4'];
        }
        return trim(key($namespace), '\\');
    }

    /**
     * @return array
     */
    public function getLicense(): array
    {
        return $this->license;
    }

    /**
     * @return array
     */
    public function getAuthors(): array
    {
        return $this->authors;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return array
     */
    public function getKeywords(): array
    {
        return $this->keywords;
    }

    /**
     * @return \DateTime|null
     */
    public function getTime(): ?DateTime
    {
        return $this->time;
    }
}
