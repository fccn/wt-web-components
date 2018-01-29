<?php

/*
* Sample middleware class to be used on tests
*/

namespace Fccn\Tests;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class MyMiddleware
{
    /*
    * Middleware constructor
    *
    */
    public function __construct()
    {
    }

    /**
     * Locale middleware invokable class
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $req, Response $resp, callable $next)
    {
        $response->getBody()->write('MY MIDDLEWARE INSERTION');
        return $next($req, $resp);
    }
}
