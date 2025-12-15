<?php

declare(strict_types=1);

namespace Tests\Endpoints\Leistungsbeschreibungen;

use Hardanders\BayernPortalApiClient\Request\Leistungsbeschreibungen\GetLeistungsbeschreibungByIdRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Endpoints\BaseEndpointTest;

class GetLeistungsbeschreibungByIdTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetLeistungsbeschreibungById(string $leistungId, string $gemeindekennziffer): void
    {
        $this->markTestSkipped('Not yet implemented');

        $response = $this->apiClient->getLeistungsbeschreibungById(new GetLeistungsbeschreibungByIdRequest($leistungId, $gemeindekennziffer));
    }

    public static function dataProvider(): iterable
    {
        yield [$_ENV['TEST_API_LEISTUNG_ID'], $_ENV['TEST_API_GEMEINDEKENNZIFFER']];
    }
}
