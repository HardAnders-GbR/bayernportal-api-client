<?php

declare(strict_types=1);

namespace Tests\Request\Behoerden;

use Hardanders\BayernPortalApiClient\Model\Leistung;
use Hardanders\BayernPortalApiClient\Request\Behoerden\BehoerdenAbgegebeneLeistungenRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Request\BaseEndpointTest;

class GetBehoerdenAbgegebeneLeistungenTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetBehoerdenAbgegebeneLeistungen(BehoerdenAbgegebeneLeistungenRequest $request, bool $expectSuccess): void
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
        yield [new BehoerdenAbgegebeneLeistungenRequest($_ENV['TEST_API_BEHOERDE_ID']), true];
        yield [new BehoerdenAbgegebeneLeistungenRequest('0'), false];
    }
}
