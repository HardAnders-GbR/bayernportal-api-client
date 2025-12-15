<?php

declare(strict_types=1);

namespace Tests\Endpoints\Leistungsbeschreibungen;

use Hardanders\BayernPortalApiClient\Model\Leistungsbeschreibung;
use Hardanders\BayernPortalApiClient\Request\Leistungsbeschreibungen\GetLeistungsbeschreibungByIdRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Endpoints\BaseEndpointTest;

class GetLeistungsbeschreibungByIdTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetLeistungsbeschreibungById(GetLeistungsbeschreibungByIdRequest $request, bool $expectSuccess): void
    {
        $this->markTestIncomplete('Not yet implemented');
        $response = $this->apiClient->getLeistungsbeschreibungById($request);

        if (false === $expectSuccess) {
            $this->assertNull($response);
        } else {
            $this->assertInstanceOf(Leistungsbeschreibung::class, $response);
        }
    }

    public static function dataProvider(): iterable
    {
        yield [new GetLeistungsbeschreibungByIdRequest($_ENV['TEST_API_LEISTUNG_ID'], $_ENV['TEST_API_GEMEINDEKENNZIFFER']), true];
        yield [new GetLeistungsbeschreibungByIdRequest(0, $_ENV['TEST_API_GEMEINDEKENNZIFFER']), false];
    }
}
