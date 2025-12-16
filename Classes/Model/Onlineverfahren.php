<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Model;

readonly class Onlineverfahren
{
    public function __construct(
        public int $id,
        public string $kurzbeschreibung,
        public string $langbeschreibung,
        public string $hilfetext,
        public array $sprache,
        public array $identifizierungsmittel,
        public array $zahlungsweise,
    ) {
    }
}
