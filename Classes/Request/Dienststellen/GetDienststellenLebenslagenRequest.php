<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Request\Dienststellen;

class GetDienststellenLebenslagenRequest
{
    public function __construct(
        public int|string $dienststellenschluessel,
    ) {
    }
}
