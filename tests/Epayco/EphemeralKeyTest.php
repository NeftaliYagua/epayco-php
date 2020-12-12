<?php

namespace Epayco;

/**
 * @internal
 * @covers \Epayco\EphemeralKey
 */
final class EphemeralKeyTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/v1/ephemeral_keys',
            null,
            ['Epayco-Version: 2017-05-25']
        );
        $resource = EphemeralKey::create([
            'customer' => 'cus_123',
        ], ['epayco_version' => '2017-05-25']);
        static::assertInstanceOf(\Epayco\EphemeralKey::class, $resource);
    }

    public function testIsNotCreatableWithoutAnExplicitApiVersion()
    {
        $this->expectException(\InvalidArgumentException::class);

        $resource = EphemeralKey::create([
            'customer' => 'cus_123',
        ]);
    }

    public function testIsDeletable()
    {
        $key = EphemeralKey::create([
            'customer' => 'cus_123',
        ], ['epayco_version' => '2017-05-25']);
        $this->expectsRequest(
            'delete',
            '/v1/ephemeral_keys/' . $key->id
        );
        $resource = $key->delete();
        static::assertInstanceOf(\Epayco\EphemeralKey::class, $resource);
    }
}
