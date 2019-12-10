<?php
namespace KnotLib\Http\Middleware;

use KnotLib\Kernel\Kernel\ApplicationInterface;
use KnotLib\Kernel\EventStream\Channels;
use KnotLib\Kernel\EventStream\Events;
use KnotLib\Kernel\Pipeline\MiddlewareInterface;
use KnotLib\Kernel\Request\RequestInterface;
use KnotLib\Kernel\Request\RequestHandlerInterface;
use KnotLib\Kernel\Response\ResponseInterface;

class WebServerRoutingMiddleware implements MiddlewareInterface
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
     * @param RequestInterface $request
     * @param RequestHandlerInterface $handler
     *
     * @return ResponseInterface
     */
    public function process(RequestInterface $request, RequestHandlerInterface $handler)
    {
        $url    = $_SERVER['REQUEST_URI'] ?? '';
        $method = $_SERVER['REQUEST_METHOD'] ?? '';

        $this->app->router()->route($url, $method, function(string $path, array $vars, string $route_name){

            // fire event
            $this->app->eventstream()->channel(Channels::SYSTEM)->push(Events::ROUTER_ROUTED, [
                'path' => $path,
                'vars' => $vars,
                'route_name' => $route_name,
            ]);

        });

        return $handler->handle($request);
    }
}