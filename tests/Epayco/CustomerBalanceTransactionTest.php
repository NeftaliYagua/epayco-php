<?php

namespace Epayco;

/**
 * @internal
 * @covers \Epayco\CustomerBalanceTransaction
 */
final class CustomerBalanceTransactionTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_CUSTOMER_ID = 'cus_123';
    const TEST_RESOURCE_ID = 'cbtxn_123';

    public function testHasCorrectUrl()
    {
        $resource = \Epayco\Customer::retrieveBalanceTransaction(self::TEST_CUSTOMER_ID, self::TEST_RESOURCE_ID);
        static::assertSame(
            '/v1/customers/' . self::TEST_CUSTOMER_ID . '/balance_transactions/' . self::TEST_RESOURCE_ID,
            $resource->instanceUrl()
        );
    }
}
