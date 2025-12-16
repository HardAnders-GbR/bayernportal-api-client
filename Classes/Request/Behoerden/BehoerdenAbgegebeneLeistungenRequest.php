<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Request\Behoerden;

/**
 * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-behoerden-abgegebene-leistungen
 */
class BehoerdenAbgegebeneLeistungenRequest
{
    public function __construct(
        public string|int $behoerdeId,
    ) {
    }
}
