<?php

namespace ComposerLockParser;

trait SearcherTrait {

    /**
     * {@inheritDoc}
     */
    public function vendorName(string $vendorName = null): array
    {
        return ['great ! ' . $vendorName . ' Package has been found !'];
    }
}