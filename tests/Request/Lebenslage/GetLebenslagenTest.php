<?php

declare(strict_types=1);

namespace Tests\Request\Lebenslage;

use Hardanders\BayernPortalApiClient\Model\Lebenslage;
use Hardanders\BayernPortalApiClient\Request\Lebenslagen\LebenslagenRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Request\BaseEndpointTest;

class GetLebenslagenTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetLebenslagen(LebenslagenRequest $request): void
    {
        $response = $this->apiClient->getLebenslagen($request);

        foreach ($response as $lebenslage) {
            $this->assertInstanceOf(Lebenslage::class, $lebenslage);
        }
    }

    public static function dataProvider(): iterable
    {
        yield [new LebenslagenRequest(false)];
    }
}
