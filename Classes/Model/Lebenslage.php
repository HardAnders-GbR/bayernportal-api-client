<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Model;

readonly class Lebenslage
{
    public string $id;
    public string $bezeichnung;
    public string $kurzbeschreibung;
    public string $langbeschreibung;
    public string $kategorie;
    public string $vorgaengerId;
    public \DateTimeImmutable $stand;
    public \stdClass $synonyme;
    public \stdClass $leistungen;

    public function __construct(\stdClass $data)
    {
        $this->id = $data->id;
        $this->bezeichnung = $data->bezeichnung;
        $this->kurzbeschreibung = $data->kurzbeschreibung;
        $this->langbeschreibung = $data->langbeschreibung;
        $this->kategorie = $data->kategorie;
        $this->vorgaengerId = $data->vorgaengerId;
        $this->stand = new \DateTimeImmutable($data->stand);
        $this->synonyme = $data->synonyme;
        $this->leistungen = $data->leistungen;
    }
}
