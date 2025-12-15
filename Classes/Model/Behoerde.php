<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Model;

readonly class Behoerde
{
    /**
     * @param array<string, mixed> $behoerdenGebaeudeZuordnungen // todo specify type
     */
    public function __construct(
        public int $id,
        public string $bezeichnung,
        public string $behoerdenart,
        public string $behoerdengruppe,
        public int $sortierreihenfolge,
        public string $kurzbeschreibung = '',
        public string $email = '',
        public array $behoerdenGebaeudeZuordnungen = [],
    ) {
    }
}
