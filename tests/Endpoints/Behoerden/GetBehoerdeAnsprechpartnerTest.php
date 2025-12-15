<?php

declare(strict_types=1);

namespace Tests\Endpoints\Behoerden;

use Hardanders\BayernPortalApiClient\Model\Ansprechpartner;
use Hardanders\BayernPortalApiClient\Request\Behoerden\GetBehoerdeAnsprechpartnerRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Endpoints\BaseEndpointTest;

class GetBehoerdeAnsprechpartnerTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetBehoerde(GetBehoerdeAnsprechpartnerRequest $request, bool $expectSuccess): void
    {
        $response = $this->apiClient->getBehoerdeAnsprechpartner($request);

        if (!$expectSuccess) {
            $this->assertEmpty($response);
        }

        foreach ($response as $item) {
            $this->assertInstanceOf(Ansprechpartner::class, $item);
        }
    }

    public static function dataProvider(): iterable
    {
        yield [new GetBehoerdeAnsprechpartnerRequest($_ENV['TEST_API_BEHOERDE_ID']), true];
        yield [new GetBehoerdeAnsprechpartnerRequest('000000'), false];
    }
}
