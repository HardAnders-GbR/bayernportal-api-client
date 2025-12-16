<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Model;

readonly class Leistungsbeschreibung
{
    /**
     * @param mixed[] $bezeichnung
     * @param mixed[] $stand
     * @param mixed[] $kurzbeschreibung
     * @param mixed[] $verantwortlicheBehoerde
     * @param mixed[] $synonyme
     * @param mixed[] $lebenslagen
     * @param mixed[] $langbeschreibung
     * @param mixed[] $voraussetzungen
     * @param mixed[] $verwandteLeistungen
     * @param mixed[] $links
     * @param mixed[] $verfahrensablauf
     * @param mixed[] $fristen
     * @param mixed[] $bearbeitungsdauer
     * @param mixed[] $unterlagen
     * @param mixed[] $kosten
     * @param mixed[] $formulare
     * @param mixed[] $onlineVerfahren
     * @param mixed[] $rechtsvorschriften
     * @param mixed[] $rechtsbehelf
     */
    public function __construct(
        public array $bezeichnung,
        public string $url,
        public int $id,
        public \DateTimeImmutable $letzteAenderung,
        public array $stand,
        public array $kurzbeschreibung = [],
        public array $verantwortlicheBehoerde = [],
        public array $synonyme = [],
        public array $lebenslagen = [],
        public array $langbeschreibung = [],
        public array $voraussetzungen = [],
        public array $verwandteLeistungen = [],
        public array $links = [],
        public array $verfahrensablauf = [],
        public array $fristen = [],
        public array $bearbeitungsdauer = [],
        public array $unterlagen = [],
        public array $kosten = [],
        public array $formulare = [],
        public array $onlineVerfahren = [],
        public array $rechtsvorschriften = [],
        public array $rechtsbehelf = [],
    ) {
    }
}
