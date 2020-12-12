<?php

// File generated from our OpenAPI spec

namespace Epayco;

/**
 * This is an object representing your Epayco balance. You can retrieve it to see
 * the balance currently on your Epayco account.
 *
 * You can also retrieve the balance history, which contains a list of <a
 * href="https://epayco.com/docs/reporting/balance-transaction-types">transactions</a>
 * that contributed to the balance (charges, payouts, and so forth).
 *
 * The available and pending amounts for each currency are broken down further by
 * payment source types.
 *
 * Related guide: <a
 * href="https://epayco.com/docs/connect/account-balances">Understanding Connect
 * Account Balances</a>.
 *
 * @property string $object String representing the object's type. Objects of the same type share the same value.
 * @property \Epayco\EpaycoObject[] $available Funds that are available to be transferred or paid out, whether automatically by Epayco or explicitly via the <a href="https://epayco.com/docs/api#transfers">Transfers API</a> or <a href="https://epayco.com/docs/api#payouts">Payouts API</a>. The available balance for each currency and payment type can be found in the <code>source_types</code> property.
 * @property \Epayco\EpaycoObject[] $connect_reserved Funds held due to negative balances on connected Custom accounts. The connect reserve balance for each currency and payment type can be found in the <code>source_types</code> property.
 * @property \Epayco\EpaycoObject[] $instant_available Funds that can be paid out using Instant Payouts.
 * @property \Epayco\EpaycoObject $issuing
 * @property bool $livemode Has the value <code>true</code> if the object exists in live mode or the value <code>false</code> if the object exists in test mode.
 * @property \Epayco\EpaycoObject[] $pending Funds that are not yet available in the balance, due to the 7-day rolling pay cycle. The pending balance for each currency, and for each payment type, can be found in the <code>source_types</code> property.
 */
class Balance extends SingletonApiResource
{
    const OBJECT_NAME = 'balance';

    /**
     * @param null|array|string $opts
     *
     * @throws \Epayco\Exception\ApiErrorException if the request fails
     *
     * @return \Epayco\Balance
     */
    public static function retrieve($opts = null)
    {
        return self::_singletonRetrieve($opts);
    }
}
