<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient\Enum;

enum BehoerdenAnsprechpartnerZuordnungen: string
{
    /** Die der angegebenen Leistung direkt zugeordneten Ansprechpartner werden vorrangig ermittelt und zurückgegeben. Sind im jeweiligen Gebäude keine Mitarbeiter der Behörde direkt zuständig, werden alle Mitarbeiter dieser Behörde/Organisationseinheit in diesem Gebäude ausgegeben. */
    case DIREKTBEVORZUGT = 'DIREKTBEVORZUGT';

    /** Nur direkte Ansprechpartner werden ausgegeben. */
    case DIREKT = 'DIREKT';

    /** Alle Mitarbeiter im jeweiligen Gebäude der zuständigen Behörde werden ermittelt und ausgegeben. */
    case ALLE = 'ALLE';

    /** Es werden KEINE Ansprechpartner ausgegeben. */
    case NEIN = 'NEIN';
}
