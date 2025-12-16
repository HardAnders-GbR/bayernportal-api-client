<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Model;

readonly class Leistung
{
    public int $id;
    public \stdClass|string $bezeichnung;
    public string $url;
    public ?\DateTimeImmutable $letzteAenderung;
    public \stdClass $lebenslagen;
    public \stdClass $synonyme;

    public function __construct(\stdClass $data)
    {
        $this->id = $data->id;
        $this->bezeichnung = $data->bezeichnung ?? '';
        $this->url = $data->url ?? '';
        $this->letzteAenderung = property_exists($data, 'letzteAenderung') ? new \DateTimeImmutable($data->letzteAenderung) : null;
        $this->lebenslagen = $data->lebenslagen ?? new \stdClass();
        $this->synonyme = $data->synonyme ?? new \stdClass();
    }
}
