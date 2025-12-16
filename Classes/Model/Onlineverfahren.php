<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Model;

readonly class Onlineverfahren
{
    /**
     * @param mixed[] $sprache                todo specify type
     * @param mixed[] $identifizierungsmittel todo specify type
     * @param mixed[] $zahlungsweise          todo specify type
     */
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
