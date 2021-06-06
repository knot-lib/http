<?php
declare(strict_types=1);

namespace knotlib\http\middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

use knotlib\kernel\kernel\ApplicationInterface;
use knotlib\kernel\eventstream\Channels;
use knotlib\kernel\eventstream\Events;

class HttpRoutingMiddleware implements MiddlewareInterface
{
    /** @var ApplicationInterface */
    private $app;

    /**
     * WebRouterMiddleware constructor.
     *
     * @param ApplicationInterface $app
     */
    public function __construct(ApplicationInterface $app)
    {
        $this->app = $app;
    }

    /**
     * Process middleware
     *
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     *
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        $url    = $_SERVER['REQUEST_URI'] ?? '';
        $method = $_SERVER['REQUEST_METHOD'] ?? '';

        $this->app->response($handler->handle($request));

        $this->app->router()->route($url, $method, function(string $path, array $vars, string $route_name){

            // fire event
            $this->app->eventstream()->channel(Channels::SYSTEM)->push(Events::ROUTER_ROUTED, [
                'path' => $path,
                'vars' => $vars,
                'route_name' => $route_name,
            ]);

        });

        return $this->app->response();
    }
}