<?php

declare(strict_types=1);

namespace Tests\Request\Behoerden;

use Hardanders\BayernPortalApiClient\Model\Behoerde;
use Hardanders\BayernPortalApiClient\Request\Behoerden\BehoerdenRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Request\BaseEndpointTest;

class GetBehoerdenTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetBehoerden(BehoerdenRequest $request): void
    {
        $response = $this->apiClient->getBehoerden($request);

        foreach ($response as $item) {
            $this->assertInstanceOf(Behoerde::class, $item);
        }
    }

    public static function dataProvider(): iterable
    {
        yield [new BehoerdenRequest(full: true)];
        yield [new BehoerdenRequest(full: false)];
    }
}
