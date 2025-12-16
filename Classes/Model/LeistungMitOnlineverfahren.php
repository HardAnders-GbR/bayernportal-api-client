<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Model;

readonly class LeistungMitOnlineverfahren
{
    public int $leistungId;
    public string $leistungBezeichnung;
    public string $leistungUrl;
    public \stdClass $onlineverfahren;

    public function __construct(\stdClass $data)
    {
        $this->leistungId = $data->leistungId;
        $this->leistungBezeichnung = $data->leistungBezeichnung;
        $this->leistungUrl = $data->leistungUrl;
        $this->onlineverfahren = $data->onlineverfahren;
    }
}
