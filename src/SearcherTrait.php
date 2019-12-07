<?php

namespace ComposerLockFileParser;

trait SearcherTrait {

    /**
     * {@inheritDoc}
     */
    public function vendorName(string $vendorName = null): array
    {
        return ['great ! ' . $vendorName . ' package has been found !'];
    }
}