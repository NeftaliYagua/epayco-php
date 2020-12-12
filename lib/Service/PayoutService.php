<?php

// File generated from our OpenAPI spec

namespace Epayco\Service;

class PayoutService extends \Epayco\Service\AbstractService
{
    /**
     * Returns a list of existing payouts sent to third-party bank accounts or that
     * Epayco has sent you. The payouts are returned in sorted order, with the most
     * recently created payouts appearing first.
     *
     * @param null|array $params
     * @param null|array|\Epayco\Util\RequestOptions $opts
     *
     * @throws \Epayco\Exception\ApiErrorException if the request fails
     *
     * @return \Epayco\Collection
     */
    public function all($params = null, $opts = null)
    {
        return $this->requestCollection('get', '/v1/payouts', $params, $opts);
    }

    /**
     * A previously created payout can be canceled if it has not yet been paid out.
     * Funds will be refunded to your available balance. You may not cancel automatic
     * Epayco payouts.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Epayco\Util\RequestOptions $opts
     *
     * @throws \Epayco\Exception\ApiErrorException if the request fails
     *
     * @return \Epayco\Payout
     */
    public function cancel($id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/v1/payouts/%s/cancel', $id), $params, $opts);
    }

    /**
     * To send funds to your own bank account, you create a new payout object. Your <a
     * href="#balance">Epayco balance</a> must be able to cover the payout amount, or
     * you’ll receive an “Insufficient Funds” error.
     *
     * If your API key is in test mode, money won’t actually be sent, though everything
     * else will occur as if in live mode.
     *
     * If you are creating a manual payout on a Epayco account that uses multiple
     * payment source types, you’ll need to specify the source type balance that the
     * payout should draw from. The <a href="#balance_object">balance object</a>
     * details available and pending amounts by source type.
     *
     * @param null|array $params
     * @param null|array|\Epayco\Util\RequestOptions $opts
     *
     * @throws \Epayco\Exception\ApiErrorException if the request fails
     *
     * @return \Epayco\Payout
     */
    public function create($params = null, $opts = null)
    {
        return $this->request('post', '/v1/payouts', $params, $opts);
    }

    /**
     * Retrieves the details of an existing payout. Supply the unique payout ID from
     * either a payout creation request or the payout list, and Epayco will return the
     * corresponding payout information.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Epayco\Util\RequestOptions $opts
     *
     * @throws \Epayco\Exception\ApiErrorException if the request fails
     *
     * @return \Epayco\Payout
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/v1/payouts/%s', $id), $params, $opts);
    }

    /**
     * Reverses a payout by debiting the destination bank account. Only payouts for
     * connected accounts to US bank accounts may be reversed at this time. If the
     * payout is in the <code>pending</code> status,
     * <code>/v1/payouts/:id/cancel</code> should be used instead.
     *
     * By requesting a reversal via <code>/v1/payouts/:id/reverse</code>, you confirm
     * that the authorized signatory of the selected bank account has authorized the
     * debit on the bank account and that no other authorization is required.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Epayco\Util\RequestOptions $opts
     *
     * @throws \Epayco\Exception\ApiErrorException if the request fails
     *
     * @return \Epayco\Payout
     */
    public function reverse($id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/v1/payouts/%s/reverse', $id), $params, $opts);
    }

    /**
     * Updates the specified payout by setting the values of the parameters passed. Any
     * parameters not provided will be left unchanged. This request accepts only the
     * metadata as arguments.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Epayco\Util\RequestOptions $opts
     *
     * @throws \Epayco\Exception\ApiErrorException if the request fails
     *
     * @return \Epayco\Payout
     */
    public function update($id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/v1/payouts/%s', $id), $params, $opts);
    }
}
