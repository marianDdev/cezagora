<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Services\Document\DocumentServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DocumentController extends Controller
{
    public function create(int $ingredientId): View
    {
        $documents = DocumentServiceInterface::ALL_DOCUMENTS;

        return view(
            'documents.create',
            [
                'ingredientId' => $ingredientId,
                'documents'    => $documents,
            ]
        );
    }

    public function store(StoreDocumentRequest $request, DocumentServiceInterface $documentService): RedirectResponse
    {
        $validated = $request->validated();
        $documentService->create($validated, $validated['ingredient_id']);
        if (isset($validated['other_document'])) {
            $documentService->createOther($validated, $validated['ingredient_id']);
        }

        return redirect()->route('ingredient.variant.create', ['ingredientId' => $validated['ingredient_id']]);
    }
}
