<?php

declare(strict_types=1);

namespace Tests\Request\Behoerden;

use Hardanders\BayernPortalApiClient\Model\Leistung;
use Hardanders\BayernPortalApiClient\Request\Behoerden\BehoerdenLeistungenRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Request\BaseEndpointTest;

class GetBehoerdenLeistungenTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetBehoerdenLeistungen(BehoerdenLeistungenRequest $request, bool $expectSuccess): void
    {
        $response = $this->apiClient->getBehoerdenLeistungen($request);

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
        yield [new BehoerdenLeistungenRequest($_ENV['TEST_API_BEHOERDE_ID'], false), true];
        yield [new BehoerdenLeistungenRequest($_ENV['TEST_API_BEHOERDE_ID'], true), true];
        yield [new BehoerdenLeistungenRequest('0'), false];
    }
}
