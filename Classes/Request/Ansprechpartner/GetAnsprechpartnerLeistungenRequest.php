<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Request\Ansprechpartner;

/**
 * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-ansprechpartner-leistungen
 */
class GetAnsprechpartnerLeistungenRequest
{
    public function __construct(
        public string|int $ansprechpartnerId,
        public bool $nurDirekteLeistungszuordnungen,
    ) {
    }

    /**
     * @return array<string, bool>
     */
    public function getQueryParams(): array
    {
        return array_filter([
            'nurDirekteLeistungszuordnungen' => $this->nurDirekteLeistungszuordnungen,
        ]);
    }
}
