<?php
declare(strict_types=1);

namespace knotlib\http\exception;

use knotlib\exception\KnotPhpExceptionInterface;
use knotlib\exception\runtime\RuntimeExceptionInterface;

interface HttpExceptionInterface extends KnotPhpExceptionInterface, RuntimeExceptionInterface
{
}