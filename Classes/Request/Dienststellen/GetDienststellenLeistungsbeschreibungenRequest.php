<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Request\Dienststellen;

/**
 * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-dienststellen-leistungsbeschreibungen
 */
class GetDienststellenLeistungsbeschreibungenRequest
{
    public function __construct(
        public string|int $dienststellenschluessel,
        public string|int $gemeindekennziffer,
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
