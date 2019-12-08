<?php

namespace ComposerLockParser;

use ComposerLockParser\Package\Package;

trait SearcherTrait {

    /**
     * @param string $name
     *
     * @return Package
     */
    public function getByName(string $name): Package
    {
        if (!$this->nameExists($name)) {
            throw new \UnexpectedValueException(sprintf('Sorry, Package %s not found !', $name));
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
        if (!$this->namespaceExists($namespace)) {
            throw new \UnexpectedValueException(sprintf('Sorry, namespace %s not found !', $namespace));
        }
        return $this->getIndexedByNamespace()[$namespace];
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function nameExists(string $name): bool
    {
        return array_key_exists($name, $this->getIndexedByName());
    }

    /**
     * @param string $namespace
     *
     * @return bool
     */
    public function namespaceExists($namespace): bool
    {
        return array_key_exists($namespace, $this->getIndexedByNamespace());
    }
}
