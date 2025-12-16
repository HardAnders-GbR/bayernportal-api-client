<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Request\Behoerden;

class GetBehoerdenAbgegebeneLeistungenRequest
{
    public function __construct(
        public string $behoerdeId,
    ) {
    }
}
