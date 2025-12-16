<?php

declare(strict_types=1);

namespace Tests\Request\Dienststellen;

use Hardanders\BayernPortalApiClient\Model\Leistungsbeschreibung;
use Hardanders\BayernPortalApiClient\Request\Dienststellen\DienststellenLeistungsbeschreibungenRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Request\BaseEndpointTest;

class GetDienststellenLeistungsbeschreibungenTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetDienststellenLeistungsbeschreibungen(DienststellenLeistungsbeschreibungenRequest $request): void
    {
        $response = $this->apiClient->getDienststellenLeistungsbeschreibungen($request);

        foreach ($response as $leistungsbeschreibung) {
            $this->assertInstanceOf(Leistungsbeschreibung::class, $leistungsbeschreibung);
        }
    }

    public static function dataProvider(): iterable
    {
        yield [new DienststellenLeistungsbeschreibungenRequest(
            $_ENV['TEST_API_DIENSTSTELLENSCHLUESSEL'],
            $_ENV['TEST_API_GEMEINDEKENNZIFFER'],
            true,
            true,
            true,
        )];
    }
}
