<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Model;

class LeistungMitFormularen
{
    public readonly int $leistungId;
    public readonly string $leistungBezeichnung;
    public string $leistungUrl;
    public \stdClass $formulare;

    public function __construct(\stdClass $data)
    {
        $this->leistungId = $data->leistungId;
        $this->leistungBezeichnung = $data->leistungBezeichnung;
        $this->leistungUrl = $data->leistungUrl;
        $this->formulare = $data->formulare;
    }
}
