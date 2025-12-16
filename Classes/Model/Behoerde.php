<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Model;

readonly class Behoerde
{
    public int $id;
    public string $bezeichnung;
    public string $behoerdenart;
    public string $behoerdengruppe;
    public int $sortierreihenfolge;
    public string $kurzbeschreibung;
    public string $email;
    public \stdClass $behoerdenGebaeudeZuordnungen;

    public function __construct(\stdClass $data)
    {
        $this->id = $data->id;
        $this->bezeichnung = $data->bezeichnung ?? '';
        $this->behoerdenart = $data->behoerdenart ?? '';
        $this->behoerdengruppe = $data->behoerdengruppe ?? '';
        $this->sortierreihenfolge = $data->sortierreihenfolge ?? 0;
        $this->kurzbeschreibung = $data->kurzbeschreibung ?? '';
        $this->email = $data->email ?? '';
        $this->behoerdenGebaeudeZuordnungen = $data->behoerdenGebaeudeZuordnungen ?? new \stdClass();
    }
}
