<?php

namespace Epayco\Radar;

/**
 * @internal
 * @covers \Epayco\Radar\EarlyFraudWarning
 */
final class EarlyFraudWarningTest extends \PHPUnit\Framework\TestCase
{
    use \Epayco\TestHelper;

    const TEST_RESOURCE_ID = 'issfr_123';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/v1/radar/early_fraud_warnings'
        );
        $resources = EarlyFraudWarning::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Epayco\Radar\EarlyFraudWarning::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/v1/radar/early_fraud_warnings/' . self::TEST_RESOURCE_ID
        );
        $resource = EarlyFraudWarning::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Epayco\Radar\EarlyFraudWarning::class, $resource);
    }
}
