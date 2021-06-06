<?php
declare(strict_types=1);

namespace knotlib\http\exception;

use Throwable;

class JsonEncodingException extends KnotHttpException
{
    /** @var int */
    private $json_error;

    /**
     * construct
     *
     * @param int $code
     * @param Throwable|null $prev
     */
    public function __construct(int $code = 0, Throwable $prev = null){
        $message = "json_encode failed: " . json_last_error_msg();
        parent::__construct($message, $code, $prev);

        $this->json_error = json_last_error();
    }

    /**
     * @return int
     */
    public function getJsonError() : int
    {
        return $this->json_error;
    }
}