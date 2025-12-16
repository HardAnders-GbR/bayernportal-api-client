<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Request\Leistungen;

/**
 * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-leistungen
 */
class LeistungenRequest
{
    public function __construct(
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
