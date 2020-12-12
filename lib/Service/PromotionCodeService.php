<?php

// File generated from our OpenAPI spec

namespace Epayco\Service;

class PromotionCodeService extends \Epayco\Service\AbstractService
{
    /**
     * Returns a list of your promotion codes.
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
        return $this->requestCollection('get', '/v1/promotion_codes', $params, $opts);
    }

    /**
     * A promotion code points to a coupon. You can optionally restrict the code to a
     * specific customer, redemption limit, and expiration date.
     *
     * @param null|array $params
     * @param null|array|\Epayco\Util\RequestOptions $opts
     *
     * @throws \Epayco\Exception\ApiErrorException if the request fails
     *
     * @return \Epayco\PromotionCode
     */
    public function create($params = null, $opts = null)
    {
        return $this->request('post', '/v1/promotion_codes', $params, $opts);
    }

    /**
     * Retrieves the promotion code with the given ID.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Epayco\Util\RequestOptions $opts
     *
     * @throws \Epayco\Exception\ApiErrorException if the request fails
     *
     * @return \Epayco\PromotionCode
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/v1/promotion_codes/%s', $id), $params, $opts);
    }

    /**
     * Updates the specified promotion code by setting the values of the parameters
     * passed. Most fields are, by design, not editable.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Epayco\Util\RequestOptions $opts
     *
     * @throws \Epayco\Exception\ApiErrorException if the request fails
     *
     * @return \Epayco\PromotionCode
     */
    public function update($id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/v1/promotion_codes/%s', $id), $params, $opts);
    }
}
