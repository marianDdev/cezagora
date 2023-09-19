<?php

namespace App\Services;

interface SearchServiceInterface
{
    public function globalSearch(string $keyword): array;
}
