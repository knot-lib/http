<?php
declare(strict_types=1);

namespace KnotLib\Http\Test;

use KnotLib\Kernel\Session\SessionInterface;
use KnotLib\Kernel\Session\SessionBucketInterface;

final class TestSession implements SessionInterface
{
    private $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function clear()
    {
    }

    public function commit()
    {
    }

    public function destroy(): bool
    {
        return false;
    }

    public function getBucket(string $name): SessionBucketInterface
    {
        if (isset($this->data[$name])){
            return $this->data[$name];
        }
        $bucket = new TestSessionBucket();
        $this->data[$name] = $bucket;
        return $bucket;
    }

}