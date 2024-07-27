<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageController extends Controller
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

    /// get Images By Category
    public function getImagesByCategory($category)
    {
        $categoryDirPath = public_path("/{$category}");
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

    /// view Theme
    public function viewTheme($category, $filename)
    {
        $file = public_path("{$category}/" . $filename);

        if (file_exists($file)) {
            return response()->file($file);
        } else {
            return response()->json(['error' => "Image not found"], 404);
        }
    }

    /// getThemeByCategoryInScreen
    public function getThemeByCategoryInScreen($category, $foldername)
    {
        $categoryDirPath = public_path("screens/{$category}/$foldername");

        if (File::exists($categoryDirPath) && File::isDirectory($categoryDirPath)) {
            $files = File::files($categoryDirPath);
            $fileImages = [];

            foreach ($files as $file) {
                if ($file->getExtension() == 'png' || $file->getExtension() == 'jpg') {
                    $fileName = $file->getBasename();
                    $this->formatJsonRes($fileImages, $fileName);
                }
            }
            return response()->json(["data" => $fileImages, "message" => "Success"], 200);
        } else {
            return response()->json(['error' => "Error reading avatars directory"], 404);
        }
    }


    public function formatJsonRes(&$fileImages, $fileName)
    {
        if (Str::startsWith($fileName, "ic_")) {
            $fileImages['icons'][] = $fileName;
        } else if (Str::startsWith($fileName, "widget_")) {
            $fileImages['widgets'][] = $fileName;
        } else if (Str::startsWith($fileName, "bg_")) {
            $fileImages['screens'][] = $fileName;
        } else {
            return [];
        }
    }

    /// get Detail Theme
    public function getDetailTheme($category1, $category2, $filename)
    {
        $file = public_path("screens/{$category1}/$category2/" . $filename);
        if (file_exists($file)) {
            return response()->file($file);
        } else {
            return response()->json(['error' => "Image not found"], 404);
        }
    }
}
