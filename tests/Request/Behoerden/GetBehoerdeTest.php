<?php

declare(strict_types=1);

namespace Tests\Request\Behoerden;

use Hardanders\BayernPortalApiClient\Model\Behoerde;
use Hardanders\BayernPortalApiClient\Request\Behoerden\BehoerdeRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Request\BaseEndpointTest;

class GetBehoerdeTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetBehoerde(BehoerdeRequest $request, bool $expectedResultIsBehoerde): void
    {
        $response = $this->apiClient->getBehoerde($request);

        if ($expectedResultIsBehoerde) {
            $this->assertInstanceOf(Behoerde::class, $response);
        } else {
            $this->assertNull($response);
        }
    }

    public static function dataProvider(): iterable
    {
        yield [new BehoerdeRequest($_ENV['TEST_API_BEHOERDE_ID']), true];
        yield [new BehoerdeRequest('000000'), false];
    }
}
