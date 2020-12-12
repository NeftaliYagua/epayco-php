<?php

namespace Epayco;

/**
 * @internal
 * @covers \Epayco\File
 */
final class FileCreationTest extends \PHPUnit\Framework\TestCase
{
    // These tests should really be part of `FileTest`, but because the file creation requests use a
    // different host, the tests for these methods need their own setup and teardown methods.

    use TestHelper;

    /** @var null|string */
    private $origApiUploadBase;

    /** @before */
    public function setUpUploadBase()
    {
        $this->origApiBase = Epayco::$apiBase;
        $this->origApiUploadBase = Epayco::$apiUploadBase;

        Epayco::$apiUploadBase = \defined('MOCK_URL') ? MOCK_URL : 'http://localhost:12111';
        Epayco::$apiBase = null;
    }

    /** @after */
    public function tearDownUploadBase()
    {
        Epayco::$apiBase = $this->origApiBase;
        Epayco::$apiUploadBase = $this->origApiUploadBase;
    }

    public function testIsCreatableWithFileHandle()
    {
        $this->expectsRequest(
            'post',
            '/v1/files',
            null,
            ['Content-Type: multipart/form-data'],
            true,
            Epayco::$apiUploadBase
        );
        $fp = \fopen(__DIR__ . '/../data/test.png', 'rb');
        $resource = File::create([
            'purpose' => 'dispute_evidence',
            'file' => $fp,
            'file_link_data' => ['create' => true],
        ]);
        static::assertInstanceOf(\Epayco\File::class, $resource);
    }

    public function testIsCreatableWithCURLFile()
    {
        $this->expectsRequest(
            'post',
            '/v1/files',
            null,
            ['Content-Type: multipart/form-data'],
            true,
            Epayco::$apiUploadBase
        );
        $curlFile = new \CURLFile(__DIR__ . '/../data/test.png');
        $resource = File::create([
            'purpose' => 'dispute_evidence',
            'file' => $curlFile,
            'file_link_data' => ['create' => true],
        ]);
        static::assertInstanceOf(\Epayco\File::class, $resource);
    }
}
