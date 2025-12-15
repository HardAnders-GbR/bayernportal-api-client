<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Request\Behoerden;

class GetBehoerdeAnsprechpartnerRequest
{
    public function __construct(
        public string $behoerdeId,
    ) {
    }
}
