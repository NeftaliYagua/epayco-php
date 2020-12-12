<?php

namespace Epayco\Service\Terminal;

/**
 * @internal
 * @covers \Epayco\Service\Terminal\ConnectionTokenService
 */
final class ConnectionTokenServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Epayco\TestHelper;

    /** @var \Epayco\EpaycoClient */
    private $client;

    /** @var ConnectionTokenService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Epayco\EpaycoClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new ConnectionTokenService($this->client);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/v1/terminal/connection_tokens'
        );
        $resource = $this->service->create();
        static::assertInstanceOf(\Epayco\Terminal\ConnectionToken::class, $resource);
    }
}
