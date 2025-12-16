<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Model;

readonly class Dienststelle
{
    /**
     * @param mixed[] $behoerdeZuordnungen          // todo specify type
     * @param mixed[] $behoerdenGebaeudeZuordnungen // todo specify type
     */
    public function __construct(
        public int $id,
        public string $bezeichnung,
        public string $behoerdenart,
        public string $email,
        public string $website,
        public string $behoerdengruppe,
        public int $sortierreihenfolge,
        public string $dienststellenschluessel,
        public int $dienststelleLfdNr,
        public array $behoerdeZuordnungen = [],
        public array $behoerdenGebaeudeZuordnungen = [],
        public string $bezeichnungZusatz = '',
        public string $mitgliedVonVerwaltungsgemeinschaft = '',
    ) {
    }
}
