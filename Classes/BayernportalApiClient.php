<?php

declare(strict_types=1);

namespace Hardanders\BayernPortalApiClient;

use Hardanders\BayernPortalApiClient\Model\Ansprechpartner;
use Hardanders\BayernPortalApiClient\Model\Behoerde;
use Hardanders\BayernPortalApiClient\Model\Dienststelle;
use Hardanders\BayernPortalApiClient\Model\Leistung;
use Hardanders\BayernPortalApiClient\Model\Leistungsbeschreibung;
use Hardanders\BayernPortalApiClient\Request\Ansprechpartner\GetAnsprechpartnerByIdRequest;
use Hardanders\BayernPortalApiClient\Request\Ansprechpartner\GetAnsprechpartnerLeistungenRequest;
use Hardanders\BayernPortalApiClient\Request\Ansprechpartner\GetAnsprechpartnerRequest;
use Hardanders\BayernPortalApiClient\Request\Behoerden\GetBehoerdeAnsprechpartnerRequest;
use Hardanders\BayernPortalApiClient\Request\Behoerden\GetBehoerdenRequest;
use Hardanders\BayernPortalApiClient\Request\Behoerden\GetBehoerdeRequest;
use Hardanders\BayernPortalApiClient\Request\Dienststellen\GetDienststellenLeistungenRequest;
use Hardanders\BayernPortalApiClient\Request\Dienststellen\GetDienststellenRequest;
use Hardanders\BayernPortalApiClient\Request\Leistungen\GetLeistungenRequest;
use Hardanders\BayernPortalApiClient\Request\Leistungsbeschreibungen\GetLeistungsbeschreibungByIdRequest;
use Hardanders\BayernPortalApiClient\Request\Leistungsbeschreibungen\GetLeistungsbeschreibungenVonDienststelleRequest;
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
     * @return Dienststelle[]
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
            $return[] = $this->serializer->deserialize(json_encode($dienststelleData), Dienststelle::class, 'json');
        }

        return $return;
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
     * Gibt die Ansprechpartner der Behörde mit der angegebenen Id zurück.
     *
     * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-behoerden-ansprechpartner
     *
     * GET /rest/allgemein/v3/behoerden/{behoerde-id}/ansprechpartner
     *
     * @return Ansprechpartner[]
     */
    public function getBehoerdeAnsprechpartner(GetBehoerdeAnsprechpartnerRequest $request): array
    {
        $endpoint = sprintf('behoerden/%s/ansprechpartner', $request->behoerdeId);

        $response = $this->request($endpoint);

        $return = [];

        foreach ($response['ansprechpartner']['ap'] ?? [] as $ap) {
            $return[] = $this->serializer->deserialize(json_encode($ap), Ansprechpartner::class, 'json');
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
    public function getAnsprechpartnerById(GetAnsprechpartnerByIdRequest $request): ?Ansprechpartner
    {
        $endpoint = sprintf('ansprechpartner/%s', $request->ansprechpartnerId);

        $response = $this->request($endpoint);

        return $response['ap'] ? $this->serializer->deserialize(json_encode($response['ap'][0]), Ansprechpartner::class, 'json') : null;
    }

    /**
     * Gibt die Leistungsbeschreibungen der Dienststelle mit dem angegebenen Dienststellenschlüssel zurück.
     *
     * GET /rest/allgemein/v3/dienststellen/{dienststellenschluessel}/leistungsbeschreibungen
     *
     * @return Leistungsbeschreibung[]
     */
    public function getLeistungsbeschreibungenVonDienststelle(GetLeistungsbeschreibungenVonDienststelleRequest $request): array
    {
        $endpoint = sprintf('dienststellen/%s/leistungsbeschreibungen', $request->dienststellenschluessel);

        $response = $this->request(
            $endpoint,
            $request->getQueryParams(),
        );

        $return = [];

        foreach ($response['leistungsbeschreibung'] ?? [] as $data) {
            $return[] = $this->serializer->deserialize(json_encode(['data' => $data]), Leistungsbeschreibung::class, 'json');
        }

        return $return;
    }

    /**
     * Gibt die Leistungbeschreibung mit der angegebenen Id zurück.
     *
     * GET /rest/allgemein/v3/leistungsbeschreibungen/{leistung-id}
     */
    public function getLeistungsbeschreibungById(GetLeistungsbeschreibungByIdRequest $request): ?Leistungsbeschreibung
    {
        $endpoint = sprintf('leistungsbeschreibungen/%s', $request->leistungId);

        $response = $this->request(
            $endpoint,
            $request->getQueryParams(),
        );

        return $this->serializer->deserialize(json_encode(['data' => $response['leistungsbeschreibung']]), Leistungsbeschreibung::class, 'json');
    }

    /**
     * Gibt alle Behörden zurück, auf welche die Benutzerkennung Zugriff hat.
     *
     * GET /rest/allgemein/v3/behoerden
     *
     * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-behoerden
     *
     * @return Behoerde[]
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
            $return[] = $this->serializer->deserialize(json_encode($behoerdeData), Behoerde::class, 'json');
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
     *
     * @return Behoerde|null returns null if no Behörde was found
     */
    public function getBehoerde(GetBehoerdeRequest $request): ?Behoerde
    {
        $endpoint = sprintf('behoerden/%s', $request->behoerdeId);

        $response = $this->request(
            $endpoint,
        );

        return $response ? $this->serializer->deserialize(json_encode($response['behoerde']), Behoerde::class, 'json') : null;
    }

    /**
     * Gibt eine Liste aller Ansprechpartner zurück, auf welche die Benutzerkennung Zugriff hat.
     *
     * GET /rest/allgemein/v3/ansprechpartner
     *
     * @doc https://www.baybw-services.bayern.de/restapi.htm#resources-ansprechpartner
     *
     * @return Ansprechpartner[]
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
            $return[] = $this->serializer->deserialize(json_encode($ap), Ansprechpartner::class, 'json');
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
