<?php

namespace Louzet\ComposerLockFileParser;

trait SearcherTrait {

    /**
     * {@inheritDoc}
     */
    public function vendorName(string $vendorName = null): array
    {
        return ['great ! ' . $vendorName . 'has been found !'];
    }
}