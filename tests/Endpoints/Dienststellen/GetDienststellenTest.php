<?php

declare(strict_types=1);

namespace Tests\Endpoints\Dienststellen;

use Hardanders\BayernPortalApiClient\Model\Dienststelle;
use Hardanders\BayernPortalApiClient\Request\Dienststellen\GetDienststellenRequest;
use Tests\Endpoints\BaseEndpointTest;

class GetDienststellenTest extends BaseEndpointTest
{
    public function testGetDienststellen(): void
    {
        $response = $this->apiClient->getDienststellen(new GetDienststellenRequest());

        foreach ($response as $dienststelle) {
            $this->assertInstanceOf(Dienststelle::class, $dienststelle);
        }
    }
}
