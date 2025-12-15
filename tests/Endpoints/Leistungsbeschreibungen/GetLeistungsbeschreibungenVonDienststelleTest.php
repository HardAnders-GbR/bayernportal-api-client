<?php

declare(strict_types=1);

namespace Tests\Endpoints\Leistungsbeschreibungen;

use Hardanders\BayernPortalApiClient\Model\Leistungsbeschreibung;
use Hardanders\BayernPortalApiClient\Request\Leistungsbeschreibungen\GetLeistungsbeschreibungenVonDienststelleRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Endpoints\BaseEndpointTest;

class GetLeistungsbeschreibungenVonDienststelleTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetLeistungsbeschreibungenVonDienststelle(string $dienststellenSchluessel, string $gemeindekennziffer): void
    {
        $this->markTestSkipped('Not yet implemented');

        $request = new GetLeistungsbeschreibungenVonDienststelleRequest(
            $dienststellenSchluessel,
            $gemeindekennziffer,
            true,
            true,
            true,
        );

        $response = $this->apiClient->getLeistungsbeschreibungenVonDienststelle($request);

        foreach ($response as $leistungsbeschreibung) {
            $this->assertInstanceOf(Leistungsbeschreibung::class, $leistungsbeschreibung);
        }
    }

    public static function dataProvider(): iterable
    {
        yield [$_ENV['TEST_API_DIENSTSTELLENSCHLUESSEL'], $_ENV['TEST_API_GEMEINDEKENNZIFFER']];
    }
}
