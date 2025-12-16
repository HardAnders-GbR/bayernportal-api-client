<?php

declare(strict_types=1);

namespace Tests\Request;

use Hardanders\BayernPortalApiClient\BayernportalApiClient;
use PHPUnit\Framework\TestCase;
use Tests\ClearProperties;

class BaseEndpointTest extends TestCase
{
    use ClearProperties;

    protected BayernportalApiClient $apiClient;

    public function setUp(): void
    {
        $username = $_ENV['TEST_API_USERNAME'];
        $password = $_ENV['TEST_API_PASSWORD'];
        $this->apiClient = new BayernportalApiClient($username, $password, $_ENV['TEST_API_GEMEINDEKENNZIFFER']);
    }

    public function testBayernPortalApiClientObject(): void
    {
        $this->assertTrue(true);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->clearProperties();

        gc_collect_cycles();
    }
}
