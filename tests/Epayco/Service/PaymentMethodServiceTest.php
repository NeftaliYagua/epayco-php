<?php

namespace Epayco\Service;

/**
 * @internal
 * @covers \Epayco\Service\PaymentMethodService
 */
final class PaymentMethodServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Epayco\TestHelper;

    const TEST_RESOURCE_ID = 'pm_123';

    /** @var \Epayco\EpaycoClient */
    private $client;

    /** @var PaymentMethodService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Epayco\EpaycoClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new PaymentMethodService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/v1/payment_methods'
        );
        $resources = $this->service->all([
            'customer' => 'cus_123',
            'type' => 'card',
        ]);
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Epayco\PaymentMethod::class, $resources->data[0]);
    }

    public function testAttach()
    {
        $this->expectsRequest(
            'post',
            '/v1/payment_methods/' . self::TEST_RESOURCE_ID . '/attach'
        );
        $resource = $this->service->attach(self::TEST_RESOURCE_ID, [
            'customer' => 'cus_123',
        ]);
        static::assertInstanceOf(\Epayco\PaymentMethod::class, $resource);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/v1/payment_methods'
        );
        $resource = $this->service->create([
            'type' => 'card',
        ]);
        static::assertInstanceOf(\Epayco\PaymentMethod::class, $resource);
    }

    public function testDetach()
    {
        $this->expectsRequest(
            'post',
            '/v1/payment_methods/' . self::TEST_RESOURCE_ID . '/detach'
        );
        $resource = $this->service->detach(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Epayco\PaymentMethod::class, $resource);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/v1/payment_methods/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Epayco\PaymentMethod::class, $resource);
    }

    public function testUpdate()
    {
        $this->expectsRequest(
            'post',
            '/v1/payment_methods/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Epayco\PaymentMethod::class, $resource);
    }
}
