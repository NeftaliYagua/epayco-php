<?php

// File generated from our OpenAPI spec

namespace Epayco\Service\Terminal;

class ConnectionTokenService extends \Epayco\Service\AbstractService
{
    /**
     * To connect to a reader the Epayco Terminal SDK needs to retrieve a short-lived
     * connection token from Epayco, proxied through your server. On your backend, add
     * an endpoint that creates and returns a connection token.
     *
     * @param null|array $params
     * @param null|array|\Epayco\Util\RequestOptions $opts
     *
     * @throws \Epayco\Exception\ApiErrorException if the request fails
     *
     * @return \Epayco\Terminal\ConnectionToken
     */
    public function create($params = null, $opts = null)
    {
        return $this->request('post', '/v1/terminal/connection_tokens', $params, $opts);
    }
}
