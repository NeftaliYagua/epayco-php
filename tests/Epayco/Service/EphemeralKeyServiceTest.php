<?php

namespace Epayco\Service;

/**
 * @internal
 * @covers \Epayco\Service\EphemeralKeyService
 */
final class EphemeralKeyServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Epayco\TestHelper;

    const TEST_RESOURCE_ID = 'ek_123';

    /** @var \Epayco\EpaycoClient */
    private $client;

    /** @var EphemeralKeyService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Epayco\EpaycoClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new EphemeralKeyService($this->client);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/v1/ephemeral_keys',
            null,
            ['Epayco-Version: 2017-05-25']
        );
        $resource = $this->service->create([
            'customer' => 'cus_123',
        ], ['epayco_version' => '2017-05-25']);
        static::assertInstanceOf(\Epayco\EphemeralKey::class, $resource);
    }

    public function testCreateWithoutExplicitApiVersion()
    {
        $this->expectException(\InvalidArgumentException::class);

        $resource = $this->service->create([
            'customer' => 'cus_123',
        ]);
    }

    public function testDelete()
    {
        $this->expectsRequest(
            'delete',
            '/v1/ephemeral_keys/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->delete(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Epayco\EphemeralKey::class, $resource);
    }
}
