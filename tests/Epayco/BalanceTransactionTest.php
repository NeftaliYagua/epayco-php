<?php

namespace Epayco;

/**
 * @internal
 * @covers \Epayco\BalanceTransaction
 */
final class BalanceTransactionTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'txn_123';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/v1/balance_transactions'
        );
        $resources = BalanceTransaction::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Epayco\BalanceTransaction::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/v1/balance_transactions/' . self::TEST_RESOURCE_ID
        );
        $resource = BalanceTransaction::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Epayco\BalanceTransaction::class, $resource);
    }
}
