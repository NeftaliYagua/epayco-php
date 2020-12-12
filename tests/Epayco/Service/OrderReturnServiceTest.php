<?php

namespace Epayco\Service;

/**
 * @internal
 * @covers \Epayco\Service\OrderReturnService
 */
final class OrderReturnServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Epayco\TestHelper;

    const TEST_RESOURCE_ID = 'orret_123';

    /** @var \Epayco\EpaycoClient */
    private $client;

    /** @var OrderReturnService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Epayco\EpaycoClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new OrderReturnService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/v1/order_returns'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Epayco\OrderReturn::class, $resources->data[0]);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/v1/order_returns/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Epayco\OrderReturn::class, $resource);
    }
}
