<?php

// File generated from our OpenAPI spec

namespace Epayco;

/**
 * @property string $id Unique identifier for the object.
 * @property string $object String representing the object's type. Objects of the same type share the same value.
 * @property int $created Time at which the object was created. Measured in seconds since the Unix epoch.
 * @property int $expires Time at which the key will expire. Measured in seconds since the Unix epoch.
 * @property bool $livemode Has the value <code>true</code> if the object exists in live mode or the value <code>false</code> if the object exists in test mode.
 * @property string $secret The key's secret. You can use this value to make authorized requests to the Epayco API.
 * @property array $associated_objects
 */
class EphemeralKey extends ApiResource
{
    const OBJECT_NAME = 'ephemeral_key';

    use ApiOperations\Create {
        create as protected _create;
    }

    use ApiOperations\Delete;

    /**
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @throws \Epayco\Exception\InvalidArgumentException if epayco_version is missing
     * @throws \Epayco\Exception\ApiErrorException if the request fails
     *
     * @return \Epayco\EphemeralKey the created key
     */
    public static function create($params = null, $opts = null)
    {
        if (!$opts || !isset($opts['epayco_version'])) {
            throw new Exception\InvalidArgumentException('epayco_version must be specified to create an ephemeral key');
        }

        return self::_create($params, $opts);
    }
}
