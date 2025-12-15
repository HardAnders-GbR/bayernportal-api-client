<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Model;

readonly class Leistung
{
    /**
     * @param array<string, mixed>|string $bezeichnung
     * @param mixed[]                     $lebenslagen
     * @param mixed[]                     $synonyme
     */
    public function __construct(
        public int $id,
        public array|string $bezeichnung,
        public string $url = '',
        public ?\DateTimeImmutable $letzteAenderung = null,
        public array $lebenslagen = [],
        public array $synonyme = [],
    ) {
    }
}
