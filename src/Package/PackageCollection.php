<?php

/**
 * Author: mickael Louzet @micklouzet
 * File: Package.php
 * Created: 07/12/2019
 */

declare(strict_types=1);

namespace ComposerLockParser\Package;

use ComposerLockParser\SearcherTrait;
use ComposerLockParser\Package\Package;
use ArrayObject;

/**
 * Class PackageCollection
 *
 * @package ComposerLockParser\Package
 */
class PackageCollection extends ArrayObject
{
    use SearcherTrait;

    /** @var array */
    private $indexedBy;

    /**
     * @return array
     */
    public function getPackages(): array
    {
        return $this->getIndexedByName();
    }

    /**
     * @return array
     */
    public function getNameSpaces(): array
    {
        return array_keys($this->getIndexedByNamespace());
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
     * @return array
     */
    private function getIndexedByName(): array
    {
        if (!empty($this->indexedBy['name'])) {
            return $this->indexedBy['name'];
        }
        /** @var Package $package */
        foreach($this->getArrayCopy() as $package) {
            if (!($package instanceof Package)) {
                continue;
            }
            $this->indexedBy['name'][$package->getName()] = $package;
        }
        return $this->indexedBy['name'];
    }

    /**
     * @return array
     */
    private function getIndexedByNamespace(): array
    {
        if (!empty($this->indexedBy['namespace'])) {
            return $this->indexedBy['namespace'];
        }
        /** @var Package $package */
        foreach($this->getArrayCopy() as $package) {
            if (!($package instanceof Package)) {
                continue;
            }
        }
        return $this->indexedBy['namespace'][$package->getNamespace()];
    }
}
