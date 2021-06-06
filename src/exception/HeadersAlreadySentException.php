<?php
declare(strict_types=1);

namespace knotlib\http\exception;

use Throwable;

class HeadersAlreadySentException extends KnotHttpException
{
    /**
     * construct
     *
     * @param string $message
     * @param Throwable|null $prev
     */
    public function __construct(string $message, Throwable $prev = null){
        parent::__construct($message, $prev);
    }
}