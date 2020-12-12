<?php

namespace Epayco\Service\BillingPortal;

/**
 * @internal
 * @covers \Epayco\Service\BillingPortal\SessionService
 */
final class SessionServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Epayco\TestHelper;

    const TEST_RESOURCE_ID = 'cs_123';

    /** @var \Epayco\EpaycoClient */
    private $client;

    /** @var SessionService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Epayco\EpaycoClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new SessionService($this->client);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/v1/billing_portal/sessions'
        );
        $resource = $this->service->create([
            'customer' => 'cus_123',
            'return_url' => 'https://stripe.com/return',
        ]);
        static::assertInstanceOf(\Epayco\BillingPortal\Session::class, $resource);
    }
}
