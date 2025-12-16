<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Model;

readonly class Ansprechpartner
{
    public int $ansprechpartnerId;
    public int $behoerdeId;
    public int $gebaeudeId;
    public string $anrede;
    public string $vorname;
    public string $nachname;
    public string $funktion;
    public string $stellenbezeichnung;
    public string $email;
    public string $website;
    public string $zimmer;
    public string $behoerdeBezeichnung;
    public string $gebaeudeBezeichnung;
    public int $sortierreihenfolge;
    public string $telefonLandvorwahl;
    public string $telefonOrtsvorwahl;
    public string $telefonAnlage;
    public string $telefonDurchwahl;
    public string $faxLandvorwahl;
    public string $faxOrtsvorwahl;
    public string $faxAnlage;
    public string $faxDurchwahl;
    public \stdClass $sprechzeiten;

    public function __construct(\stdClass $data)
    {
        $this->ansprechpartnerId = $data->ansprechpartnerId;
        $this->behoerdeId = $data->behoerdeId;
        $this->gebaeudeId = $data->gebaeudeId;
        $this->anrede = $data->anrede;
        $this->vorname = $data->vorname;
        $this->nachname = $data->nachname;
        $this->funktion = $data->funktion;
        $this->stellenbezeichnung = $data->stellenbezeichnung;
        $this->email = $data->email;
        $this->website = $data->website;
        $this->zimmer = $data->zimmer;
        $this->behoerdeBezeichnung = $data->behoerdeBezeichnung;
        $this->gebaeudeBezeichnung = $data->gebaeudeBezeichnung;
        $this->sortierreihenfolge = $data->sortierreihenfolge ?? 0;
        $this->telefonLandvorwahl = $data->telefonLandvorwahl ?? '';
        $this->telefonOrtsvorwahl = $data->telefonOrtsvorwahl ?? '';
        $this->telefonAnlage = $data->telefonAnlage ?? '';
        $this->telefonDurchwahl = $data->telefonDurchwahl ?? '';
        $this->faxLandvorwahl = $data->faxLandvorwahl ?? '';
        $this->faxOrtsvorwahl = $data->faxOrtsvorwahl ?? '';
        $this->faxAnlage = $data->faxAnlage ?? '';
        $this->faxDurchwahl = $data->faxDurchwahl ?? '';
        $this->sprechzeiten = $data->sprechzeiten ?? new \stdClass();
    }
}
