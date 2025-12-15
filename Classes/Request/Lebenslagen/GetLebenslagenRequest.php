<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Request\Lebenslagen;

/**
 * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-lebenslagen
 */
class GetLebenslagenRequest
{
    public function __construct(
        public bool $leistungenZugeordnet,
    ) {
    }

    /**
     * @return array<string, bool>
     */
    public function getQueryParams(): array
    {
        return array_filter([
            'leistungenZugeordnet' => $this->leistungenZugeordnet,
        ]);
    }
}
