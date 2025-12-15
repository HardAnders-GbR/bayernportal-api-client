<?php

declare(strict_types=1);

namespace Tests\Endpoints;

use Hardanders\BayernPortalApiClient\BayernportalApiClient;
use PHPUnit\Framework\TestCase;

class BaseEndpointTest extends TestCase
{
    protected BayernportalApiClient $apiClient;

    public function __construct(string $name)
    {
        $username = $_ENV['TEST_API_USERNAME'];
        $password = $_ENV['TEST_API_PASSWORD'];
        $this->apiClient = new BayernportalApiClient($username, $password, $_ENV['TEST_API_GEMEINDEKENNZIFFER']);

        parent::__construct($name);
    }

    public function testBayernPortalApiClientObject(): void
    {
        $this->assertTrue(true);
    }
}
