<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Request\Behoerden;

/**
 * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-behoerden
 */
class BehoerdenRequest
{
    public function __construct(
        public bool $full = false,
        public int $page = 0,
        public int $size = 100,
    ) {
    }

    /**
     * @return array<string, bool|int>
     */
    public function getQueryParams(): array
    {
        return array_filter([
            'full' => $this->full,
            'page' => $this->page,
            'size' => $this->size,
        ]);
    }
}
