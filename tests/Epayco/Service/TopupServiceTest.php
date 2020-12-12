<?php

namespace Epayco\Service;

/**
 * @internal
 * @covers \Epayco\Service\TopupService
 */
final class TopupServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Epayco\TestHelper;

    const TEST_RESOURCE_ID = 'tu_123';

    /** @var \Epayco\EpaycoClient */
    private $client;

    /** @var TopupService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Epayco\EpaycoClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new TopupService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/v1/topups'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Epayco\Topup::class, $resources->data[0]);
    }

    public function testCancel()
    {
        $this->expectsRequest(
            'post',
            '/v1/topups/' . self::TEST_RESOURCE_ID . '/cancel'
        );
        $resource = $this->service->cancel(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Epayco\Topup::class, $resource);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/v1/topups'
        );
        $resource = $this->service->create([
            'amount' => 100,
            'currency' => 'usd',
            'source' => 'tok_123',
            'description' => 'description',
            'statement_descriptor' => 'statement descriptor',
        ]);
        static::assertInstanceOf(\Epayco\Topup::class, $resource);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/v1/topups/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Epayco\Topup::class, $resource);
    }

    public function testUpdate()
    {
        $this->expectsRequest(
            'post',
            '/v1/topups/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Epayco\Topup::class, $resource);
    }
}
