<?php
declare(strict_types=1);

namespace KnotLib\Http\Service;

use Psr\Container\ContainerInterface as PsrContainerInterface;

trait HttpDiServiceTrait
{
    /**
     * Get cookie service defined in DI container
     *
     * @param PsrContainerInterface $container
     *
     * @return mixed
     */
    public function getCookieService(PsrContainerInterface $container)
    {
        return $container->get(DI::SERVICE_COOKIE);
    }

    /**
     * Get session service defined in DI container
     *
     * @param PsrContainerInterface $container
     *
     * @return mixed
     */
    public function getSessionService(PsrContainerInterface $container)
    {
        return $container->get(DI::SERVICE_SESSION);
    }
}