<?php
declare(strict_types=1);

namespace KnotLib\Http\Service;

use KnotLib\Service\BaseService;
use KnotLib\Kernel\Session\SessionInterface;
use Stk2k\Util\Util;

class SessionService extends BaseService
{
    const CRRF_TOKEN_LIST_KEY = 'csrf_token_list';

    /** @var SessionInterface */
    private $session;

    /**
     * SessionService constructor.
     *
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @return SessionInterface
     */
    protected function getSession() : SessionInterface
    {
        return $this->session;
    }

    /**
     * Generate new CSRF token
     *
     * @return string
     */
    public function generateCsrfToken() : string
    {
        $token = Util::hash();

        $bucket = $this->session->getBucket('csrf');

        $token_list = $bucket->get(self::CRRF_TOKEN_LIST_KEY);

        $token_list[] = $token;

        $bucket->set(self::CRRF_TOKEN_LIST_KEY, $token_list);

        return $token;
    }

    /**
     * Verify CSRF token
     *
     * @param string $token
     * @param bool $remove
     *
     * @return bool
     */
    public function verifyCsrfToken(string $token, bool $remove = true) : bool
    {
        $bucket = $this->session->getBucket('csrf');

        $token_list = $bucket->get(self::CRRF_TOKEN_LIST_KEY) ?? [];

        // search token in token list
        $found_key = array_search($token, $token_list);
        if ($found_key === false){
            return false;
        }
        if ($remove){
            unset($token_list[$found_key]);
            $bucket->set(self::CRRF_TOKEN_LIST_KEY, $token_list);
        }
        return true;
    }

    /**
     * Return session has flash
     *
     * @return bool
     */
    public function hasFlash() : bool
    {
        $bucket = $this->session->getBucket('flash');

        return $bucket->get('message') != null;
    }

    /**
     * Get session flash
     *
     * @param bool $clear
     *
     * @return string|null
     */
    public function getFlash(bool $clear = true)
    {
        $bucket = $this->session->getBucket('flash');

        $flash = $bucket->get('message', '');
        if ($clear){
            $this->clearFlash();
        }
        return $flash;
    }

    /**
     * Set session flash
     *
     * @param string $message
     */
    public function setFlash(string $message)
    {
        $bucket = $this->session->getBucket('flash');

        $bucket->set('message', $message);
    }

    /**
     * Clear session flash
     */
    public function clearFlash()
    {
        $bucket = $this->session->getBucket('flash');

        $bucket->unset('message');
    }

}