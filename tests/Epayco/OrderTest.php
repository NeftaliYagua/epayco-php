<?php

namespace Epayco;

/**
 * @internal
 * @covers \Epayco\Order
 */
final class OrderTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'or_123';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/v1/orders'
        );
        $resources = Order::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Epayco\Order::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/v1/orders/' . self::TEST_RESOURCE_ID
        );
        $resource = Order::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Epayco\Order::class, $resource);
    }

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/v1/orders'
        );
        $resource = Order::create([
            'currency' => 'usd',
        ]);
        static::assertInstanceOf(\Epayco\Order::class, $resource);
    }

    public function testIsSaveable()
    {
        $resource = Order::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/v1/orders/' . $resource->id
        );
        $resource->save();
        static::assertInstanceOf(\Epayco\Order::class, $resource);
    }

    public function testIsUpdatable()
    {
        $this->expectsRequest(
            'post',
            '/v1/orders/' . self::TEST_RESOURCE_ID
        );
        $resource = Order::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Epayco\Order::class, $resource);
    }

    public function testIsPayable()
    {
        $resource = Order::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/v1/orders/' . $resource->id . '/pay'
        );
        $resource->pay();
        static::assertInstanceOf(\Epayco\Order::class, $resource);
    }

    public function testIsReturnable()
    {
        $order = Order::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/v1/orders/' . $order->id . '/returns'
        );
        $resource = $order->returnOrder();
        static::assertInstanceOf(\Epayco\OrderReturn::class, $resource);
    }
}
