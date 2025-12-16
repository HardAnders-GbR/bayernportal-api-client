<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Model;

readonly class Gebaeude
{
    /**
     * @param mixed[] $oeffnungszeiten                     todo define type
     * @param mixed[] $behoerdenAnsprechpartnerZuordnungen todo define type
     */
    public function __construct(
        public int $behoerdeId,
        public int $gebaeudeId,
        public int $sortierreihenfolge,
        public string $bezeichnung = '',
        public string $hausanschriftPLZ = '',
        public string $hausanschriftOrt = '',
        public string $hausanschriftStrasse = '',
        public string $postanschriftPLZ = '',
        public string $postanschriftOrt = '',
        public string $postanschriftStrasse = '',
        public array $oeffnungszeiten = [],
        public array $behoerdenAnsprechpartnerZuordnungen = [],
        public string $telefonLandvorwahl = '',
        public string $telefonOrtsvorwahl = '',
        public string $telefonAnlage = '',
        public string $telefonDurchwahl = '',
        public string $faxLandvorwahl = '',
        public string $faxOrtsvorwahl = '',
        public string $faxAnlage = '',
        public string $faxDurchwahl = '',
    ) {
    }
}
