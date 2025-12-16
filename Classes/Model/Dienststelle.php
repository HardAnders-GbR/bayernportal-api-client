<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Model;

readonly class Dienststelle
{
    public int $id;
    public string $bezeichnung;
    public string $behoerdenart;
    public string $email;
    public string $website;
    public string $behoerdengruppe;
    public int $sortierreihenfolge;
    public string $dienststellenschluessel;
    public int $dienststelleLfdNr;
    public array $behoerdeZuordnungen;
    public array $behoerdenGebaeudeZuordnungen;
    public string $bezeichnungZusatz;
    public string $mitgliedVonVerwaltungsgemeinschaft;

    public function __construct(\stdClass $data)
    {
        $this->id = $data->id;
        $this->bezeichnung = $data->bezeichnung;
        $this->behoerdenart = $data->behoerdenart;
        $this->email = $data->email;
        $this->website = $data->website;
        $this->behoerdengruppe = $data->behoerdengruppe;
        $this->sortierreihenfolge = $data->sortierreihenfolge;
        $this->dienststellenschluessel = $data->dienststellenschluessel;
        $this->dienststelleLfdNr = $data->dienststelleLfdNr;
        $this->behoerdeZuordnungen = $data->behoerdeZuordnungen->behoerde ?? [];
        $this->behoerdenGebaeudeZuordnungen = $data->behoerdenGebaeudeZuordnungen->gebaeude ?? [];
        $this->bezeichnungZusatz = $data->bezeichnungZusatz ?? '';
        $this->mitgliedVonVerwaltungsgemeinschaft = $data->mitgliedVonVerwaltungsgemeinschaft ?? '';
    }
}
