<?php

namespace Epayco\Service;

/**
 * @internal
 * @covers \Epayco\Service\SetupIntentService
 */
final class SetupIntentServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Epayco\TestHelper;

    const TEST_RESOURCE_ID = 'seti_123';

    /** @var \Epayco\EpaycoClient */
    private $client;

    /** @var SetupIntentService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Epayco\EpaycoClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new SetupIntentService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/v1/setup_intents'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Epayco\SetupIntent::class, $resources->data[0]);
    }

    public function testCancel()
    {
        $this->expectsRequest(
            'post',
            '/v1/setup_intents/' . self::TEST_RESOURCE_ID . '/cancel'
        );
        $resource = $this->service->cancel(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Epayco\SetupIntent::class, $resource);
    }

    public function testConfirm()
    {
        $this->expectsRequest(
            'post',
            '/v1/setup_intents/' . self::TEST_RESOURCE_ID . '/confirm'
        );
        $resource = $this->service->confirm(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Epayco\SetupIntent::class, $resource);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/v1/setup_intents'
        );
        $resource = $this->service->create([
            'payment_method_types' => ['card'],
        ]);
        static::assertInstanceOf(\Epayco\SetupIntent::class, $resource);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/v1/setup_intents/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Epayco\SetupIntent::class, $resource);
    }

    public function testUpdate()
    {
        $this->expectsRequest(
            'post',
            '/v1/setup_intents/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->update(
            self::TEST_RESOURCE_ID,
            [
                'metadata' => ['key' => 'value'],
            ]
        );
        static::assertInstanceOf(\Epayco\SetupIntent::class, $resource);
    }
}