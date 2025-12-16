<?php

declare(strict_types=1);

namespace Tests\Request\Behoerden;

use Hardanders\BayernPortalApiClient\Model\Ansprechpartner;
use Hardanders\BayernPortalApiClient\Request\Behoerden\GetBehoerdenGebaeudeAnsprechpartnerRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Request\BaseEndpointTest;

class GetBehoerdenGebaeudeAnsprechpartnerTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetBehoerdenGebaeudeAnsprechpartner(GetBehoerdenGebaeudeAnsprechpartnerRequest $request, bool $expectSuccess): void
    {
        $response = $this->apiClient->getBehoerdenGebaeudeAnsprechpartner($request);

        if (false === $expectSuccess) {
            $this->assertNull($response);
        } else {
            $this->assertInstanceOf(Ansprechpartner::class, $response);
        }
    }

    public static function dataProvider(): iterable
    {
        yield [new GetBehoerdenGebaeudeAnsprechpartnerRequest($_ENV['TEST_API_BEHOERDE_ID'], $_ENV['TEST_API_GEBAEUDE_ID'], $_ENV['TEST_API_ANSPRECHPARTNER_ID']), true];
        yield [new GetBehoerdenGebaeudeAnsprechpartnerRequest('0', '0', '0'), false];
    }
}
