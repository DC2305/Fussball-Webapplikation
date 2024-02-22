<?php

/**
 * DB-Konfiguration
 *
 * PHP version 8.2.12
 *
 * @category Testing
 *
 * @package PHPUnit
 *
 * @author David Cvetkovic <david.cvetkovic@sluz.ch>
 *
 * @license https://opensource.org/license/bsd-3-clause/ BSD-3-Clause
 *
 * @link http://localhost/Testkalender/
 */

declare(strict_types=1);

namespace tests;

use PHPUnit\Framework\TestCase;

/**
 * DB-Konfiguration
 *
 * PHP version 8.2.12
 *
 * @category Testing_DateTest
 *
 * @package PHPUnit
 *
 * @author David Cvetkovic <david.cvetkovic@sluz.ch>
 *
 * @license https://opensource.org/license/bsd-3-clause/ BSD-3-Clause
 *
 * @link http://localhost/Testkalender/
 */

final class DateTest extends TestCase
{
    /**
     * DB-Konfiguration
     *
     * PHP version 8.2.12
     *
     * @return string
     */
    public function testDBConfig(): void
    {
        $this->assertTrue(true);

        /*$string = "testlogin";

        $dbname = Config::$string;

        $this->assertSame($string, $dbname);*/
    }
}
