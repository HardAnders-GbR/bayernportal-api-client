<?php

declare(strict_types=1);

namespace Tests\Request\Dienststellen;

use Hardanders\BayernPortalApiClient\Model\LeistungMitFormularen;
use Hardanders\BayernPortalApiClient\Request\Dienststellen\GetDienststellenFormulareRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Request\BaseEndpointTest;

class GetDienststellenFormulareTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetDienststellenFormulare(GetDienststellenFormulareRequest $request): void
    {
        $response = $this->apiClient->getDienststellenFormulare($request);

        $this->assertNotEmpty($response);

        foreach ($response as $leistungMitFormular) {
            $this->assertInstanceOf(LeistungMitFormularen::class, $leistungMitFormular);
        }
    }

    public static function dataProvider(): iterable
    {
        yield [new GetDienststellenFormulareRequest($_ENV['TEST_API_DIENSTSTELLENSCHLUESSEL'])];
        yield [new GetDienststellenFormulareRequest($_ENV['TEST_API_DIENSTSTELLENSCHLUESSEL'], $_ENV['TEST_API_GEMEINDEKENNZIFFER'])];
    }
}
