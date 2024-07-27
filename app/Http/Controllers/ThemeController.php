<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ThemeController extends Controller
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

    /// get all theme
    public function getAllTheme()
    {
        $categoryJsonDirPath = public_path("themes/");
        if (File::exists($categoryJsonDirPath) && File::isDirectory($categoryJsonDirPath)) {
            $files = File::files($categoryJsonDirPath);
            $icons = [];

            foreach ($files as $file) {
                if ($file->getExtension() == 'json') {
                    $fileContent = File::get($file);
                    $fileData = json_decode($fileContent, true);

                    $length = count($fileData);
                    for ($i = 0; $i < $length; $i++) {
                        $icons[] = $fileData[$i];
                    }
                }
            }
            return response()->json(["data" => $icons, "message" => "Get all categories!"], 200);
        } else {
            return response()->json(['error' => "Get all themes not found"], 404);
        }
    }

    /// get themes by category
    public function getThemesByCategory(string $category)
    {
        $file = public_path("themes/${category}.json");

        if (file_exists($file)) {
            $fileContent = File::get($file);
            $fileData = json_decode($fileContent, true);
            return response()->json(["data" => $fileData, "message" => "Get category!"], 200);
        } else {
            return response()->json(['error' => "theme file for category {$category} not found"], 404);
        }
    }
}
