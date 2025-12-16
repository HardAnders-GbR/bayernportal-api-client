<?php

declare(strict_types=1);

namespace Tests\Request\Behoerden;

use Hardanders\BayernPortalApiClient\Model\Ansprechpartner;
use Hardanders\BayernPortalApiClient\Request\Behoerden\GetBehoerdenAnsprechpartnerRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Request\BaseEndpointTest;

class GetBehoerdenAnsprechpartnerTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetBehoerde(GetBehoerdenAnsprechpartnerRequest $request, bool $expectSuccess): void
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
        yield [new GetBehoerdenAnsprechpartnerRequest($_ENV['TEST_API_BEHOERDE_ID']), true];
        yield [new GetBehoerdenAnsprechpartnerRequest('000000'), false];
    }
}
