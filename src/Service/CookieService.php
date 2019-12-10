<?php
declare(strict_types=1);

namespace KnotLib\Http\Service;

use KnotLib\Service\BaseService;

class CookieService extends BaseService
{
    /** @var array */
    private $default_options;

    /**
     * CookieService constructor.
     *
     * @param array $default_options
     */
    public function __construct(array $default_options = [])
    {
        $this->default_options = $default_options;
    }

    /**
     * Set cookie
     *
     * @param string $name
     * @param string $value
     * @param array $options
     *
     * @return bool
     *
     * @throws
     */
    public function setCookie(string $name, string $value, array $options = []) : bool
    {
        $options = array_merge($this->default_options, $options);

        return setcookie(
            $name,
            $value,
            $options['expire'] ?? 0,
            $options['path'] ?? '',
            $options['domain'] ?? '',
            $options['secure'] ?? false,
            $options['http_only'] ?? false
        );
    }

    /**
     * Remove cookie
     *
     * @param string $name
     *
     * @return bool
     *
     * @throws
     */
    public function removeCookie(string $name) : bool
    {
        $expire = time() - 3600;
        return setcookie($name, '', $expire);
    }

}