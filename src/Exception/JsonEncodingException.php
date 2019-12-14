<?php
declare(strict_types=1);

namespace KnotLib\Http\Exception;

use Throwable;

class JsonEncodingException extends KnotHttpException
{
    /** @var int */
    private $error_code;

    /**
     * construct
     *
     * @param int $code
     * @param Throwable|null $prev
     */
    public function __construct(int $code = 0, Throwable $prev = null){
        $message = "json_encode failed: " . json_last_error_msg();
        parent::__construct($message, $code, $prev);

        $this->error_code = json_last_error();
    }
}