<?php

namespace Epayco\Service;

/**
 * @internal
 * @covers \Epayco\Service\CountrySpecService
 */
final class CountrySpecServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Epayco\TestHelper;

    const TEST_RESOURCE_ID = 'US';

    /** @var \Epayco\EpaycoClient */
    private $client;

    /** @var CountrySpecService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Epayco\EpaycoClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new CountrySpecService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/v1/country_specs'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Epayco\CountrySpec::class, $resources->data[0]);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/v1/country_specs/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Epayco\CountrySpec::class, $resource);
    }
}
