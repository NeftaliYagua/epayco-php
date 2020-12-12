<?php

namespace Epayco\Service;

/**
 * @internal
 * @covers \Epayco\Service\BalanceService
 */
final class BalanceServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Epayco\TestHelper;

    /** @var \Epayco\EpaycoClient */
    private $client;

    /** @var BalanceService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Epayco\EpaycoClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new BalanceService($this->client);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/v1/balance'
        );
        $resource = $this->service->retrieve();
        static::assertInstanceOf(\Epayco\Balance::class, $resource);
    }
}
