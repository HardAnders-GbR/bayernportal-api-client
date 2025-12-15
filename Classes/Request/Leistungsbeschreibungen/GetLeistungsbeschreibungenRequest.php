<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Request\Leistungsbeschreibungen;

/**
 * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-leistungsbeschreibungen
 */
class GetLeistungsbeschreibungenRequest
{
    public function __construct(
        public ?string $gemeindekennziffer = null,
        public bool $mitRegionalenErgaenzungen = false,
        public bool $mitIDallgemeineDaten = false,
    ) {
    }

    /**
     * @return array<string, bool|string>
     */
    public function getQueryParams(): array
    {
        return array_filter([
            'gemeindekennziffer' => $this->gemeindekennziffer,
            'mitRegionalenErgaenzungen' => $this->mitRegionalenErgaenzungen,
            'mitIDallgemeineDaten' => $this->mitIDallgemeineDaten,
        ]);
    }
}
