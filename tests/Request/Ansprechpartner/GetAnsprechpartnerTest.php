<?php

declare(strict_types=1);

namespace Tests\Request\Ansprechpartner;

use Hardanders\BayernPortalApiClient\Model\Ansprechpartner;
use Hardanders\BayernPortalApiClient\Request\Ansprechpartner\GetAnsprechpartnerRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Request\BaseEndpointTest;

class GetAnsprechpartnerTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetAnsprechpartner(GetAnsprechpartnerRequest $request): void
    {
        $response = $this->apiClient->getAnsprechpartner($request);

        foreach ($response as $item) {
            $this->assertInstanceOf(Ansprechpartner::class, $item);
        }
    }

    public static function dataProvider(): iterable
    {
        yield [new GetAnsprechpartnerRequest()];
        yield [new GetAnsprechpartnerRequest(full: true)];
    }
}
