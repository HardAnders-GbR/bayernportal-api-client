<?php

declare(strict_types=1);

namespace Tests\Request\Dienststellen;

use Hardanders\BayernPortalApiClient\Model\Dienststelle;
use Hardanders\BayernPortalApiClient\Request\Dienststellen\DienststelleRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Request\BaseEndpointTest;

class GetDienststelleTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetDienststelle(DienststelleRequest $request, bool $expectSuccess): void
    {
        $response = $this->apiClient->getDienststelle($request);

        if (false === $expectSuccess) {
            $this->assertNull($response);
        } else {
            $this->assertInstanceOf(Dienststelle::class, $response);
        }
    }

    public static function dataProvider(): iterable
    {
        yield [new DienststelleRequest($_ENV['TEST_API_DIENSTSTELLENSCHLUESSEL']), true];
        yield [new DienststelleRequest($_ENV['TEST_API_DIENSTSTELLENSCHLUESSEL'], $_ENV['TEST_API_GEMEINDEKENNZIFFER']), true];
        yield [new DienststelleRequest(0), false];
        yield [new DienststelleRequest('0', $_ENV['TEST_API_GEMEINDEKENNZIFFER']), false];
    }
}
