<?php
declare(strict_types=1);

namespace KnotLib\Http\Exception;

use Throwable;

class HeadersAlreadySentException extends KnotHttpException
{
    /**
     * construct
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $prev
     */
    public function __construct(string $message, int $code = 0, Throwable $prev = null){
        parent::__construct($message, $code, $prev);
    }
}