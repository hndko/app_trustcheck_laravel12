<?php

namespace App\Services;

use App\Services\Adapters\GoogleSearchAdapter;
use App\Services\Adapters\WebsiteScraperAdapter;

class SearchOrchestrator
{
    protected array $adapters = [];

    public function __construct()
    {
        $this->adapters = [
            new GoogleSearchAdapter(),
            new WebsiteScraperAdapter(),
        ];
    }

    /**
     * Run all adapters to collect public facts about the company.
     *
     * @param string $companyName
     * @return array
     */
    public function aggregate(string $companyName): array
    {
        $results = [];

        foreach ($this->adapters as $adapter) {
            $results[$adapter->getSourceName()] = $adapter->collect($companyName);
        }

        return $results;
    }
}
