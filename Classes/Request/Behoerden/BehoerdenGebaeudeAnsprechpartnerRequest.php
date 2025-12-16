<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Request\Behoerden;

/**
 * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-behoerden-gebaeude-ansprechpartner
 */
class BehoerdenGebaeudeAnsprechpartnerRequest
{
    public function __construct(
        public string|int $behoerdeId,
        public string|int $gebaeudeId,
        public string|int $ansprechpartnerId,
    ) {
    }
}
