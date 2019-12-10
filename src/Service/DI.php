<?php
declare(strict_types=1);

namespace KnotLib\Http\Service;

use KnotLib\Service\DiKeysBase;

final class DI extends DiKeysBase
{
    //=====================================
    // Framework Component
    //=====================================

    /* Component Prefix */
    const COMPONENT                       = self::PREFIX_COMPONENTS;

    //=====================================
    // Service
    //=====================================

    /* Service Prefix */
    const SERVICE                         = self::PREFIX_SERVICES;

    /* Cookie Service */
    const SERVICE_COOKIE                  = self::PREFIX_SERVICES . 'cookie';

    /* Session Service */
    const SERVICE_SESSION                 = self::PREFIX_SERVICES . 'session';

}