<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Request\Dienststellen;

/**
 * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-dienststellen-leistungen
 */
class DienststellenLeistungenRequest
{
    public function __construct(
        public string $dienststellenschluessel,
        public ?string $gemeindekennziffer = null,
    ) {
    }

    /**
     * @return array<string, string>
     */
    public function getQueryParams(): array
    {
        return array_filter([
            'gemeindekennziffer' => $this->gemeindekennziffer,
        ]);
    }
}
