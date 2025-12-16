<?php

declare(strict_types=1);

namespace Tests\Request\Behoerden;

use Hardanders\BayernPortalApiClient\Model\Gebaeude;
use Hardanders\BayernPortalApiClient\Request\Behoerden\GetBehoerdenGebaeudeRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Request\BaseEndpointTest;

class GetBehoerdenGebaeudeTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetBehoerdenGebaeude(GetBehoerdenGebaeudeRequest $request, bool $expectSuccess): void
    {
        $response = $this->apiClient->getBehoerdenGebaeude($request);

        if (false === $expectSuccess) {
            $this->assertNull($response);
        } else {
            $this->assertInstanceOf(Gebaeude::class, $response);
        }
    }

    public static function dataProvider(): iterable
    {
        yield [new GetBehoerdenGebaeudeRequest($_ENV['TEST_API_BEHOERDE_ID'], $_ENV['TEST_API_GEBAEUDE_ID']), true];
        yield [new GetBehoerdenGebaeudeRequest('0', '0'), false];
    }
}
