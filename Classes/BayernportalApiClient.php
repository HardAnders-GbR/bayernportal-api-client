<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient;

use Hardanders\BayernPortalApiClient\Model\Gebaeude;
use Hardanders\BayernPortalApiClient\Model\Leistung;
use Hardanders\BayernPortalApiClient\Request\Ansprechpartner\GetAnsprechpartnerByIdRequest;
use Hardanders\BayernPortalApiClient\Request\Ansprechpartner\GetAnsprechpartnerLeistungenRequest;
use Hardanders\BayernPortalApiClient\Request\Ansprechpartner\GetAnsprechpartnerRequest;
use Hardanders\BayernPortalApiClient\Request\Behoerden\GetBehoerdenAbgegebeneLeistungenRequest;
use Hardanders\BayernPortalApiClient\Request\Behoerden\GetBehoerdenAnsprechpartnerRequest;
use Hardanders\BayernPortalApiClient\Request\Behoerden\GetBehoerdenGebaeudeAnsprechpartnerRequest;
use Hardanders\BayernPortalApiClient\Request\Behoerden\GetBehoerdenGebaeudeRequest;
use Hardanders\BayernPortalApiClient\Request\Behoerden\GetBehoerdenLeistungenRequest;
use Hardanders\BayernPortalApiClient\Request\Behoerden\GetBehoerdenRequest;
use Hardanders\BayernPortalApiClient\Request\Behoerden\GetBehoerdeRequest;
use Hardanders\BayernPortalApiClient\Request\Dienststellen\GetDienststellenFormulareRequest;
use Hardanders\BayernPortalApiClient\Request\Dienststellen\GetDienststellenLebenslagenRequest;
use Hardanders\BayernPortalApiClient\Request\Dienststellen\GetDienststellenLeistungenRequest;
use Hardanders\BayernPortalApiClient\Request\Dienststellen\GetDienststellenLeistungsbeschreibungenRequest;
use Hardanders\BayernPortalApiClient\Request\Dienststellen\GetDienststellenOnlineverfahrenRequest;
use Hardanders\BayernPortalApiClient\Request\Dienststellen\GetDienststellenRequest;
use Hardanders\BayernPortalApiClient\Request\Dienststellen\GetDienststelleRequest;
use Hardanders\BayernPortalApiClient\Request\Lebenslagen\GetLebenslagenRequest;
use Hardanders\BayernPortalApiClient\Request\Lebenslagen\GetLebenslageRequest;
use Hardanders\BayernPortalApiClient\Request\Leistungen\GetLeistungenRequest;
use Hardanders\BayernPortalApiClient\Request\Leistungen\GetLeistungRequest;
use Hardanders\BayernPortalApiClient\Request\Leistungsbeschreibungen\GetLeistungsbeschreibungenRequest;
use Hardanders\BayernPortalApiClient\Request\Leistungsbeschreibungen\GetLeistungsbeschreibungRequest;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BayernportalApiClient
{
    private HttpClientInterface $client;

    private Serializer $serializer;

    public function __construct(
        public string $username,
        public string $password,
        public string $gemeindekennziffer,
        public string $baseUrl = 'https://www.bayernportal-webservices.bayern.de/rest/allgemein/v3/',
    ) {
        $this->client = HttpClient::createForBaseUri(
            $baseUrl,
            [
                'auth_basic' => [$username, $password],
                'headers' => ['accept' => 'application/json'],
            ]
        );

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $this->serializer = new Serializer($normalizers, $encoders);
    }

    /**
     * Gibt alle Dienststellen zurück, auf welche die Benutzerkennung Zugriff hat.
     *
     * GET /rest/allgemein/v3/dienststellen
     *
     * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-dienststellen
     *
     * @return Model\Dienststelle[]
     */
    public function getDienststellen(GetDienststellenRequest $request): array
    {
        $endpoint = 'dienststellen';

        $response = $this->request(
            $endpoint,
            $request->getQueryParams(),
        );

        $return = [];

        foreach ($response['dienststelle'] ?? [] as $dienststelleData) {
            $return[] = $this->serializer->deserialize(json_encode($dienststelleData), Model\Dienststelle::class, 'json');
        }

        return $return;
    }

    /**
     * Gibt alle Dienststellen zurück, auf welche die Benutzerkennung Zugriff hat.
     *
     * GET /rest/allgemein/v3/dienststellen/{dienststellenschluessel}
     *
     * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-dienststellen
     */
    public function getDienststelle(GetDienststelleRequest $request): ?Model\Dienststelle
    {
        $endpoint = sprintf('dienststellen/%s', $request->dienststellenschluessel);

        $response = $this->request(
            $endpoint,
            $request->getQueryParams(),
        );

        return $response ? $this->serializer->deserialize(json_encode($response['dienststelle'][0]), Model\Dienststelle::class, 'json') : null;
    }

    /**
     * Gibt die Leistungen der Dienststelle mit dem angegebenen Dienststellenschlüssel zurück.
     *
     * GET /rest/allgemein/v3/dienststellen/{dienststellenschluessel}/leistungen
     *
     * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-dienststellen-leistungen
     *
     * @return Leistung[]
     */
    public function getDienststellenLeistungen(GetDienststellenLeistungenRequest $request): array
    {
        $endpoint = sprintf('dienststellen/%s/leistungen', $request->dienststellenschluessel);

        $response = $this->request(
            $endpoint,
            $request->getQueryParams(),
        );

        $return = [];

        foreach ($response['leistung'] ?? [] as $data) {
            $return[] = $this->serializer->deserialize(json_encode($data), Leistung::class, 'json');
        }

        return $return;
    }

    /**
     * Gibt die Formulare der Dienststelle mit dem angegebenen Dienststellenschlüssel zurück.
     *
     * GET /rest/allgemein/v3/dienststellen/{dienststellenschluessel}/formulare
     *
     * @return Model\LeistungMitFormularen[]
     */
    public function getDienststellenFormulare(GetDienststellenFormulareRequest $request): array
    {
        $endpoint = sprintf('dienststellen/%s/formulare', $request->dienststellenschluessel);

        $response = $this->request(
            $endpoint,
            $request->getQueryParams(),
        );

        $return = [];

        foreach ($response['leistungMitFormularen'] ?? [] as $data) {
            $return[] = $this->serializer->deserialize(json_encode($data), Model\LeistungMitFormularen::class, 'json');
        }

        return $return;
    }

    /**
     * Gibt die Onlineverfahen der Dienststelle mit dem angegebenen Dienststellenschlüssel zurück.
     *
     * GET /rest/allgemein/v3/dienststellen/{dienststellenschluessel}/onlineverfahren
     *
     * @return Model\LeistungMitOnlineverfahren[]
     */
    public function getDienststellenOnlineverfahren(GetDienststellenOnlineverfahrenRequest $request): array
    {
        $endpoint = sprintf('dienststellen/%s/onlineverfahren', $request->dienststellenschluessel);

        $response = $this->request(
            $endpoint,
            $request->getQueryParams(),
        );

        $return = [];

        foreach ($response['leistungMitOnlineverfahren'] ?? [] as $item) {
            $return[] = $this->serializer->deserialize(json_encode($item), Model\LeistungMitOnlineverfahren::class, 'json');
        }

        return $return;
    }

    /**
     * Gibt die Lebenslagen für die Dienststelle mit dem angegebenen Dienststellenschlüssel zurück.
     *
     * GET /rest/allgemein/v3/dienststellen/{dienststellenschluessel}/lebenslagen
     *
     * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-dienststellen-lebenslagen
     *
     * @return Model\Lebenslage[]
     */
    public function getDienststellenLebenslagen(GetDienststellenLebenslagenRequest $request): array
    {
        $endpoint = sprintf('dienststellen/%s/lebenslagen', $request->dienststellenschluessel);

        $response = $this->request(
            $endpoint,
        );

        $return = [];

        foreach ($response['lebenslage'] ?? [] as $item) {
            $return[] = $this->serializer->deserialize(json_encode($item), Model\Lebenslage::class, 'json');
        }

        return $return;
    }

    /**
     * Gibt die Ansprechpartner der Behörde mit der angegebenen Id zurück.
     *
     * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-behoerden-ansprechpartner
     *
     * GET /rest/allgemein/v3/behoerden/{behoerde-id}/ansprechpartner
     *
     * @return Model\Ansprechpartner[]
     */
    public function getBehoerdeAnsprechpartner(GetBehoerdenAnsprechpartnerRequest $request): array
    {
        $endpoint = sprintf('behoerden/%s/ansprechpartner', $request->behoerdeId);

        $response = $this->request($endpoint);

        $return = [];

        foreach ($response['ansprechpartner']['ap'] ?? [] as $ap) {
            $return[] = $this->serializer->deserialize(json_encode($ap), Model\Ansprechpartner::class, 'json');
        }

        return $return;
    }

    /**
     * Gibt eine vollständige Repräsentation des Ansprechpartner mit der angegebenen Id zurück
     * (auch Logo, Kommunikationsdaten, Sprechzeiten und direkt zugeordnete Leistungen).
     * Die Id des Ansprechpartners ist ein eindeutiger numerischer Wert, den Sie aus einem vorherigen Webservice-Aufruf als Referenz-Id erhalten haben.
     *
     * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-ansprechpartner-ansprechpartner-id
     *
     * GET /rest/allgemein/v3/ansprechpartner/{ansprechpartner-id}
     */
    public function getAnsprechpartnerById(GetAnsprechpartnerByIdRequest $request): ?Model\Ansprechpartner
    {
        $endpoint = sprintf('ansprechpartner/%s', $request->ansprechpartnerId);

        $response = $this->request($endpoint);

        return $response['ap'] ? $this->serializer->deserialize(json_encode($response['ap'][0]), Model\Ansprechpartner::class, 'json') : null;
    }

    /**
     * Gibt die Leistungsbeschreibungen der Dienststelle mit dem angegebenen Dienststellenschlüssel zurück.
     *
     * GET /rest/allgemein/v3/dienststellen/{dienststellenschluessel}/leistungsbeschreibungen
     *
     * @return Model\Leistungsbeschreibung[]
     */
    public function getDienststellenLeistungsbeschreibungen(GetDienststellenLeistungsbeschreibungenRequest $request): array
    {
        $endpoint = sprintf('dienststellen/%s/leistungsbeschreibungen', $request->dienststellenschluessel);

        $response = $this->request(
            $endpoint,
            $request->getQueryParams(),
        );

        $return = [];

        foreach ($response['leistungsbeschreibung'] ?? [] as $data) {
            $return[] = $this->serializer->deserialize(json_encode($data), Model\Leistungsbeschreibung::class, 'json');
        }

        return $return;
    }

    /**
     * Gibt eine Liste aller Leistungenbeschreibungen ohne Zuständigkeiten-Block zurück.
     * Zur Abfrage der Zuständigkeiten sind
     * - Einzelaufrufe der Ressource /rest/allgemein/v3/leistungsbeschreibungen/{leistung-id} oder
     * - der Aufruf der Ressource /rest/allgemein/v3/dienststellen/{dienststellenschluessel}/leistungsbeschreibungen mit dem entsprechenden Aufrufparameter
     * notwendig.
     *
     * GET /rest/allgemein/v3/leistungsbeschreibungen
     *
     * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-leistungsbeschreibungen
     *
     * @return Model\Leistungsbeschreibung[]
     */
    public function getLeistungsbeschreibungen(GetLeistungsbeschreibungenRequest $request): array
    {
        $endpoint = 'leistungsbeschreibungen';

        $response = $this->request(
            $endpoint,
            $request->getQueryParams(),
        );

        $return = [];

        foreach ($response['leistungsbeschreibung'] as $leistungsbeschreibungData) {
            $return[] = $this->serializer->deserialize(json_encode($leistungsbeschreibungData), Model\Leistungsbeschreibung::class, 'json');
        }

        return $return;
    }

    /**
     * Gibt die Leistungbeschreibung mit der angegebenen Id zurück.
     *
     * GET /rest/allgemein/v3/leistungsbeschreibungen/{leistung-id}
     */
    public function getLeistungsbeschreibung(GetLeistungsbeschreibungRequest $request): ?Model\Leistungsbeschreibung
    {
        $endpoint = sprintf('leistungsbeschreibungen/%s', $request->leistungId);

        $response = $this->request(
            $endpoint,
            $request->getQueryParams(),
        );

        return $this->serializer->deserialize(json_encode($response['leistungsbeschreibung']), Model\Leistungsbeschreibung::class, 'json');
    }

    /**
     * Gibt alle Behörden zurück, auf welche die Benutzerkennung Zugriff hat.
     *
     * GET /rest/allgemein/v3/behoerden
     *
     * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-behoerden
     *
     * @return Model\Behoerde[]
     */
    public function getBehoerden(GetBehoerdenRequest $request): array
    {
        $endpoint = 'behoerden';

        $response = $this->request(
            $endpoint,
            $request->getQueryParams(),
        );

        $return = [];

        foreach ($response['behoerde'] ?? [] as $behoerdeData) {
            $return[] = $this->serializer->deserialize(json_encode($behoerdeData), Model\Behoerde::class, 'json');
        }

        return $return;
    }

    /**
     * Gibt eine vollständige Repräsentation der Behörde mit der angegebenen Id zurück.
     * Die Id der Behörde ist ein eindeutiger numerischer Wert, den Sie aus einem vorherigen Webservice-Zugriff als Referenz-Id erhalten haben.
     *
     * GET /rest/allgemein/v3/behoerden/{behoerde-id}
     *
     * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-behoerden-behoerde-id
     */
    public function getBehoerde(GetBehoerdeRequest $request): ?Model\Behoerde
    {
        $endpoint = sprintf('behoerden/%s', $request->behoerdeId);

        $response = $this->request(
            $endpoint,
        );

        return $response ? $this->serializer->deserialize(json_encode($response['behoerde']), Model\Behoerde::class, 'json') : null;
    }

    /**
     * Gibt eine Repräsentation eines Gebäudes der Behörde mit der angegebenen Id zurück.
     * Die Id der Behörde und des Gebäudes sind eindeutige numerische Werte, die Sie aus einem vorherigen Webservice-Zugriff als Referenz-Ids erhalten haben.
     *
     * GET /rest/allgemein/v3/behoerden/{behoerde-id}/gebaeude/{gebaeude-id}
     *
     * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-behoerden-gebaeude
     */
    public function getBehoerdenGebaeude(GetBehoerdenGebaeudeRequest $request): ?Gebaeude
    {
        $endpoint = sprintf('behoerden/%s/gebaeude/%s', $request->behoerdeId, $request->gebaeudeId);

        $response = $this->request($endpoint);

        return $response ? $this->serializer->deserialize(json_encode($response['behoerdenGebaeude']), Gebaeude::class, 'json') : null;
    }

    /**
     * Gibt eine Liste aller Leistungen zurück, die der Behörde mit der angegebenen Id zugeordnet sind.
     * Die Id der Behörde ist ein eindeutiger numerischer Wert, den Sie aus einem vorherigen Webservice-Aufruf als Referenz-Id erhalten haben.
     *
     * GET /rest/allgemein/v3/behoerden/{behoerde-id}/leistungen
     *
     * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-behoerden-leistungen
     *
     * @return Leistung[] returns empty array if no leistungen are found
     */
    public function getBehoerdenLeistungen(GetBehoerdenLeistungenRequest $request): array
    {
        $endpoint = sprintf('behoerden/%s/leistungen', $request->behoerdeId);

        $response = $this->request(
            $endpoint,
            $request->getQueryParams()
        );

        $return = [];

        foreach ($response['leistung'] ?? [] as $leistung) {
            $return[] = $this->serializer->deserialize(json_encode($leistung), Leistung::class, 'json');
        }

        return $return;
    }

    /**
     * Gibt eine Liste aller Leistungen zurück, die der Behörde mit der angegebenen Id zugeordnet sind. Die Id der Behörde ist ein eindeutiger numerischer Wert, den Sie aus einem vorherigen Webservice-Aufruf als Referenz-Id erhalten haben.
     *
     * GET /rest/allgemein/v3/behoerden/{behoerde-id}/abgegebene-leistungen
     *
     * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-behoerden-abgegebene-leistungen
     *
     * @return Leistung[]
     */
    public function getBehoerdenAbgegebeneLeistungen(GetBehoerdenAbgegebeneLeistungenRequest $request): array
    {
        $endpoint = sprintf('behoerden/%s/abgegebene-leistungen', $request->behoerdeId);

        $response = $this->request($endpoint);

        $return = [];

        foreach ($response['leistung'] ?? [] as $leistung) {
            $return[] = $this->serializer->deserialize(json_encode($leistung), Leistung::class, 'json');
        }

        return $return;
    }

    /**
     * Gibt eine Repräsentation des Ansprechpartners mit der angegebenen Id zurück.
     * Der Ansprechpartner gehört zur Behörde mit der angegeben Id und dem Gebäude mit der angegebenen Id.
     * Die Id der Behörde, des Gebäudes und des Ansprechpartners sind eindeutige numerische Werte, die Sie aus einem vorherigen Webservice-Aufruf als Referenz-Ids erhalten haben.
     *
     * GET /rest/allgemein/v3/behoerden/{behoerde-id}/gebaeude/{gebaeude-id}/ansprechpartner/{ansprechpartner-id}
     *
     * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-behoerden-gebaeude-ansprechpartner
     */
    public function getBehoerdenGebaeudeAnsprechpartner(GetBehoerdenGebaeudeAnsprechpartnerRequest $request): ?Model\Ansprechpartner
    {
        $endpoint = sprintf('behoerden/%s/gebaeude/%s/ansprechpartner/%s', $request->behoerdeId, $request->gebaeudeId, $request->ansprechpartnerId);

        $response = $this->request($endpoint);

        return $response ? $this->serializer->deserialize(json_encode($response['ansprechpartner']), Model\Ansprechpartner::class, 'json') : null;
    }

    /**
     * Gibt eine Liste aller Ansprechpartner zurück, auf welche die Benutzerkennung Zugriff hat.
     *
     * GET /rest/allgemein/v3/ansprechpartner
     *
     * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-ansprechpartner
     *
     * @return Model\Ansprechpartner[]
     */
    public function getAnsprechpartner(GetAnsprechpartnerRequest $request): array
    {
        $endpoint = 'ansprechpartner';

        $response = $this->request(
            $endpoint,
            $request->getQueryParams()
        );

        $return = [];

        foreach ($response['ap'] as $ap) {
            $return[] = $this->serializer->deserialize(json_encode($ap), Model\Ansprechpartner::class, 'json');
        }

        return $return;
    }

    /**
     * Gibt eine Liste der Leistungen zurück, die dem Ansprechpartner mit der angegebenen Id zugeordnet sind.
     * Die Id des Ansprechpartners ist ein eindeutiger numerischer Wert, den Sie aus einem vorherigen Webservice-Aufruf als Referenz-Id erhalten haben.
     *
     * GET /rest/allgemein/v3/ansprechpartner/{ansprechpartner-id}/leistungen
     *
     * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-ansprechpartner-leistungen
     *
     * @return Leistung[]
     */
    public function getAnsprechpartnerLeistungen(GetAnsprechpartnerLeistungenRequest $request): array
    {
        $endpoint = sprintf('ansprechpartner/%s/leistungen', $request->ansprechpartnerId);

        $response = $this->request(
            $endpoint,
            $request->getQueryParams()
        );

        $return = [];

        foreach ($response['leistung'] as $leistung) {
            $return[] = $this->serializer->deserialize(json_encode($leistung), Leistung::class, 'json');
        }

        return $return;
    }

    /**
     * Gibt eine Liste aller Leistungen zurück.
     *
     * GET /rest/allgemein/v3/leistungen
     *
     * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-leistungen
     *
     * @return Leistung[]
     */
    public function getLeistungen(GetLeistungenRequest $request): array
    {
        $endpoint = 'leistungen';

        $response = $this->request(
            $endpoint,
            $request->getQueryParams()
        );

        $return = [];

        foreach ($response['leistung'] as $leistung) {
            $return[] = $this->serializer->deserialize(json_encode($leistung), Leistung::class, 'json');
        }

        return $return;
    }

    /**
     * Gibt die Leistung mit der angegebenen Id zurück.
     *
     * GET /rest/allgemein/v3/leistungen/{leistung-id}
     *
     * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-leistungen-leistung-id
     */
    public function getLeistung(GetLeistungRequest $request): ?Leistung
    {
        $endpoint = sprintf('leistungen/%s', $request->leistungId);

        $response = $this->request(
            $endpoint,
            $request->getQueryParams()
        );

        return $response ? $this->serializer->deserialize(json_encode($response), Leistung::class, 'json') : null;
    }

    /**
     * Gibt eine Liste aller Lebenslagen zurück.
     *
     * GET /rest/allgemein/v3/lebenslagen
     *
     * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-lebenslagen
     *
     * @return Model\Lebenslage[]
     */
    public function getLebenslagen(GetLebenslagenRequest $request): array
    {
        $endpoint = 'lebenslagen';

        $response = $this->request(
            $endpoint,
            $request->getQueryParams()
        );

        $return = [];

        foreach ($response['lebenslage'] as $lebenslage) {
            $return[] = $this->serializer->deserialize(json_encode($lebenslage), Model\Lebenslage::class, 'json');
        }

        return $return;
    }

    /**
     * Gibt die Lebenslage mit der angegebenen Id zurück.
     *
     * GET /rest/allgemein/v3/lebenslagen/{lebenslage-id}
     *
     * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-lebenslagen-lebenslage-id
     */
    public function getLebenslage(GetLebenslageRequest $request): ?Model\Lebenslage
    {
        $endpoint = sprintf('lebenslagen/%s', $request->lebenslageId);

        $response = $this->request(
            $endpoint,
        );

        if (!$response) {
            return null;
        }

        return $this->serializer->deserialize(json_encode($response), Model\Lebenslage::class, 'json');
    }

    /**
     * @param array<string, mixed> $queryParams
     */
    private function request(
        string $url,
        array $queryParams = [],
    ): ?array {
        if ($queryParams) {
            $url .= sprintf('?%s', http_build_query($queryParams));
        }

        try {
            $response = $this->client->request('GET', $url);
            $content = $response->getContent();

            return json_decode($content, true);
        } catch (ClientException $e) {
            return null;
        }
    }
}
