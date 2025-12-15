<?php

declare(strict_types=1);

namespace Tests\Endpoints\Behoerden;

use Hardanders\BayernPortalApiClient\Model\Behoerde;
use Hardanders\BayernPortalApiClient\Request\Behoerden\GetBehoerdeRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Endpoints\BaseEndpointTest;

class GetBehoerdeTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetBehoerde(GetBehoerdeRequest $request, bool $expectedResultIsBehoerde): void
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
        yield [new GetBehoerdeRequest($_ENV['TEST_API_BEHOERDE_ID']), true];
        yield [new GetBehoerdeRequest('000000'), false];
    }
}
