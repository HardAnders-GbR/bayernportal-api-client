<?php

declare(strict_types=1);

namespace Tests\Request\Dienststellen;

use Hardanders\BayernPortalApiClient\Model\Leistung;
use Hardanders\BayernPortalApiClient\Request\Dienststellen\GetDienststellenLeistungenRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Request\BaseEndpointTest;

class GetDienststellenLeistungenTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetDienststellenLeistungen(GetDienststellenLeistungenRequest $request): void
    {
        $response = $this->apiClient->getDienststellenLeistungen($request);

        $this->assertNotEmpty($response);

        foreach ($response as $leistung) {
            $this->assertInstanceOf(Leistung::class, $leistung);
        }
    }

    public static function dataProvider(): iterable
    {
        yield [new GetDienststellenLeistungenRequest($_ENV['TEST_API_DIENSTSTELLENSCHLUESSEL'])];
    }
}
