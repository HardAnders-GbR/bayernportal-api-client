<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Model;

class LeistungMitFormularen
{
    public function __construct(
        public readonly int $leistungId,
        public readonly string $leistungBezeichnung,
        public string $leistungUrl,
        public array $formulare,
    ) {
    }
}
