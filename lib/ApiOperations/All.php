<?php

namespace Epayco\ApiOperations;

/**
 * Trait for listable resources. Adds a `all()` static method to the class.
 *
 * This trait should only be applied to classes that derive from EpaycoObject.
 */
trait All
{
    /**
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @throws \Epayco\Exception\ApiErrorException if the request fails
     *
     * @return \Epayco\Collection of ApiResources
     */
    public static function all($params = null, $opts = null)
    {
        self::_validateParams($params);
        $url = static::classUrl();

        list($response, $opts) = static::_staticRequest('get', $url, $params, $opts);
        $obj = \Epayco\Util\Util::convertToEpaycoObject($response->json, $opts);
        if (!($obj instanceof \Epayco\Collection)) {
            throw new \Epayco\Exception\UnexpectedValueException(
                'Expected type ' . \Epayco\Collection::class . ', got "' . \get_class($obj) . '" instead.'
            );
        }
        $obj->setLastResponse($response);
        $obj->setFilters($params);

        return $obj;
    }
}
