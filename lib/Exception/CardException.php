<?php

namespace Epayco\Exception;

/**
 * CardException is thrown when a user enters a card that can't be charged for
 * some reason.
 */
class CardException extends ApiErrorException
{
    protected $declineCode;
    protected $epaycoParam;

    /**
     * Creates a new CardException exception.
     *
     * @param string $message the exception message
     * @param null|int $httpStatus the HTTP status code
     * @param null|string $httpBody the HTTP body as a string
     * @param null|array $jsonBody the JSON deserialized body
     * @param null|array|\Epayco\Util\CaseInsensitiveArray $httpHeaders the HTTP headers array
     * @param null|string $epaycoCode the Epayco error code
     * @param null|string $declineCode the decline code
     * @param null|string $epaycoParam the parameter related to the error
     *
     * @return CardException
     */
    public static function factory(
        $message,
        $httpStatus = null,
        $httpBody = null,
        $jsonBody = null,
        $httpHeaders = null,
        $epaycoCode = null,
        $declineCode = null,
        $epaycoParam = null
    ) {
        $instance = parent::factory($message, $httpStatus, $httpBody, $jsonBody, $httpHeaders, $epaycoCode);
        $instance->setDeclineCode($declineCode);
        $instance->setEpaycoParam($epaycoParam);

        return $instance;
    }

    /**
     * Gets the decline code.
     *
     * @return null|string
     */
    public function getDeclineCode()
    {
        return $this->declineCode;
    }

    /**
     * Sets the decline code.
     *
     * @param null|string $declineCode
     */
    public function setDeclineCode($declineCode)
    {
        $this->declineCode = $declineCode;
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
