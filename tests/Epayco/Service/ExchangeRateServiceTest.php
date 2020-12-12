<?php

namespace Epayco\Service;

/**
 * @internal
 * @covers \Epayco\Service\ExchangeRateService
 */
final class ExchangeRateServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Epayco\TestHelper;

    /** @var \Epayco\EpaycoClient */
    private $client;

    /** @var ExchangeRateService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Epayco\EpaycoClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new ExchangeRateService($this->client);
    }

    public function testAll()
    {
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Epayco\ExchangeRate::class, $resources->data[0]);
    }

    public function testRetrieve()
    {
        $resource = $this->service->retrieve('usd');
        static::assertInstanceOf(\Epayco\ExchangeRate::class, $resource);
    }
}
