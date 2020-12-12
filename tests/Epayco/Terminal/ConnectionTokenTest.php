<?php

namespace Epayco\Terminal;

/**
 * @internal
 * @covers \Epayco\Terminal\ConnectionToken
 */
final class ConnectionTokenTest extends \PHPUnit\Framework\TestCase
{
    use \Epayco\TestHelper;

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/v1/terminal/connection_tokens'
        );
        $resource = ConnectionToken::create();
        static::assertInstanceOf(\Epayco\Terminal\ConnectionToken::class, $resource);
    }
}
