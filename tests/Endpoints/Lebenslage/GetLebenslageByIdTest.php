<?php

declare(strict_types=1);

namespace Tests\Endpoints\Lebenslage;

use Hardanders\BayernPortalApiClient\Model\Lebenslage;
use Hardanders\BayernPortalApiClient\Request\Lebenslagen\GetLebenslageByIdRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Endpoints\BaseEndpointTest;

class GetLebenslageByIdTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetLebenslageById(GetLebenslageByIdRequest $request, bool $expectSuccess): void
    {
        $response = $this->apiClient->getLebenslageById($request);

        if (false === $expectSuccess) {
            $this->assertNull($response);
        } else {
            $this->assertInstanceOf(Lebenslage::class, $response);
        }
    }

    public static function dataProvider(): iterable
    {
        yield [new GetLebenslageByIdRequest($_ENV['TEST_API_LEBENSLAGE_ID']), true];
        yield [new GetLebenslageByIdRequest(0), false];
    }
}
