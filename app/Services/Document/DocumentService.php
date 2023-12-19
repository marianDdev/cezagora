<?php

namespace App\Services\Document;

use App\Models\Document;

class DocumentService implements DocumentServiceInterface
{
    public function create(array $validated, int $ingredientId): void
    {
        $documentsData = [];
        $documents     = $validated['documents'];
        foreach ($documents as $document) {
            $documentsData[] = [
                'ingredient_id' => $ingredientId,
                'name'          => $document,
            ];
        }

        Document::insert($documentsData);
    }

    public function createOther(array $validated, int $ingredientId): void
    {
        Document::create(['ingredient_id' => $ingredientId, 'name' => $validated['other_document']]);
    }
}
