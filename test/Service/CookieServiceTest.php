<?php
use PHPUnit\Framework\TestCase;

use KnotLib\Http\Service\CookieService;

class CookieServiceTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testSetCookie()
    {
        $svc = new CookieService();

        $res = $svc->setCookie('foo', 'bar');

        $this->assertTrue($res);
    }

}