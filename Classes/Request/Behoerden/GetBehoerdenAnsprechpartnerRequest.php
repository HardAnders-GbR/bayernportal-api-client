<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Request\Behoerden;

class GetBehoerdenAnsprechpartnerRequest
{
    public function __construct(
        public string $behoerdeId,
    ) {
    }
}
