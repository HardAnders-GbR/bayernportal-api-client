<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Request\Ansprechpartner;

/**
 * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-ansprechpartner-ansprechpartner-id
 */
class AnsprechpartnerByIdRequest
{
    public function __construct(
        public string|int $ansprechpartnerId,
    ) {
    }
}
