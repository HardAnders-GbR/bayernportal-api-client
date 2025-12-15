<?php

declare(strict_types=1);

namespace Tests\Endpoints\Leistungen;

use Hardanders\BayernPortalApiClient\Model\Leistung;
use Hardanders\BayernPortalApiClient\Request\Leistungen\GetLeistungByIdRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Endpoints\BaseEndpointTest;

class GetLeistungByIdTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetLeistungen(GetLeistungByIdRequest $request, bool $expectSuccess): void
    {
        $response = $this->apiClient->getLeistungById($request);

        if ($expectSuccess) {
            $this->assertInstanceOf(Leistung::class, $response);
        } else {
            $this->assertNull($response);
        }
    }

    public static function dataProvider(): iterable
    {
        yield [new GetLeistungByIdRequest($_ENV['TEST_API_LEISTUNG_ID'], $_ENV['TEST_API_GEMEINDEKENNZIFFER']), true];
        yield [new GetLeistungByIdRequest(0, $_ENV['TEST_API_GEMEINDEKENNZIFFER']), false];
        yield [new GetLeistungByIdRequest('0', $_ENV['TEST_API_GEMEINDEKENNZIFFER']), false];
        yield [new GetLeistungByIdRequest('0'), false];
    }
}
