<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Request\Lebenslagen;

/**
 * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-lebenslagen-lebenslage-id
 */
class LebenslageRequest
{
    public function __construct(
        public string|int $lebenslageId,
    ) {
    }
}
