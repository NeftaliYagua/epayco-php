<?php

namespace Epayco\Service;

/**
 * @internal
 * @covers \Epayco\Service\FileService
 */
final class FileServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Epayco\TestHelper;

    const TEST_RESOURCE_ID = 'file_123';

    /** @var \Epayco\EpaycoClient */
    private $client;

    /** @var FileService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Epayco\EpaycoClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new FileService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/v1/files'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Epayco\File::class, $resources->data[0]);
    }

    public function testCreateWithCURLFile()
    {
        $client = new \Epayco\EpaycoClient(['api_key' => 'sk_test_123', 'files_base' => MOCK_URL]);
        $service = new FileService($client);

        $this->expectsRequest(
            'post',
            '/v1/files',
            null,
            ['Content-Type: multipart/form-data'],
            true,
            MOCK_URL
        );
        $curlFile = new \CURLFile(__DIR__ . '/../../data/test.png');
        $resource = $service->create([
            'purpose' => 'dispute_evidence',
            'file' => $curlFile,
            'file_link_data' => ['create' => true],
        ]);
        static::assertInstanceOf(\Epayco\File::class, $resource);
    }

    public function testCreateWithFileHandle()
    {
        $client = new \Epayco\EpaycoClient(['api_key' => 'sk_test_123', 'files_base' => MOCK_URL]);
        $service = new FileService($client);

        $this->expectsRequest(
            'post',
            '/v1/files',
            null,
            ['Content-Type: multipart/form-data'],
            true,
            MOCK_URL
        );
        $fp = \fopen(__DIR__ . '/../../data/test.png', 'rb');
        $resource = $service->create([
            'purpose' => 'dispute_evidence',
            'file' => $fp,
            'file_link_data' => ['create' => true],
        ]);
        static::assertInstanceOf(\Epayco\File::class, $resource);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/v1/files/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Epayco\File::class, $resource);
    }
}
