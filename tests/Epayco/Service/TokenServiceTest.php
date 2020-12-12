<?php

namespace Epayco\Service;

/**
 * @internal
 * @covers \Epayco\Service\TokenService
 */
final class TokenServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Epayco\TestHelper;

    const TEST_RESOURCE_ID = 'tok_123';

    /** @var \Epayco\EpaycoClient */
    private $client;

    /** @var TokenService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Epayco\EpaycoClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new TokenService($this->client);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/v1/tokens'
        );
        $resource = $this->service->create(['card' => 'tok_visa']);
        static::assertInstanceOf(\Epayco\Token::class, $resource);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/v1/tokens/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Epayco\Token::class, $resource);
    }
}
