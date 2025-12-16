<?php

declare(strict_types=1);

namespace Tests\Request\Leistungen;

use Hardanders\BayernPortalApiClient\Model\Leistung;
use Hardanders\BayernPortalApiClient\Request\Leistungen\LeistungRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Request\BaseEndpointTest;

class GetLeistungTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetLeistungen(LeistungRequest $request, bool $expectSuccess): void
    {
        $response = $this->apiClient->getLeistung($request);

        if ($expectSuccess) {
            $this->assertInstanceOf(Leistung::class, $response);
        } else {
            $this->assertNull($response);
        }
    }

    public static function dataProvider(): iterable
    {
        yield [new LeistungRequest($_ENV['TEST_API_LEISTUNG_ID'], $_ENV['TEST_API_GEMEINDEKENNZIFFER']), true];
        yield [new LeistungRequest(0, $_ENV['TEST_API_GEMEINDEKENNZIFFER']), false];
        yield [new LeistungRequest('0', $_ENV['TEST_API_GEMEINDEKENNZIFFER']), false];
        yield [new LeistungRequest('0'), false];
    }
}
