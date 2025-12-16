<?php

declare(strict_types=1);

namespace Tests\Request\Leistungsbeschreibungen;

use Hardanders\BayernPortalApiClient\Model\Leistungsbeschreibung;
use Hardanders\BayernPortalApiClient\Request\Leistungsbeschreibungen\GetLeistungsbeschreibungRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Request\BaseEndpointTest;

class GetLeistungsbeschreibungTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetLeistungsbeschreibungById(GetLeistungsbeschreibungRequest $request, bool $expectSuccess): void
    {
        $this->markTestIncomplete('Not yet implemented');
        $response = $this->apiClient->getLeistungsbeschreibung($request);

        if (false === $expectSuccess) {
            $this->assertNull($response);
        } else {
            $this->assertInstanceOf(Leistungsbeschreibung::class, $response);
        }
    }

    public static function dataProvider(): iterable
    {
        yield [new GetLeistungsbeschreibungRequest($_ENV['TEST_API_LEISTUNG_ID'], $_ENV['TEST_API_GEMEINDEKENNZIFFER']), true];
        yield [new GetLeistungsbeschreibungRequest(0, $_ENV['TEST_API_GEMEINDEKENNZIFFER']), false];
    }
}
