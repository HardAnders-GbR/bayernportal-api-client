<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Request\Behoerden;

/**
 * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-behoerden-gebaeude-ansprechpartner
 */
class GetBehoerdenGebaeudeAnsprechpartnerRequest
{
    public function __construct(
        public string $behoerdeId,
        public string $gebaeudeId,
        public string $ansprechpartnerId,
    ) {
    }
}
