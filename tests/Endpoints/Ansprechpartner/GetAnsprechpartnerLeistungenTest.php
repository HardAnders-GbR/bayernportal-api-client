<?php

declare(strict_types=1);

namespace Tests\Endpoints\Ansprechpartner;

use Hardanders\BayernPortalApiClient\Model\Leistung;
use Hardanders\BayernPortalApiClient\Request\Ansprechpartner\GetAnsprechpartnerLeistungenRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Endpoints\BaseEndpointTest;

class GetAnsprechpartnerLeistungenTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetAnsprechpartnerLeistungen(GetAnsprechpartnerLeistungenRequest $request, bool $expectSuccess): void
    {
        $response = $this->apiClient->getAnsprechpartnerLeistungen($request);

        if (false === $expectSuccess) {
            $this->assertEmpty($response);
        }

        foreach ($response as $item) {
            $this->assertInstanceOf(Leistung::class, $item);
        }
    }

    public static function dataProvider(): iterable
    {
        yield [new GetAnsprechpartnerLeistungenRequest($_ENV['TEST_API_ANSPRECHPARTNER_ID'], false), true];
        yield [new GetAnsprechpartnerLeistungenRequest($_ENV['TEST_API_ANSPRECHPARTNER_ID'], true), false];
    }
}
