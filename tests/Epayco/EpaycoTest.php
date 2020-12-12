<?php

namespace Epayco;

/**
 * @internal
 * @covers \Epayco\Epayco
 */
final class EpaycoTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    /** @var array */
    protected $orig;

    /**
     * @before
     */
    public function saveOriginalValues()
    {
        $this->orig = [
            'caBundlePath' => Epayco::$caBundlePath,
        ];
    }

    /**
     * @after
     */
    public function restoreOriginalValues()
    {
        Epayco::$caBundlePath = $this->orig['caBundlePath'];
    }

    public function testCABundlePathAccessors()
    {
        Epayco::setCABundlePath('path/to/ca/bundle');
        static::assertSame('path/to/ca/bundle', Epayco::getCABundlePath());
    }
}
