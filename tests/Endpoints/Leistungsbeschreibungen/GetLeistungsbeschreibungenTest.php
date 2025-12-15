<?php

declare(strict_types=1);

namespace Tests\Endpoints\Leistungsbeschreibungen;

use Hardanders\BayernPortalApiClient\Model\Leistungsbeschreibung;
use Hardanders\BayernPortalApiClient\Request\Leistungsbeschreibungen\GetLeistungsbeschreibungenRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Endpoints\BaseEndpointTest;

class GetLeistungsbeschreibungenTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetLeistungsbeschreibungen(GetLeistungsbeschreibungenRequest $request): void
    {
        $response = $this->apiClient->getLeistungsbeschreibungen($request);

        $this->assertNotEmpty($response);

        foreach ($response as $leistungsbeschreibung) {
            $this->assertInstanceOf(Leistungsbeschreibung::class, $leistungsbeschreibung);
        }
    }

    public static function dataProvider(): iterable
    {
        yield [new GetLeistungsbeschreibungenRequest($_ENV['TEST_API_GEMEINDEKENNZIFFER'], true, true)];
    }
}
