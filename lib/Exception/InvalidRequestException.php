<?php

namespace Epayco\Exception;

/**
 * InvalidRequestException is thrown when a request is initiated with invalid
 * parameters.
 */
class InvalidRequestException extends ApiErrorException
{
    protected $epaycoParam;

    /**
     * Creates a new InvalidRequestException exception.
     *
     * @param string $message the exception message
     * @param null|int $httpStatus the HTTP status code
     * @param null|string $httpBody the HTTP body as a string
     * @param null|array $jsonBody the JSON deserialized body
     * @param null|array|\Epayco\Util\CaseInsensitiveArray $httpHeaders the HTTP headers array
     * @param null|string $epaycoCode the Epayco error code
     * @param null|string $epaycoParam the parameter related to the error
     *
     * @return InvalidRequestException
     */
    public static function factory(
        $message,
        $httpStatus = null,
        $httpBody = null,
        $jsonBody = null,
        $httpHeaders = null,
        $epaycoCode = null,
        $epaycoParam = null
    ) {
        $instance = parent::factory($message, $httpStatus, $httpBody, $jsonBody, $httpHeaders, $epaycoCode);
        $instance->setEpaycoParam($epaycoParam);

        return $instance;
    }

    /**
     * Gets the parameter related to the error.
     *
     * @return null|string
     */
    public function getEpaycoParam()
    {
        return $this->epaycoParam;
    }

    /**
     * Sets the parameter related to the error.
     *
     * @param null|string $epaycoParam
     */
    public function setEpaycoParam($epaycoParam)
    {
        $this->epaycoParam = $epaycoParam;
    }
}
