<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Request\Dienststellen;

/**
 * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-dienststellen-onlineverfahren
 */
class DienststellenOnlineverfahrenRequest
{
    public function __construct(
        public string|int $dienststellenschluessel,
        public ?string $gemeindekennziffer = null,
        public bool $gruppiertNachLeistungen = true,
    ) {
    }

    /**
     * @return array<string, string|bool>
     */
    public function getQueryParams(): array
    {
        return array_filter([
            'gemeindekennziffer' => $this->gemeindekennziffer,
            'gruppiertNachLeistungen' => $this->gruppiertNachLeistungen,
        ]);
    }
}
