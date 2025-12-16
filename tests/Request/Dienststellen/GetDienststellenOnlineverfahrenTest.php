<?php

declare(strict_types=1);

namespace Tests\Request\Dienststellen;

use Hardanders\BayernPortalApiClient\Model\LeistungMitOnlineverfahren;
use Hardanders\BayernPortalApiClient\Request\Dienststellen\DienststellenOnlineverfahrenRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Request\BaseEndpointTest;

class GetDienststellenOnlineverfahrenTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetDienststellenOnlineverfahren(DienststellenOnlineverfahrenRequest $request): void
    {
        $response = $this->apiClient->getDienststellenOnlineverfahren($request);

        $this->assertNotEmpty($response);

        foreach ($response as $leistung) {
            $this->assertInstanceOf(LeistungMitOnlineverfahren::class, $leistung);
        }
    }

    public static function dataProvider(): iterable
    {
        yield [new DienststellenOnlineverfahrenRequest($_ENV['TEST_API_DIENSTSTELLENSCHLUESSEL'])];
        yield [new DienststellenOnlineverfahrenRequest($_ENV['TEST_API_DIENSTSTELLENSCHLUESSEL'], $_ENV['TEST_API_GEMEINDEKENNZIFFER'])];
    }
}
