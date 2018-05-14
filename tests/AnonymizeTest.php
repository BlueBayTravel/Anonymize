<?php

namespace BlueBayTravel\Tests\Anonymize;

use BlueBayTravel\Anonymize\Anonymize;
use PHPUnit\Framework\TestCase;

/**
 * This is the anonymize test class.
 * 
 * @author James Brooks <james@bluebaytravel.co.uk>
 */
class AnonymizeTest extends TestCase
{
    protected $anonymize;

    public function setUp()
    {
        $this->anonymize = new Anonymize();
    }

    /**
     * @dataProvider providesDefaultIPCases
     */
    public function testAnonymize($input, $output) : void
    {
        $this->assertSame($output, $this->anonymize->run($input));
    }

    public function providesDefaultIPCases()
    {
        return [
            // IPv4
            ['127.0.0.1', '127.0.0.0'],
            ['192.168.10.10', '192.168.10.0'],
            ['8.8.8.8', '8.8.8.0'],
            // IPv6
            ['::1', '::'],
            ['::127.0.0.1', '::'],
            ['2a03:2880:2110:df07:face:b00c::1', '2a03:2880:2110:df07::'],
        ];
    }

    /**
     * @dataProvider providesCustomIPCases
     */
    public function testAnonymizeCustom($input, $output) : void
    {
        $this->assertSame($output, $this->anonymize->run($input, '255.255.0.0'));
    }

    public function providesCustomIPCases()
    {
        return [
            // IPv4
            ['192.168.10.10', '192.168.0.0'],
        ];
    }
}
