<?php

namespace App\Services\Adapters;

interface SourceAdapterInterface
{
    /**
     * Search or fetch raw data for a given company query.
     *
     * @param string $companyName
     * @return array
     */
    public function collect(string $companyName): array;

    /**
     * Get the identifier name of this source adapter.
     *
     * @return string
     */
    public function getSourceName(): string;
}
