<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController
{
    public function index(Request $request): Response
    {
        return new Response(
            sprintf('This is HTML content requested via %s', $request->getMethod())
        );
    }
}