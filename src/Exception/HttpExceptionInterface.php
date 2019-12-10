<?php
namespace KnotLib\Http\Exception;

use KnotLib\Exception\KnotPhpExceptionInterface;
use KnotLib\Exception\Runtime\RuntimeExceptionInterface;

interface HttpExceptionInterface extends KnotPhpExceptionInterface, RuntimeExceptionInterface
{
}