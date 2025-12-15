<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Request\Leistungsbeschreibungen;

use Hardanders\BayernPortalApiClient\Enum\BehoerdenAnsprechpartnerZuordnungen;

/**
 * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-leistungsbeschreibungen-leistung-id
 */
class GetLeistungsbeschreibungByIdRequest
{
    /**
     * @param string $gemeindekennziffer        8-stelliger Amtlicher Gemeindeschlüssel eines Ortes in Bayern, für den der Response lokalisiert werden soll (z.B. 09162000 für München).
     * @param bool   $mitRegionalenErgaenzungen true (Default): Es werden regionale Ergänzungen passend zur gemeindekennziffer bei den Leistungsbeschreibungen geliefert. false: Es werden keine regionale Ergänzungen bei den Leistungsbeschreibungen geliefert.
     * @param bool   $sicheresKontaktformular   true : der Link auf das "Sichere Kontaktformular" der Behörde (im Bereich "Zuständigkeiten") wird ggf. mitgeliefert. false : Ohne Ermittlung des Links auf das "Sichere Kontaktformular" - Default
     */
    public function __construct(
        public string|int $leistungId,
        public ?string $gemeindekennziffer = null,
        public bool $mitRegionalenErgaenzungen = true,
        public bool $sicheresKontaktformular = false,
        public BehoerdenAnsprechpartnerZuordnungen $behoerdenAnsprechpartnerZuordnungen = BehoerdenAnsprechpartnerZuordnungen::DIREKTBEVORZUGT,
        public bool $mitIDallgemeineDaten = false,
    ) {
    }

    /**
     * @return array<string, bool|string>
     */
    public function getQueryParams(): array
    {
        return array_filter([
            'gemeindekennziffer' => $this->gemeindekennziffer,
            'mitRegionalenErgaenzungen' => $this->mitRegionalenErgaenzungen,
            'sicheresKontaktformular' => $this->sicheresKontaktformular,
            'behoerdenAnsprechpartnerZuordnungen' => $this->behoerdenAnsprechpartnerZuordnungen->value,
            'mitIDallgemeineDaten' => $this->mitIDallgemeineDaten,
        ]);
    }
}
