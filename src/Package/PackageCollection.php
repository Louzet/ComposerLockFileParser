<?php

/**
 * Author: mickael Louzet @micklouzet
 * File: Package.php
 * Created: 07/12/2019
 */

declare(strict_types=1);

namespace ComposerLockParser\Package;

use ComposerLockParser\Package\Package;
use ArrayObject;

class PackageCollection extends ArrayObject
{

    /** @var array */
    private $indexedBy;

    /**
     * @param string $name
     *
     * @return Package
     */
    public function getByName(string $name): Package
    {
        if (!$this->hasByName($name)) {
            throw new \UnexpectedValueException(sprintf('Sorry, package %s not found !', $name));
        }
        return $this->getIndexedByName()[$name];
    }

    /**
     * @param string $namespace
     *
     * @return Package
     */
    public function getByNamespace(string $namespace): Package
    {
        if (!$this->hasByNamespace($namespace)) {
            throw new \UnexpectedValueException(sprintf('Sorry, namespace %s not found !', $namespace));
        }
        return $this->getIndexedByNamespace()[$namespace];
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasByName(string $name): bool
    {
        return array_key_exists($name, $this->getIndexedByName());
    }

    /**
     * @param string $namespace
     *
     * @return bool
     */
    public function hasByNamespace($namespace): bool
    {
        return array_key_exists($namespace, $this->getIndexedByNamespace());
    }

    /**
     * @param mixed $index
     * @param mixed $package
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
            $this->indexedBy['namespace'][$package->getNamespace()] = $package;
        }
        return $this->indexedBy['namespace'];
    }
}
