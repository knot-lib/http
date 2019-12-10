<?php
namespace KnotLib\Http\Exception;

use Throwable;

use KnotLib\Exception\KnotPhpException;

class KnotHttpException extends KnotPhpException implements HttpExceptionInterface
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