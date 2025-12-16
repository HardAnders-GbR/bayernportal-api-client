<?php

declare(strict_types=1);

namespace Tests\Request\Lebenslage;

use Hardanders\BayernPortalApiClient\Model\Lebenslage;
use Hardanders\BayernPortalApiClient\Request\Lebenslagen\LebenslageRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Request\BaseEndpointTest;

class GetLebenslageByIdTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetLebenslageById(LebenslageRequest $request, bool $expectSuccess): void
    {
        $response = $this->apiClient->getLebenslage($request);

        if (false === $expectSuccess) {
            $this->assertNull($response);
        } else {
            $this->assertInstanceOf(Lebenslage::class, $response);
        }
    }

    public static function dataProvider(): iterable
    {
        yield [new LebenslageRequest($_ENV['TEST_API_LEBENSLAGE_ID']), true];
        yield [new LebenslageRequest(0), false];
    }
}
