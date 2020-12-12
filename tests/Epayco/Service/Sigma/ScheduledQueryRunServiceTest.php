<?php

namespace Epayco\Service\Sigma;

/**
 * @internal
 * @covers \Epayco\Service\Sigma\ScheduledQueryRunService
 */
final class ScheduledQueryRunServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Epayco\TestHelper;

    const TEST_RESOURCE_ID = 'sqr_123';

    /** @var \Epayco\EpaycoClient */
    private $client;

    /** @var ScheduledQueryRunService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Epayco\EpaycoClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new ScheduledQueryRunService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/v1/sigma/scheduled_query_runs'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Epayco\Sigma\ScheduledQueryRun::class, $resources->data[0]);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/v1/sigma/scheduled_query_runs/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Epayco\Sigma\ScheduledQueryRun::class, $resource);
    }
}
