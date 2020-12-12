<?php

namespace Epayco\Exception\OAuth;

/**
 * Implements properties and methods common to all (non-SPL) Epayco OAuth
 * exceptions.
 */
abstract class OAuthErrorException extends \Epayco\Exception\ApiErrorException
{
    protected function constructErrorObject()
    {
        if (null === $this->jsonBody) {
            return null;
        }

        return \Epayco\OAuthErrorObject::constructFrom($this->jsonBody);
    }
}
