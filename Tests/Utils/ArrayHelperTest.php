<?php

namespace FP\ElasticApmBundle\Tests\Utils;

use FP\ElasticApmBundle\Utils\ArrayHelper;
use PHPUnit\Framework\TestCase;

class ArrayHelperTest extends TestCase
{
    public function testReplaceKey()
    {
        $array = ['foo' => 'bar', 'baz' => 'buzz'];
        $expected = ['fooo' => 'bar', 'baz' => 'buzz'];

        ArrayHelper::replaceKey($array, 'foo', 'fooo');

        $this->assertSame($expected, $array);
    }
}
