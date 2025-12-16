<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Request\Dienststellen;

/**
 * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-dienststellen-lebenslagen
 */
class DienststellenLebenslagenRequest
{
    public function __construct(
        public string|int $dienststellenschluessel,
    ) {
    }
}
