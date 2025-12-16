<?php

declare(strict_types=1);

namespace Tests\Request\Dienststellen;

use Hardanders\BayernPortalApiClient\Model\Dienststelle;
use Hardanders\BayernPortalApiClient\Request\Dienststellen\DienststellenRequest;
use Tests\Request\BaseEndpointTest;

class GetDienststellenTest extends BaseEndpointTest
{
    public function testGetDienststellen(): void
    {
        $response = $this->apiClient->getDienststellen(new DienststellenRequest());

        foreach ($response as $dienststelle) {
            $this->assertInstanceOf(Dienststelle::class, $dienststelle);
        }
    }
}
