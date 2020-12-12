<?php

namespace Epayco\Service;

/**
 * @internal
 * @covers \Epayco\Service\PriceService
 */
final class PriceServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Epayco\TestHelper;

    const TEST_RESOURCE_ID = 'prod_123';

    /** @var \Epayco\EpaycoClient */
    private $client;

    /** @var PriceService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Epayco\EpaycoClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new PriceService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/v1/prices'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Epayco\Price::class, $resources->data[0]);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/v1/prices'
        );
        $resource = $this->service->create([
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

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/v1/prices/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Epayco\Price::class, $resource);
    }

    public function testUpdate()
    {
        $this->expectsRequest(
            'post',
            '/v1/prices/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Epayco\Price::class, $resource);
    }
}
