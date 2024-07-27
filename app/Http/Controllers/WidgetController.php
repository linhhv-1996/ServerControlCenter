<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class WidgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /// get files by category
    public function getFilesByCategory(string $category)
    {
        $categoryDirPath = public_path("widgets/{$category}");
        if (File::exists($categoryDirPath) && File::isDirectory($categoryDirPath)) {
            $files = File::files($categoryDirPath);
            $fileImages = [];

            foreach ($files as $file) {
                if ($file->getExtension() == 'png' || $file->getExtension() == 'jpg') {
                    $fileName = $file->getBasename();
                    $fileImages[] = $fileName;
                }
            }
            return response()->json(["data" => $fileImages, "message" => "Success"], 200);
        } else {
            return response()->json(['error' => "Get files by category not found"], 404);
        }
    }

    /// get json files 
    public function getJsonFiles(string $filename)
    {
        $categoryJsonDirPath = public_path("widgets/jsons");
        if (File::exists($categoryJsonDirPath) && File::isDirectory($categoryJsonDirPath)) {
            $files = File::files($categoryJsonDirPath);
            $fileData = [];

            foreach ($files as $file) {
                if ($file->getExtension() == 'json' && $file->getBasename() == $filename) {
                    $fileContent = File::get($file);
                    $fileData = json_decode($fileContent, true);
                }
            }
            return response()->json($fileData, 200);
        } else {
            return response()->json(['error' => "Get all icons not found"], 404);
        }
    }

    /// get image files 
    public function getImageFiles(string $category, string $filename)
    {
        $categoryDirPath = public_path("widgets/{$category}");
        if (File::exists($categoryDirPath) && File::isDirectory($categoryDirPath)) {
            $files = File::files($categoryDirPath);
            $fileData = [];

            foreach ($files as $file) {
                if (($file->getExtension() == 'png' || $file->getExtension() == 'jpg') && $file->getBasename() == $filename) {
                    return response()->file($file);
                }
            }
        } else {
            return response()->json(['error' => "Get all icons not found"], 404);
        }

    }
}
