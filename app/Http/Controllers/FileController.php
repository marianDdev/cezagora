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

        $routes = $this->getRoutes($entityName);

        try {
            $fileService->upload($validated['entity']);

            return view('files.check-upload-status', ['route' => $routes['index']]);
        } catch (Exception $e) {
            return view('files.error', ['uploadError' => $e->getMessage(), 'route' => $routes['create']]);
        }
    }

    private function getRoutes(string $entityName): array
    {
        $routes = [];
        switch ($entityName) {
            case FileServiceInterface::INGREDIENT:
                $routes['index']  = 'my-ingredients';
                $routes['create'] = 'ingredient.create';

                break;
            case FileServiceInterface::PACKAGING:
                $routes['index']  = 'my-packaging';
                $routes['create'] = 'packaging.create';

                break;
        }

        return $routes;
    }
}
