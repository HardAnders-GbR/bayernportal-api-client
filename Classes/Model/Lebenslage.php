<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Model;

readonly class Lebenslage
{
    /**
     * @param mixed[] $synonyme   todo specify type
     * @param mixed[] $leistungen todo specify type
     */
    public function __construct(
        public string $bezeichnung,
        public string $kurzbeschreibung,
        public string $langbeschreibung,
        public string $kategorie,
        public string $vorgaengerId,
        public \DateTimeImmutable $stand,
        public array $synonyme,
        public array $leistungen,
        public string $id,
    ) {
    }
}
