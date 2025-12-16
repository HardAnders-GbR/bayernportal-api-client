<?php

declare(strict_types=1);

namespace Tests\Request\Ansprechpartner;

use Hardanders\BayernPortalApiClient\Model\Ansprechpartner;
use Hardanders\BayernPortalApiClient\Request\Ansprechpartner\AnsprechpartnerByIdRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Request\BaseEndpointTest;

class GetAnsprechpartnerByIdTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetAnsprechpartner(AnsprechpartnerByIdRequest $request, bool $expectSuccess): void
    {
        $response = $this->apiClient->getAnsprechpartnerById($request);

        if (false === $expectSuccess) {
            $this->assertNull($response);
        } else {
            $this->assertInstanceOf(Ansprechpartner::class, $response);
        }
    }

    public static function dataProvider(): iterable
    {
        yield [new AnsprechpartnerByIdRequest($_ENV['TEST_API_ANSPRECHPARTNER_ID']), true];
        yield [new AnsprechpartnerByIdRequest(0), false];
    }
}
