<?php

// File generated from our OpenAPI spec

namespace Epayco\Service;

class AccountLinkService extends \Epayco\Service\AbstractService
{
    /**
     * Creates an AccountLink object that includes a single-use Epayco URL that the
     * platform can redirect their user to in order to take them through the Connect
     * Onboarding flow.
     *
     * @param null|array $params
     * @param null|array|\Epayco\Util\RequestOptions $opts
     *
     * @throws \Epayco\Exception\ApiErrorException if the request fails
     *
     * @return \Epayco\AccountLink
     */
    public function create($params = null, $opts = null)
    {
        return $this->request('post', '/v1/account_links', $params, $opts);
    }
}
