<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use App\Services\File\FileServiceInterface;
use Exception;
use Illuminate\Contracts\View\View;

class FileController extends Controller
{
    public function upload(UploadRequest $request, FileServiceInterface $fileService): View
    {
        $validated  = $request->validated();
        $entityName = $validated['entity'];

        switch ($entityName) {
            case 'ingredient':
                try {
                    $fileService->upload($validated['entity']);

                    return view('ingredients.check-upload-status');
                } catch (Exception $e) {
                    return view('ingredients.error', ['uploadError' => $e->getMessage()]);
                }
        }

        return view('dashboard');
    }
}
