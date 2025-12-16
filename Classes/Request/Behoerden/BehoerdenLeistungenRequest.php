<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Request\Behoerden;

/**
 * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-behoerden-leistungen
 */
class BehoerdenLeistungenRequest
{
    public function __construct(
        public string|int $behoerdeId,
        public bool $nurDirekteLeistungszuordnungen = true,
    ) {
    }

    /**
     * @return array<string, bool>
     */
    public function getQueryParams(): array
    {
        return array_filter([
            'nurDirekteLeistungszuordnungen' => $this->nurDirekteLeistungszuordnungen,
        ]);
    }
}
