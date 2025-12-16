<?php

declare(strict_types=1);

namespace Tests\Request\Dienststellen;

use Hardanders\BayernPortalApiClient\Model\Lebenslage;
use Hardanders\BayernPortalApiClient\Request\Dienststellen\GetDienststellenLebenslagenRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Request\BaseEndpointTest;

class GetDienststellenLebenslagenTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetDienststellenFormulare(GetDienststellenLebenslagenRequest $request, bool $expectSuccess): void
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
        yield [new GetDienststellenLebenslagenRequest($_ENV['TEST_API_DIENSTSTELLENSCHLUESSEL']), true];
        yield [new GetDienststellenLebenslagenRequest(0), false];
        yield [new GetDienststellenLebenslagenRequest('0'), false];
    }
}
