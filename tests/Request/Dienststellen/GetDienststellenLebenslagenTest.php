<?php

declare(strict_types=1);

namespace Tests\Request\Dienststellen;

use Hardanders\BayernPortalApiClient\Model\Lebenslage;
use Hardanders\BayernPortalApiClient\Request\Dienststellen\DienststellenLebenslagenRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Request\BaseEndpointTest;

class GetDienststellenLebenslagenTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetDienststellenFormulare(DienststellenLebenslagenRequest $request, bool $expectSuccess): void
    {
        $response = $this->apiClient->getDienststellenLebenslagen($request);

        if (false === $expectSuccess) {
            $this->assertEmpty($response);
        } else {
            $this->assertNotEmpty($response);
        }

        foreach ($response as $lebenslage) {
            $this->assertInstanceOf(Lebenslage::class, $lebenslage);
        }
    }

    public static function dataProvider(): iterable
    {
        yield [new DienststellenLebenslagenRequest($_ENV['TEST_API_DIENSTSTELLENSCHLUESSEL']), true];
        yield [new DienststellenLebenslagenRequest(0), false];
        yield [new DienststellenLebenslagenRequest('0'), false];
    }
}
