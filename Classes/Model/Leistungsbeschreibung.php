<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Model;

/**
 * todo: Declare properties.
 */
#[\AllowDynamicProperties] class Leistungsbeschreibung
{
    /**
     * @param mixed[] $data
     */
    public function __construct(
        array $data,
    ) {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
