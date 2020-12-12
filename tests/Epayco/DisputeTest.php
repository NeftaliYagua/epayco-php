<?php

namespace Epayco;

/**
 * @internal
 * @covers \Epayco\Dispute
 */
final class DisputeTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'dp_123';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/v1/disputes'
        );
        $resources = Dispute::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Epayco\Dispute::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/v1/disputes/' . self::TEST_RESOURCE_ID
        );
        $resource = Dispute::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Epayco\Dispute::class, $resource);
    }

    public function testIsSaveable()
    {
        $resource = Dispute::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/v1/disputes/' . $resource->id
        );
        $resource->save();
        static::assertInstanceOf(\Epayco\Dispute::class, $resource);
    }

    public function testIsUpdatable()
    {
        $this->expectsRequest(
            'post',
            '/v1/disputes/' . self::TEST_RESOURCE_ID
        );
        $resource = Dispute::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Epayco\Dispute::class, $resource);
    }

    public function testIsClosable()
    {
        $dispute = Dispute::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/v1/disputes/' . $dispute->id . '/close'
        );
        $resource = $dispute->close();
        static::assertInstanceOf(\Epayco\Dispute::class, $resource);
        static::assertSame($resource, $dispute);
    }
}
