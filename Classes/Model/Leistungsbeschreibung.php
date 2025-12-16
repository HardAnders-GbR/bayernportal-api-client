<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Model;

readonly class Leistungsbeschreibung
{
    public \stdClass $bezeichnung;
    public string $url;
    public int $id;
    public \DateTimeImmutable $letzteAenderung;
    public \stdClass $stand;
    public \stdClass $kurzbeschreibung;
    public \stdClass $verantwortlicheBehoerde;
    public \stdClass $synonyme;

    /** @var Lebenslage[] */
    public array $lebenslagen;

    public \stdClass $langbeschreibung;
    public \stdClass $voraussetzungen;
    public \stdClass $verwandteLeistungen;
    public \stdClass $links;
    public \stdClass $verfahrensablauf;
    public \stdClass $fristen;
    public \stdClass $bearbeitungsdauer;
    public \stdClass $unterlagen;
    public \stdClass $kosten;
    public \stdClass $formulare;
    public \stdClass $onlineVerfahren;
    public \stdClass $rechtsvorschriften;
    public \stdClass $rechtsbehelf;

    public function __construct(\stdClass $data)
    {
        $this->bezeichnung = $data->bezeichnung;
        $this->url = $data->url;
        $this->id = $data->id;
        $this->letzteAenderung = new \DateTimeImmutable($data->letzteAenderung);
        $this->stand = $data->stand;
        $this->kurzbeschreibung = $data->kurzbeschreibung;
        $this->verantwortlicheBehoerde = $data->verantwortlicheBehoerde;
        $this->synonyme = $data->synonyme;
        $this->lebenslagen = array_map(fn (\stdClass $data) => new Lebenslage($data), $response->lebenslagen ?? []);
        $this->langbeschreibung = $data->langbeschreibung ?? new \stdClass();
        $this->voraussetzungen = $data->voraussetzungen ?? new \stdClass();
        $this->verwandteLeistungen = $data->verwandteLeistungen ?? new \stdClass();
        $this->links = $data->links ?? new \stdClass();
        $this->verfahrensablauf = $data->verfahrensablauf ?? new \stdClass();
        $this->fristen = $data->fristen ?? new \stdClass();
        $this->bearbeitungsdauer = $data->bearbeitungsdauer ?? new \stdClass();
        $this->unterlagen = $data->unterlagen ?? new \stdClass();
        $this->kosten = $data->kosten ?? new \stdClass();
        $this->formulare = $data->formulare ?? new \stdClass();
        $this->onlineVerfahren = $data->onlineVerfahren ?? new \stdClass();
        $this->rechtsvorschriften = $data->rechtsvorschriften ?? new \stdClass();
        $this->rechtsbehelf = $data->rechtsbehelf ?? new \stdClass();
    }
}
