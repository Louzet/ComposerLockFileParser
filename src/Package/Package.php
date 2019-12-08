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
    
    private $time;

    /**
     * @param string        $name
     * @param string        $version
     * @param array         $source
     * @param array         $dist
     * @param array         $require
     * @param array         $requireDev
     * @param array         $suggest
     * @param string        $type
     * @param array         $extra
     * @param array         $autoload
     * @param string        $notificationUrl
     * @param array         $license
     * @param array         $authors
     * @param string        $description
     * @param string        $homepage
     * @param array         $keywords
     * @param DateTime|null $time
     */
    private function __construct(string $name, string $version, array $source, array $dist, array $require,
        array $requireDev, array $suggest, string $type, array $extra, array $autoload, string $notificationUrl, array $license, array $authors, string $description, string $homepage,
        array $keywords, ?DateTime $time)
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

    /**
     * @param array $packageInfo
     *
     * @return Package
     * @throws \Exception
     */
    public static function factory(array $packageInfo): self
    {
        return new self(
            $packageInfo['name'],
            $packageInfo['version'],
            $packageInfo['source'] ?? [],
            $packageInfo['dist'] ?? [],
            $packageInfo['require'] ?? [],
            $packageInfo['require-dev'] ?? [],
            $packageInfo['suggest'] ?? [],
            $packageInfo['type'] ?? '',
            $packageInfo['extra'] ?? [],
            $packageInfo['autoload'] ?? [],
            $packageInfo['notification-url'] ?? '',
            $packageInfo['license'] ?? [],
            $packageInfo['authors'] ?? [],
            $packageInfo['description'] ?? '',
            $packageInfo['homepage'] ?? '',
            $packageInfo['keywords'] ?? [],
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
     * @return array
     */
    public function getSuggest(): array
    {
        return $this->suggest;
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
    public function getExtra(): array
    {
        return $this->extra;
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
        return trim((string)key($namespace), '\\');
    }

    /**
     * @return array
     */
    public function getLicense(): array
    {
        return $this->license;
    }

    /**
     * @return string
     */
    public function getNotificationUrl(): string
    {
        return $this->notificationUrl;
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
     * @return DateTime|null
     */
    public function getTime(): ?DateTime
    {
        return $this->time;
    }
}
