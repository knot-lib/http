<?php
declare(strict_types=1);

namespace KnotLib\Http\Test;

use KnotLib\Kernel\Session\SessionBucketInterface;

final class TestSessionBucket implements SessionBucketInterface
{
    private $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function has(string $key): bool
    {
        return isset($this->data[$key]);
    }

    public function get(string $key, $default = null)
    {
        return $this->data[$key] ?? null;
    }

    public function set(string $key, $value)
    {
        $this->data[$key] = $value;
    }

    public function unset(string $key)
    {
        unset($this->data[$key]);
    }

    public function clear()
    {
        $this->data = [];
    }

    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->data[$offset] ?? null;
    }

    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }


}