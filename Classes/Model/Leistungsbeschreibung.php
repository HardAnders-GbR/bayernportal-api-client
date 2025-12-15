<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Model;

readonly class Leistungsbeschreibung
{
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
