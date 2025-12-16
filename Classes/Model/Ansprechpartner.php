<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Model;

class Ansprechpartner
{
    /**
     * @param mixed[] $sprechzeiten // todo specify type
     */
    public function __construct(
        public int $ansprechpartnerId,
        public int $behoerdeId,
        public int $gebaeudeId,
        public string $anrede = '',
        public string $vorname = '',
        public string $nachname = '',
        public string $funktion = '',
        public string $stellenbezeichnung = '',
        public string $email = '',
        public string $website = '',
        public string $zimmer = '',
        public string $behoerdeBezeichnung = '',
        public string $gebaeudeBezeichnung = '',
        public int $sortierreihenfolge = 0,
        public string $telefonLandvorwahl = '',
        public string $telefonOrtsvorwahl = '',
        public string $telefonAnlage = '',
        public string $telefonDurchwahl = '',
        public string $faxLandvorwahl = '',
        public string $faxOrtsvorwahl = '',
        public string $faxAnlage = '',
        public string $faxDurchwahl = '',
        public array $sprechzeiten = [],
    ) {
    }
}
