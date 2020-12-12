<?php

namespace Epayco\Service;

/**
 * @internal
 * @covers \Epayco\Service\EventService
 */
final class EventServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Epayco\TestHelper;

    const TEST_RESOURCE_ID = 'evt_123';

    /** @var \Epayco\EpaycoClient */
    private $client;

    /** @var EventService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Epayco\EpaycoClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new EventService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/v1/events'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Epayco\Event::class, $resources->data[0]);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/v1/events/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Epayco\Event::class, $resource);
    }
}
