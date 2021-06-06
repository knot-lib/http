<?php
declare(strict_types=1);

namespace knotlib\http\responder;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

use KnotLib\Kernel\Responder\ResponderInterface;
use KnotLib\Http\Exception\HeadersAlreadySentException;

class HttpResponder implements ResponderInterface
{
    /**
     * Process response
     *
     * @param ResponseInterface $response
     *
     * @throws HeadersAlreadySentException
     */
    public function respond(ResponseInterface $response)
    {
        if (headers_sent()) {
            throw new HeadersAlreadySentException('Headers were already sent');
        }

        /** @var PsrResponseInterface $r */
        $r = $response;

        $status = sprintf('HTTP/%s %s %s', $r->getProtocolVersion(), $r->getStatusCode(), $r->getReasonPhrase());
        header($status, TRUE);

        foreach ($r->getHeaders() as $name => $values) {
            $header = sprintf('%s: %s', $name, $r->getHeaderLine($name));
            header($header, FALSE);
        }

        echo $r->getBody();
    }
}