<?php

namespace Epayco\ApiOperations;

/**
 * Trait for creatable resources. Adds a `create()` static method to the class.
 *
 * This trait should only be applied to classes that derive from EpaycoObject.
 */
trait Create
{
    /**
     * @param null|array $params
     * @param null|array|string $options
     *
     * @throws \Epayco\Exception\ApiErrorException if the request fails
     *
     * @return static the created resource
     */
    public static function create($params = null, $options = null)
    {
        self::_validateParams($params);
        $url = static::classUrl();

        list($response, $opts) = static::_staticRequest('post', $url, $params, $options);
        $obj = \Epayco\Util\Util::convertToEpaycoObject($response->json, $opts);
        $obj->setLastResponse($response);

        return $obj;
    }
}
