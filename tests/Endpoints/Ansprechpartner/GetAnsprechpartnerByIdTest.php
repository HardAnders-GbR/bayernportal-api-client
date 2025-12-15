<?php

declare(strict_types=1);

namespace Tests\Endpoints\Ansprechpartner;

use Hardanders\BayernPortalApiClient\Model\Ansprechpartner;
use Hardanders\BayernPortalApiClient\Request\Ansprechpartner\GetAnsprechpartnerByIdRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Endpoints\BaseEndpointTest;

class GetAnsprechpartnerByIdTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetAnsprechpartner(GetAnsprechpartnerByIdRequest $request, bool $expectSuccess): void
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
        yield [new GetAnsprechpartnerByIdRequest(405816), true];
        yield [new GetAnsprechpartnerByIdRequest(0), false];
    }
}
