<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class RobotsController extends Controller
{
    public function index(): Response
    {
        $content = 'User-agent: *' . PHP_EOL;
        if (env('APP_ENV') === 'production') {
            $content .= 'Disallow: ';
        } else {
            $content .= 'Disallow: /';
        }

        return response($content)->header('Content-Type', 'text/plain');
    }
}

