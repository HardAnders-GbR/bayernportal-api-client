<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Request\Ansprechpartner;

/**
 * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-ansprechpartner
 */
class GetAnsprechpartnerRequest
{
    public function __construct(
        public bool $full = false,
    ) {
    }

    /**
     * @return array<string, bool>
     */
    public function getQueryParams(): array
    {
        return array_filter([
            'full' => $this->full,
        ]);
    }
}
