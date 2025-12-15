<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Request\Leistungen;

class GetLeistungByIdRequest
{
    public function __construct(
        public string|int $leistungId,
        public ?string $gemeindekennziffer = null,
    ) {
    }

    /**
     * @return array<string, string>
     */
    public function getQueryParams(): array
    {
        return array_filter([
            'gemeindekennziffer' => $this->gemeindekennziffer,
        ]);
    }
}
