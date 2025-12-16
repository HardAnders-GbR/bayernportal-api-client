<?php

declare(strict_types=1);

namespace Tests\Request\Leistungen;

use Hardanders\BayernPortalApiClient\Model\Leistung;
use Hardanders\BayernPortalApiClient\Request\Leistungen\LeistungenRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Request\BaseEndpointTest;

class GetLeistungenTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetLeistungen(LeistungenRequest $request): void
    {
        $response = $this->apiClient->getLeistungen($request);

        $this->assertNotEmpty($response);

        foreach ($response as $item) {
            $this->assertInstanceOf(Leistung::class, $item);
        }
    }

    public static function dataProvider(): iterable
    {
        yield [new LeistungenRequest()];
        yield [new LeistungenRequest($_ENV['TEST_API_GEMEINDEKENNZIFFER'])];
    }
}
