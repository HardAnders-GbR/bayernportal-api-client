<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Request\Leistungsbeschreibungen;

/**
 * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-dienststellen-leistungsbeschreibungen
 */
class GetLeistungsbeschreibungenVonDienststelleRequest
{
    public function __construct(
        public string $dienststellenschluessel,
        public string $gemeindekennziffer,
        public bool $mitRegionalenErgaenzungen = false,
        public bool $mitZustaendigkeiten = false,
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
            'mitZustaendigkeiten' => $this->mitZustaendigkeiten,
            'mitIDallgemeineDaten' => $this->mitIDallgemeineDaten,
        ]);
    }
}
