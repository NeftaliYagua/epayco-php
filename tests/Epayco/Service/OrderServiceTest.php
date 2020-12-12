<?php

namespace Epayco\Service;

/**
 * @internal
 * @covers \Epayco\Service\OrderService
 */
final class OrderServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Epayco\TestHelper;

    const TEST_RESOURCE_ID = 'or_123';

    /** @var \Epayco\EpaycoClient */
    private $client;

    /** @var OrderService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Epayco\EpaycoClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new OrderService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/v1/orders'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Epayco\Order::class, $resources->data[0]);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/v1/orders'
        );
        $resource = $this->service->create([
            'currency' => 'usd',
        ]);
        static::assertInstanceOf(\Epayco\Order::class, $resource);
    }

    public function testPay()
    {
        $this->expectsRequest(
            'post',
            '/v1/orders/' . self::TEST_RESOURCE_ID . '/pay'
        );
        $resource = $this->service->pay(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Epayco\Order::class, $resource);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/v1/orders/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Epayco\Order::class, $resource);
    }

    public function testReturnOrder()
    {
        $this->expectsRequest(
            'post',
            '/v1/orders/' . self::TEST_RESOURCE_ID . '/returns'
        );
        $resource = $this->service->returnOrder(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Epayco\OrderReturn::class, $resource);
    }

    public function testUpdate()
    {
        $this->expectsRequest(
            'post',
            '/v1/orders/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Epayco\Order::class, $resource);
    }
}
