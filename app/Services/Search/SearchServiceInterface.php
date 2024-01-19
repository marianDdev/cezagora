<?php

namespace App\Services\Search;

interface SearchServiceInterface
{
    public function globalSearch(string $keyword): array;
}
