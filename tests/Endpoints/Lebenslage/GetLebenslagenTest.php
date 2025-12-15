<?php

declare(strict_types=1);

namespace Tests\Endpoints\Lebenslage;

use Hardanders\BayernPortalApiClient\Model\Lebenslage;
use Hardanders\BayernPortalApiClient\Request\Lebenslagen\GetLebenslagenRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Endpoints\BaseEndpointTest;

class GetLebenslagenTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetLebenslagen(GetLebenslagenRequest $request): void
    {
        $response = $this->apiClient->getLebenslagen($request);

        foreach ($response as $lebenslage) {
            $this->assertInstanceOf(Lebenslage::class, $lebenslage);
        }
    }

    public static function dataProvider(): iterable
    {
        yield [new GetLebenslagenRequest(false)];
    }
}
