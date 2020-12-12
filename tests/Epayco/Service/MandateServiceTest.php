<?php

namespace Epayco\Service;

/**
 * @internal
 * @covers \Epayco\Service\MandateService
 */
final class MandateServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Epayco\TestHelper;

    const TEST_RESOURCE_ID = 'mandate_123';

    /** @var \Epayco\EpaycoClient */
    private $client;

    /** @var MandateService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Epayco\EpaycoClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new MandateService($this->client);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/v1/mandates/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Epayco\Mandate::class, $resource);
    }
}
