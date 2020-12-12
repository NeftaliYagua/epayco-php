<?php

namespace Epayco;

/**
 * @internal
 * @covers \Epayco\File
 */
final class FileTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'file_123';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/v1/files'
        );
        $resources = File::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Epayco\File::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/v1/files/' . self::TEST_RESOURCE_ID
        );
        $resource = File::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Epayco\File::class, $resource);
    }

    public function testDeserializesFromFile()
    {
        $obj = Util\Util::convertToEpaycoObject([
            'object' => 'file',
        ], null);
        static::assertInstanceOf(\Epayco\File::class, $obj);
    }

    public function testDeserializesFromFileUpload()
    {
        $obj = Util\Util::convertToEpaycoObject([
            'object' => 'file_upload',
        ], null);
        static::assertInstanceOf(\Epayco\File::class, $obj);
    }
}
