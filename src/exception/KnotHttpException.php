<?php
declare(strict_types=1);

namespace knotlib\http\exception;

use Throwable;

use knotlib\exception\KnotPhpException;

class KnotHttpException extends KnotPhpException implements HttpExceptionInterface
{
    /**
     * construct
     *
     * @param string $message
     * @param Throwable|null $prev
     */
    public function __construct(string $message, Throwable $prev = null){
        parent::__construct($message, 0, $prev);
    }
}