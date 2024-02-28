<?php

declare(strict_types=1);

namespace App\ExternalApi\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    public function index(Request $request): Response
    {
        return new Response(
            sprintf('This is HTML content requested via %s', $request->getMethod())
        );
    }
}