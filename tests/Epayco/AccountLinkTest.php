<?php

namespace Epayco;

/**
 * @internal
 * @covers \Epayco\AccountLink
 */
final class AccountLinkTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/v1/account_links'
        );
        $resource = AccountLink::create([
            'account' => 'acct_123',
            'refresh_url' => 'https://stripe.com/refresh_url',
            'return_url' => 'https://stripe.com/return_url',
            'type' => 'account_onboarding',
        ]);
        static::assertInstanceOf(\Epayco\AccountLink::class, $resource);
    }
}