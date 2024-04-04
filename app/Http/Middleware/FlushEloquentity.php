<?php

namespace App\Http\Middleware;

use Closure;
use Eloquentity\Eloquentity;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

readonly class FlushEloquentity
{
    public function __construct(private Eloquentity $eloquentity)
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $this->eloquentity->flush();

        return $response;
    }
}
