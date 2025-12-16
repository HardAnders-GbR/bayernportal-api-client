<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Request\Dienststellen;

/**
 * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-dienststellen-dienststellenschluessel
 */
class DienststelleRequest
{
    public function __construct(
        public string|int $dienststellenschluessel,
        public ?string $gemeindekennziffer = null,
    ) {
    }

    /**
     * @return array<string, string|int>
     */
    public function getQueryParams(): array
    {
        return array_filter([
            'gemeindekennziffer' => $this->gemeindekennziffer,
        ]);
    }
}
