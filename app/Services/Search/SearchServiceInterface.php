<?php

namespace App\Services\Search;

interface SearchServiceInterface
{
    public const GLOBAL_SEARCH_ROUTE = 'search.global';
    public const INGREDIENTS_SEARCH_ROUTE = 'ingredients.search';

    public function globalSearch(string $keyword): array;
}
