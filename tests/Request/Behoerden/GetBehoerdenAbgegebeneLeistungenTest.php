<?php

declare(strict_types=1);

namespace Tests\Request\Behoerden;

use Hardanders\BayernPortalApiClient\Model\Leistung;
use Hardanders\BayernPortalApiClient\Request\Behoerden\GetBehoerdenAbgegebeneLeistungenRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Request\BaseEndpointTest;

class GetBehoerdenAbgegebeneLeistungenTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetBehoerdenAbgegebeneLeistungen(GetBehoerdenAbgegebeneLeistungenRequest $request, bool $expectSuccess): void
    {
        $response = $this->apiClient->getBehoerdenAbgegebeneLeistungen($request);

        if (false === $expectSuccess) {
            $this->assertEmpty($response);
        } else {
            $this->assertNotEmpty($response);

            foreach ($response as $leistung) {
                $this->assertInstanceOf(Leistung::class, $leistung);
            }
        }
    }

    public static function dataProvider(): iterable
    {
        yield [new GetBehoerdenAbgegebeneLeistungenRequest($_ENV['TEST_API_BEHOERDE_ID']), true];
        yield [new GetBehoerdenAbgegebeneLeistungenRequest('0'), false];
    }
}
