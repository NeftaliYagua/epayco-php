<?php

// File generated from our OpenAPI spec

namespace Epayco\Terminal;

/**
 * A Connection Token is used by the Epayco Terminal SDK to connect to a reader.
 *
 * Related guide: <a
 * href="https://epayco.com/docs/terminal/readers/fleet-management#create">Fleet
 * Management</a>.
 *
 * @property string $object String representing the object's type. Objects of the same type share the same value.
 * @property string $location The id of the location that this connection token is scoped to.
 * @property string $secret Your application should pass this token to the Epayco Terminal SDK.
 */
class ConnectionToken extends \Epayco\ApiResource
{
    const OBJECT_NAME = 'terminal.connection_token';

    use \Epayco\ApiOperations\Create;
}
