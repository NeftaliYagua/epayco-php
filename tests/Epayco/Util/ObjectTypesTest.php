<?php

namespace Epayco\Util;

/**
 * @internal
 * @covers \Epayco\Util\ObjectTypes
 */
final class ObjectTypesTest extends \PHPUnit\Framework\TestCase
{
    use \Epayco\TestHelper;

    public function testMapping()
    {
        static::assertSame(\Epayco\Util\ObjectTypes::mapping['charge'], \Epayco\Charge::class);
        static::assertSame(\Epayco\Util\ObjectTypes::mapping['checkout.session'], \Epayco\Checkout\Session::class);
    }
}
