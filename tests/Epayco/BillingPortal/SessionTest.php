<?php

namespace Epayco\BillingPortal;

/**
 * @internal
 * @covers \Epayco\BillingPortal\Session
 */
final class SessionTest extends \PHPUnit\Framework\TestCase
{
    use \Epayco\TestHelper;

    const TEST_RESOURCE_ID = 'pts_123';

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/v1/billing_portal/sessions'
        );
        $resource = Session::create([
            'customer' => 'cus_123',
            'return_url' => 'https://stripe.com/return',
        ]);
        static::assertInstanceOf(\Epayco\BillingPortal\Session::class, $resource);
    }
}
