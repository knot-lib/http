<?php
use PHPUnit\Framework\TestCase;

use KnotLib\Http\Test\TestSession;
use KnotLib\Http\Service\SessionService;

class SessionServiceTest extends TestCase
{
    public function testGenerateCsrfToken()
    {
        $session = new TestSession();
        $svc = new SessionService($session);

        $token = $svc->generateCsrfToken();

        $csrf = $session->getBucket('csrf');
        $list = $csrf->get(SessionService::CRRF_TOKEN_LIST_KEY);

        $this->assertNotNull($list);
        $this->assertInternalType('array', $list);
        $this->assertContains($token, $list);
    }

    public function testVerifyCsrfToken()
    {
        $session = new TestSession();
        $svc = new SessionService($session);

        $token = $svc->generateCsrfToken();

        $csrf = $session->getBucket('csrf');

        $result = $svc->verifyCsrfToken($token, false);

        $this->assertTrue($result);
        $this->assertContains($token, $csrf->get(SessionService::CRRF_TOKEN_LIST_KEY));

        $result = $svc->verifyCsrfToken($token, true);

        $this->assertTrue($result);
        $this->assertNotContains($token, $csrf->get(SessionService::CRRF_TOKEN_LIST_KEY));

        $result = $svc->verifyCsrfToken($token, true);

        $this->assertFalse($result);
        $this->assertNotContains($token, $csrf->get(SessionService::CRRF_TOKEN_LIST_KEY));
    }

    public function testHasFlash()
    {
        $session = new TestSession();
        $svc = new SessionService($session);

        $flash = $session->getBucket('flash');

        $this->assertFalse($svc->hasFlash());
        $this->assertEmpty($flash->get('message'));

        $svc->setFlash('foo');

        $this->assertTrue($svc->hasFlash());
        $this->assertNotEmpty($flash->get('message'));
    }

    public function testGetFlash()
    {
        $session = new TestSession();
        $svc = new SessionService($session);

        $this->assertNull($svc->getFlash(false));
        $this->assertEquals(null, $session->getBucket('flash')->get('message'));

        $svc->setFlash('foo');

        $this->assertEquals('foo', $svc->getFlash(false));
        $this->assertEquals('foo', $session->getBucket('flash')->get('message'));
        $this->assertEquals('foo', $svc->getFlash(true));
        $this->assertEquals(null, $svc->getFlash(false));
        $this->assertEquals(null, $session->getBucket('flash')->get('message'));
    }

    public function testSetFlash()
    {
        $session = new TestSession();
        $svc = new SessionService($session);

        $this->assertNull($svc->getFlash());

        $svc->setFlash('foo');

        $this->assertEquals('foo', $svc->getFlash(false));
        $this->assertEquals('foo', $session->getBucket('flash')->get('message'));

        $svc->setFlash('bar');

        $this->assertEquals('bar', $svc->getFlash(false));
        $this->assertEquals('bar', $session->getBucket('flash')->get('message'));
    }

    public function testClearFlash()
    {
        $session = new TestSession();
        $svc = new SessionService($session);

        $this->assertNull($svc->getFlash());

        $svc->setFlash('foo');

        $this->assertEquals('foo', $svc->getFlash(false));
        $this->assertEquals('foo', $session->getBucket('flash')->get('message'));

        $svc->clearFlash();

        $this->assertEquals(null, $svc->getFlash(false));
        $this->assertEquals(null, $session->getBucket('flash')->get('message'));
    }

}