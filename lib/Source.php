<?php

// File generated from our OpenAPI spec

namespace Epayco;

/**
 * <code>Source</code> objects allow you to accept a variety of payment methods.
 * They represent a customer's payment instrument, and can be used with the Epayco
 * API just like a <code>Card</code> object: once chargeable, they can be charged,
 * or can be attached to customers.
 *
 * Related guides: <a href="https://epayco.com/docs/sources">Sources API</a> and <a
 * href="https://epayco.com/docs/sources/customers">Sources &amp; Customers</a>.
 *
 * @property string $id Unique identifier for the object.
 * @property string $object String representing the object's type. Objects of the same type share the same value.
 * @property \Epayco\EpaycoObject $ach_credit_transfer
 * @property \Epayco\EpaycoObject $ach_debit
 * @property \Epayco\EpaycoObject $acss_debit
 * @property \Epayco\EpaycoObject $alipay
 * @property null|int $amount A positive integer in the smallest currency unit (that is, 100 cents for $1.00, or 1 for ¥1, Japanese Yen being a zero-decimal currency) representing the total amount associated with the source. This is the amount for which the source will be chargeable once ready. Required for <code>single_use</code> sources.
 * @property \Epayco\EpaycoObject $au_becs_debit
 * @property \Epayco\EpaycoObject $bancontact
 * @property \Epayco\EpaycoObject $card
 * @property \Epayco\EpaycoObject $card_present
 * @property string $client_secret The client secret of the source. Used for client-side retrieval using a publishable key.
 * @property \Epayco\EpaycoObject $code_verification
 * @property int $created Time at which the object was created. Measured in seconds since the Unix epoch.
 * @property null|string $currency Three-letter <a href="https://epayco.com/docs/currencies">ISO code for the currency</a> associated with the source. This is the currency for which the source will be chargeable once ready. Required for <code>single_use</code> sources.
 * @property string $customer The ID of the customer to which this source is attached. This will not be present when the source has not been attached to a customer.
 * @property \Epayco\EpaycoObject $eps
 * @property string $flow The authentication <code>flow</code> of the source. <code>flow</code> is one of <code>redirect</code>, <code>receiver</code>, <code>code_verification</code>, <code>none</code>.
 * @property \Epayco\EpaycoObject $giropay
 * @property \Epayco\EpaycoObject $ideal
 * @property \Epayco\EpaycoObject $klarna
 * @property bool $livemode Has the value <code>true</code> if the object exists in live mode or the value <code>false</code> if the object exists in test mode.
 * @property null|\Epayco\EpaycoObject $metadata Set of <a href="https://epayco.com/docs/api/metadata">key-value pairs</a> that you can attach to an object. This can be useful for storing additional information about the object in a structured format.
 * @property \Epayco\EpaycoObject $multibanco
 * @property null|\Epayco\EpaycoObject $owner Information about the owner of the payment instrument that may be used or required by particular source types.
 * @property \Epayco\EpaycoObject $p24
 * @property \Epayco\EpaycoObject $receiver
 * @property \Epayco\EpaycoObject $redirect
 * @property \Epayco\EpaycoObject $sepa_credit_transfer
 * @property \Epayco\EpaycoObject $sepa_debit
 * @property \Epayco\EpaycoObject $sofort
 * @property \Epayco\EpaycoObject $source_order
 * @property null|string $statement_descriptor Extra information about a source. This will appear on your customer's statement every time you charge the source.
 * @property string $status The status of the source, one of <code>canceled</code>, <code>chargeable</code>, <code>consumed</code>, <code>failed</code>, or <code>pending</code>. Only <code>chargeable</code> sources can be used to create a charge.
 * @property \Epayco\EpaycoObject $three_d_secure
 * @property string $type The <code>type</code> of the source. The <code>type</code> is a payment method, one of <code>ach_credit_transfer</code>, <code>ach_debit</code>, <code>alipay</code>, <code>bancontact</code>, <code>card</code>, <code>card_present</code>, <code>eps</code>, <code>giropay</code>, <code>ideal</code>, <code>multibanco</code>, <code>klarna</code>, <code>p24</code>, <code>sepa_debit</code>, <code>sofort</code>, <code>three_d_secure</code>, or <code>wechat</code>. An additional hash is included on the source with a name matching this value. It contains additional information specific to the <a href="https://epayco.com/docs/sources">payment method</a> used.
 * @property null|string $usage Either <code>reusable</code> or <code>single_use</code>. Whether this source should be reusable or not. Some source types may or may not be reusable by construction, while others may leave the option at creation. If an incompatible value is passed, an error will be returned.
 * @property \Epayco\EpaycoObject $wechat
 */
class Source extends ApiResource
{
    const OBJECT_NAME = 'source';

    use ApiOperations\Create;
    use ApiOperations\Retrieve;
    use ApiOperations\Update;

    const FLOW_CODE_VERIFICATION = 'code_verification';
    const FLOW_NONE = 'none';
    const FLOW_RECEIVER = 'receiver';
    const FLOW_REDIRECT = 'redirect';

    const STATUS_CANCELED = 'canceled';
    const STATUS_CHARGEABLE = 'chargeable';
    const STATUS_CONSUMED = 'consumed';
    const STATUS_FAILED = 'failed';
    const STATUS_PENDING = 'pending';

    const USAGE_REUSABLE = 'reusable';
    const USAGE_SINGLE_USE = 'single_use';

    use ApiOperations\NestedResource;

    /**
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @throws \Epayco\Exception\UnexpectedValueException if the source is not attached to a customer
     * @throws \Epayco\Exception\ApiErrorException if the request fails
     *
     * @return \Epayco\Source the detached source
     */
    public function detach($params = null, $opts = null)
    {
        self::_validateParams($params);

        $id = $this['id'];
        if (!$id) {
            $class = static::class;
            $msg = "Could not determine which URL to request: {$class} instance "
             . "has invalid ID: {$id}";

            throw new Exception\UnexpectedValueException($msg, null);
        }

        if ($this['customer']) {
            $base = Customer::classUrl();
            $parentExtn = \urlencode(Util\Util::utf8($this['customer']));
            $extn = \urlencode(Util\Util::utf8($id));
            $url = "{$base}/{$parentExtn}/sources/{$extn}";

            list($response, $opts) = $this->_request('delete', $url, $params, $opts);
            $this->refreshFrom($response, $opts);

            return $this;
        }
        $message = 'This source object does not appear to be currently attached '
               . 'to a customer object.';

        throw new Exception\UnexpectedValueException($message);
    }

    /**
     * @deprecated sourceTransactions is deprecated. Please use Source::allSourceTransactions instead.
     *
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @throws \Epayco\Exception\ApiErrorException if the request fails
     *
     * @return \Epayco\Collection the list of source transactions
     */
    public function sourceTransactions($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/source_transactions';
        list($response, $opts) = $this->_request('get', $url, $params, $opts);
        $obj = \Epayco\Util\Util::convertToEpaycoObject($response, $opts);
        $obj->setLastResponse($response);

        return $obj;
    }

    /**
     * @param string $id
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @throws \Epayco\Exception\ApiErrorException if the request fails
     *
     * @return \Epayco\Collection the list of source transactions
     */
    public static function allSourceTransactions($id, $params = null, $opts = null)
    {
        return self::_allNestedResources($id, '/source_transactions', $params, $opts);
    }

    /**
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @throws \Epayco\Exception\ApiErrorException if the request fails
     *
     * @return Source the verified source
     */
    public function verify($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/verify';
        list($response, $opts) = $this->_request('post', $url, $params, $opts);
        $this->refreshFrom($response, $opts);

        return $this;
    }
}
