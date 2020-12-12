<?php

namespace Epayco\Service;

/**
 * @internal
 * @covers \Epayco\Service\SetupAttemptService
 */
final class SetupAttemptServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Epayco\TestHelper;

    /** @var \Epayco\EpaycoClient */
    private $client;

    /** @var SetupAttemptService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Epayco\EpaycoClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new SetupAttemptService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/v1/setup_attempts'
        );
        $resources = $this->service->all([
            'setup_intent' => 'si_123',
        ]);
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Epayco\SetupAttempt::class, $resources->data[0]);
    }
}
