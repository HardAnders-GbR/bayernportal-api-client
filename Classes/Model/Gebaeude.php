<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Model;

readonly class Gebaeude
{
    public int $behoerdeId;
    public int $gebaeudeId;
    public int $sortierreihenfolge;
    public string $bezeichnung;
    public string $hausanschriftPLZ;
    public string $hausanschriftOrt;
    public string $hausanschriftStrasse;
    public string $postanschriftPLZ;
    public string $postanschriftOrt;
    public string $postanschriftStrasse;
    public \stdClass $oeffnungszeiten;
    public \stdClass $behoerdenAnsprechpartnerZuordnungen;
    public string $telefonLandvorwahl;
    public string $telefonOrtsvorwahl;
    public string $telefonAnlage;
    public string $telefonDurchwahl;
    public string $faxLandvorwahl;
    public string $faxOrtsvorwahl;
    public string $faxAnlage;
    public string $faxDurchwahl;

    public function __construct(\stdClass $data)
    {
        $this->behoerdeId = $data->behoerdeId;
        $this->gebaeudeId = $data->gebaeudeId;
        $this->sortierreihenfolge = $data->sortierreihenfolge ?? 0;
        $this->bezeichnung = $data->bezeichnung ?? '';
        $this->hausanschriftPLZ = $data->hausanschriftPLZ ?? '';
        $this->hausanschriftOrt = $data->hausanschriftOrt ?? '';
        $this->hausanschriftStrasse = $data->hausanschriftStrasse ?? '';
        $this->postanschriftPLZ = $data->postanschriftPLZ ?? '';
        $this->postanschriftOrt = $data->postanschriftOrt ?? '';
        $this->postanschriftStrasse = $data->postanschriftStrasse ?? '';
        $this->oeffnungszeiten = $data->oeffnungszeiten ?? new \stdClass();
        $this->behoerdenAnsprechpartnerZuordnungen = $data->behoerdenAnsprechpartnerZuordnungen ?? new \stdClass();
        $this->telefonLandvorwahl = $data->telefonLandvorwahl ?? '';
        $this->telefonOrtsvorwahl = $data->telefonOrtsvorwahl ?? '';
        $this->telefonAnlage = $data->telefonAnlage ?? '';
        $this->telefonDurchwahl = $data->telefonDurchwahl ?? '';
        $this->faxLandvorwahl = $data->faxLandvorwahl ?? '';
        $this->faxOrtsvorwahl = $data->faxOrtsvorwahl ?? '';
        $this->faxAnlage = $data->faxAnlage ?? '';
        $this->faxDurchwahl = $data->faxDurchwahl ?? '';
    }
}
