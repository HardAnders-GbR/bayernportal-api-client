<?php

declare(strict_types=1);

namespace Tests\Request\Ansprechpartner;

use Hardanders\BayernPortalApiClient\Model\Ansprechpartner;
use Hardanders\BayernPortalApiClient\Request\Ansprechpartner\AnsprechpartnerRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Request\BaseEndpointTest;

class GetAnsprechpartnerTest extends BaseEndpointTest
{
    #[DataProvider('dataProvider')]
    public function testGetAnsprechpartner(AnsprechpartnerRequest $request): void
    {
        $response = $this->apiClient->getAnsprechpartner($request);

        foreach ($response as $item) {
            $this->assertInstanceOf(Ansprechpartner::class, $item);
        }
    }

    public static function dataProvider(): iterable
    {
        yield [new AnsprechpartnerRequest()];
        yield [new AnsprechpartnerRequest(full: true)];
    }
}
