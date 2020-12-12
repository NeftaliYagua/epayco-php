<?php

namespace Epayco\Service;

/**
 * @internal
 * @covers \Epayco\Service\AccountLinkService
 */
final class AccountLinkServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Epayco\TestHelper;

    /** @var \Epayco\EpaycoClient */
    private $client;

    /** @var AccountLinkService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Epayco\EpaycoClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new AccountLinkService($this->client);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/v1/account_links'
        );
        $resource = $this->service->create([
            'account' => 'acct_123',
            'refresh_url' => 'https://stripe.com/refresh_url',
            'return_url' => 'https://stripe.com/return_url',
            'type' => 'account_onboarding',
        ]);
        static::assertInstanceOf(\Epayco\AccountLink::class, $resource);
    }
}
