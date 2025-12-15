<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Request\Dienststellen;

/**
 * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-dienststellen
 */
class GetDienststellenRequest
{
    /**
     * @param bool $full true : vollständige Daten zur Dienststelle zurückgeben false : Daten in Kurzform zurückgeben - Default (nicht Logo, Kurzbeschreibung, Langbeschreibung, Behördenzuordnungen, Gebäudezuordnungen)
     * @param int  $page integer (>= 0) 0-basierter Index der anzuzeigenden Teilseite / Teilmenge default: 0 min: 0 max: [positive Ganzahl] = Menge aller gefundenen Dienststellen - 1
     * @param int  $size integer (>= 0). Anzahl der Dienststellen pro Teilseite / Teilmenge default: 100 min: 1 max: 100
     */
    public function __construct(
        public bool $full = true,
        public int $page = 0,
        public int $size = 100,
    ) {
    }

    /**
     * @return array<string, bool|int>
     */
    public function getQueryParams(): array
    {
        return array_filter([
            'full' => $this->full,
            'page' => $this->page,
            'size' => $this->size,
        ]);
    }
}
