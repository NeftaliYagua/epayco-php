<?php

namespace Epayco;

/**
 * @internal
 * @covers \Epayco\EpaycoClient
 */
final class EpaycoClientTest extends \PHPUnit\Framework\TestCase
{
    public function testExposesPropertiesForServices()
    {
        $client = new EpaycoClient('sk_test_123');
        static::assertInstanceOf(\Epayco\Service\CouponService::class, $client->coupons);
        static::assertInstanceOf(\Epayco\Service\Issuing\IssuingServiceFactory::class, $client->issuing);
        static::assertInstanceOf(\Epayco\Service\Issuing\CardService::class, $client->issuing->cards);
    }
}
