<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Request\Behoerden;

/**
 * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-behoerden-ansprechpartner
 */
class BehoerdenAnsprechpartnerRequest
{
    public function __construct(
        public string|int $behoerdeId,
    ) {
    }
}
