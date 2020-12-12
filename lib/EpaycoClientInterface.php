<?php

namespace Epayco;

/**
 * Interface for a Epayco client.
 */
interface EpaycoClientInterface
{
    /**
     * Gets the API key used by the client to send requests.
     *
     * @return null|string the API key used by the client to send requests
     */
    public function getApiKey();

    /**
     * Gets the client ID used by the client in OAuth requests.
     *
     * @return null|string the client ID used by the client in OAuth requests
     */
    public function getClientId();

    /**
     * Gets the base URL for Epayco's API.
     *
     * @return string the base URL for Epayco's API
     */
    public function getApiBase();

    /**
     * Gets the base URL for Epayco's OAuth API.
     *
     * @return string the base URL for Epayco's OAuth API
     */
    public function getConnectBase();

    /**
     * Gets the base URL for Epayco's Files API.
     *
     * @return string the base URL for Epayco's Files API
     */
    public function getFilesBase();

    /**
     * Sends a request to Epayco's API.
     *
     * @param string $method the HTTP method
     * @param string $path the path of the request
     * @param array $params the parameters of the request
     * @param array|\Epayco\Util\RequestOptions $opts the special modifiers of the request
     *
     * @return \Epayco\EpaycoObject the object returned by Epayco's API
     */
    public function request($method, $path, $params, $opts);
}
