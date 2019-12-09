<?php

/**
 * Author: mickael Louzet @micklouzet
 * File: PackageCollection.php
 * Created: 07/12/2019
 */

declare(strict_types=1);

namespace ComposerLockParser\Package;

use ComposerLockParser\SearcherTrait;
use ArrayObject;

/**
 * Class PackageCollection
 *
 * @package ComposerLockParser\Package
 */
class PackageCollection extends ArrayObject
{
    use SearcherTrait;

    /** @var array|null */
    public $indexedBy;

    /**
     * @return array|null
     */
    public function getPackages(): ?array
    {
        if (null === $this->indexedBy) {
            return [];
        }
        return $this->getIndexedByName();
    }

    /**
     * @return array|null
     */
    public function getNameSpaces(): ?array
    {
        if (null === $this->indexedBy) {
            return [];
        }
        return $this->getIndexedByNamespace();
    }

    /**
     * @param mixed $index
     * @param Package $package
     *
     * @return void
     */
    public function offsetSet($index, $package): void
    {
        if ($package instanceof Package) {
            $this->indexedBy['name'][$package->getName()] = $package;
            $this->indexedBy['namespace'][$package->getNamespace()] = $package;
        }
        parent::offsetSet($index, $package);
    }
    
    /**
     * @return array|null
     */
    private function getIndexedByName(): ?array
    {
        if (!empty($this->indexedBy['name'])) {
            return $this->indexedBy['name'];
        }
        /** @var Package $package */
        foreach ($this->getArrayCopy() as $package) {
            if (!$package instanceof Package) {
                continue;
            }
            $this->indexedBy['name'][$package->getName()] = $package;
        }
        return $this->indexedBy['name'];
    }

    /**
     * @return array|null
     */
    private function getIndexedByNamespace(): ?array
    {
        if (!empty($this->indexedBy['namespace'])) {
            return $this->indexedBy['namespace'];
        }
        /** @var Package $package */
        foreach ($this->getArrayCopy() as $package) {
            if (!($package instanceof Package)) {
                continue;
            }
        }
        return $this->indexedBy['namespace'][$package->getNamespace()];
    }
}
