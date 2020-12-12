<?php

namespace Epayco;

/**
 * @internal
 * @covers \Epayco\BaseEpaycoClient
 */
final class BaseEpaycoClientTest extends \PHPUnit\Framework\TestCase
{
    /** @var \ReflectionProperty */
    private $optsReflector;

    /** @before */
    protected function setUpOptsReflector()
    {
        $this->optsReflector = new \ReflectionProperty(\Epayco\EpaycoObject::class, '_opts');
        $this->optsReflector->setAccessible(true);
    }

    public function testCtorDoesNotThrowWhenNoParams()
    {
        $client = new BaseEpaycoClient();
        static::assertNotNull($client);
        static::assertNull($client->getApiKey());
    }

    public function testCtorThrowsIfConfigIsUnexpectedType()
    {
        $this->expectException(\Epayco\Exception\InvalidArgumentException::class);
        $this->expectExceptionMessage('$config must be a string or an array');

        $client = new BaseEpaycoClient(234);
    }

    public function testCtorThrowsIfApiKeyIsEmpty()
    {
        $this->expectException(\Epayco\Exception\InvalidArgumentException::class);
        $this->expectExceptionMessage('api_key cannot be the empty string');

        $client = new BaseEpaycoClient('');
    }

    public function testCtorThrowsIfApiKeyContainsWhitespace()
    {
        $this->expectException(\Epayco\Exception\InvalidArgumentException::class);
        $this->expectExceptionMessage('api_key cannot contain whitespace');

        $client = new BaseEpaycoClient("sk_test_123\n");
    }

    public function testCtorThrowsIfApiKeyIsUnexpectedType()
    {
        $this->expectException(\Epayco\Exception\InvalidArgumentException::class);
        $this->expectExceptionMessage('api_key must be null or a string');

        $client = new BaseEpaycoClient(['api_key' => 234]);
    }

    public function testCtorThrowsIfConfigArrayContainsUnexpectedKey()
    {
        $this->expectException(\Epayco\Exception\InvalidArgumentException::class);
        $this->expectExceptionMessage('Found unknown key(s) in configuration array: \'foo\', \'foo2\'');

        $client = new BaseEpaycoClient(['foo' => 'bar', 'foo2' => 'bar2']);
    }

    public function testRequestWithClientApiKey()
    {
        $client = new BaseEpaycoClient(['api_key' => 'sk_test_client', 'api_base' => MOCK_URL]);
        $charge = $client->request('get', '/v1/charges/ch_123', [], []);
        static::assertNotNull($charge);
        static::assertSame('sk_test_client', $this->optsReflector->getValue($charge)->apiKey);
    }

    public function testRequestWithOptsApiKey()
    {
        $client = new BaseEpaycoClient(['api_base' => MOCK_URL]);
        $charge = $client->request('get', '/v1/charges/ch_123', [], ['api_key' => 'sk_test_opts']);
        static::assertNotNull($charge);
        static::assertSame('sk_test_opts', $this->optsReflector->getValue($charge)->apiKey);
    }

    public function testRequestThrowsIfNoApiKeyInClientAndOpts()
    {
        $this->expectException(\Epayco\Exception\AuthenticationException::class);
        $this->expectExceptionMessage('No API key provided.');

        $client = new BaseEpaycoClient(['api_base' => MOCK_URL]);
        $charge = $client->request('get', '/v1/charges/ch_123', [], []);
        static::assertNotNull($charge);
        static::assertSame('ch_123', $charge->id);
    }

    public function testRequestThrowsIfOptsIsString()
    {
        $this->expectException(\Epayco\Exception\InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('#Do not pass a string for request options.#');

        $client = new BaseEpaycoClient(['api_base' => MOCK_URL]);
        $charge = $client->request('get', '/v1/charges/ch_123', [], 'foo');
        static::assertNotNull($charge);
        static::assertSame('ch_123', $charge->id);
    }

    public function testRequestThrowsIfOptsIsArrayWithUnexpectedKeys()
    {
        $this->expectException(\Epayco\Exception\InvalidArgumentException::class);
        $this->expectExceptionMessage('Got unexpected keys in options array: foo');

        $client = new BaseEpaycoClient(['api_base' => MOCK_URL]);
        $charge = $client->request('get', '/v1/charges/ch_123', [], ['foo' => 'bar']);
        static::assertNotNull($charge);
        static::assertSame('ch_123', $charge->id);
    }

    public function testRequestWithClientEpaycoVersion()
    {
        $client = new BaseEpaycoClient([
            'api_key' => 'sk_test_client',
            'epayco_version' => '2020-03-02',
            'api_base' => MOCK_URL,
        ]);
        $charge = $client->request('get', '/v1/charges/ch_123', [], []);
        static::assertNotNull($charge);
        static::assertSame('2020-03-02', $this->optsReflector->getValue($charge)->headers['Epayco-Version']);
    }

    public function testRequestWithOptsEpaycoVersion()
    {
        $client = new BaseEpaycoClient([
            'api_key' => 'sk_test_client',
            'epayco_version' => '2020-03-02',
            'api_base' => MOCK_URL,
        ]);
        $charge = $client->request('get', '/v1/charges/ch_123', [], ['epayco_version' => '2019-12-03']);
        static::assertNotNull($charge);
        static::assertSame('2019-12-03', $this->optsReflector->getValue($charge)->headers['Epayco-Version']);
    }

    public function testRequestWithClientEpaycoAccount()
    {
        $client = new BaseEpaycoClient([
            'api_key' => 'sk_test_client',
            'epayco_account' => 'acct_123',
            'api_base' => MOCK_URL,
        ]);
        $charge = $client->request('get', '/v1/charges/ch_123', [], []);
        static::assertNotNull($charge);
        static::assertSame('acct_123', $this->optsReflector->getValue($charge)->headers['Epayco-Account']);
    }

    public function testRequestWithOptsEpaycoAccount()
    {
        $client = new BaseEpaycoClient([
            'api_key' => 'sk_test_client',
            'epayco_account' => 'acct_123',
            'api_base' => MOCK_URL,
        ]);
        $charge = $client->request('get', '/v1/charges/ch_123', [], ['epayco_account' => 'acct_456']);
        static::assertNotNull($charge);
        static::assertSame('acct_456', $this->optsReflector->getValue($charge)->headers['Epayco-Account']);
    }

    public function testRequestCollectionWithClientApiKey()
    {
        $client = new BaseEpaycoClient(['api_key' => 'sk_test_client', 'api_base' => MOCK_URL]);
        $charges = $client->requestCollection('get', '/v1/charges', [], []);
        static::assertNotNull($charges);
        static::assertSame('sk_test_client', $this->optsReflector->getValue($charges)->apiKey);
    }

    public function testRequestCollectionThrowsForNonList()
    {
        $this->expectException(\Epayco\Exception\UnexpectedValueException::class);
        $this->expectExceptionMessage('Expected to receive `Epayco\Collection` object from Epayco API. Instead received `Epayco\Charge`.');

        $client = new BaseEpaycoClient(['api_key' => 'sk_test_client', 'api_base' => MOCK_URL]);
        $client->requestCollection('get', '/v1/charges/ch_123', [], []);
    }

    public function testRequestWithOptsInParamsWarns()
    {
        $this->expectException(\PHPUnit_Framework_Error_Warning::class);
        $this->expectExceptionMessage('Options found in $params: api_key, stripe_account, api_base. Options should be '
            . 'passed in their own array after $params. (HINT: pass an empty array to $params if you do not have any.)');
        $client = new BaseEpaycoClient([
            'api_key' => 'sk_test_client',
            'epayco_account' => 'acct_123',
            'api_base' => MOCK_URL,
        ]);
        $charge = $client->request(
            'get',
            '/v1/charges/ch_123',
            [
                'api_key' => 'sk_test_client',
                'epayco_account' => 'acct_123',
                'api_base' => MOCK_URL,
            ],
            ['epayco_account' => 'acct_456']
        );
        static::assertNotNull($charge);
        static::assertSame('acct_456', $this->optsReflector->getValue($charge)->headers['Epayco-Account']);
    }
}
