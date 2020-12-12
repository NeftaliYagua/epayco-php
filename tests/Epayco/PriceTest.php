<?php

namespace Epayco;

/**
 * @internal
 * @covers \Epayco\Price
 */
final class PriceTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'price_123';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/v1/prices'
        );
        $resources = Price::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Epayco\Price::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/v1/prices/' . self::TEST_RESOURCE_ID
        );
        $resource = Price::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Epayco\Price::class, $resource);
    }

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/v1/prices'
        );
        $resource = Price::create([
            'unit_amount' => 2000,
            'currency' => 'usd',
            'recurring' => [
                'interval' => 'month',
            ],
            'product_data' => [
                'name' => 'Product Name',
            ],
        ]);
        static::assertInstanceOf(\Epayco\Price::class, $resource);
    }

    public function testIsSaveable()
    {
        $resource = Price::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/v1/prices/' . $resource->id
        );
        $resource->save();
        static::assertInstanceOf(\Epayco\Price::class, $resource);
    }

    public function testIsUpdatable()
    {
        $this->expectsRequest(
            'post',
            '/v1/prices/' . self::TEST_RESOURCE_ID
        );
        $resource = Price::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Epayco\Price::class, $resource);
    }
}
