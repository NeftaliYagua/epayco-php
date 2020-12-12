<?php

namespace Epayco;

/**
 * @internal
 * @covers \Epayco\SetupAttempt
 */
final class SetupAttemptTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/v1/setup_attempts'
        );
        $resources = SetupAttempt::all([
            'setup_intent' => 'si_123',
        ]);
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Epayco\SetupAttempt::class, $resources->data[0]);
    }
}
