<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Model;

readonly class LeistungMitOnlineverfahren
{
    /**
     * @param mixed[] $onlineverfahren todo specify type
     */
    public function __construct(
        public int $leistungId,
        public string $leistungBezeichnung,
        public string $leistungUrl,
        public array $onlineverfahren,
    ) {
    }
}
