<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class IconController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['hihi' => 'haha']);
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

    /// GET ICON BY CATEGORY
    public function getIconsByCategory($category)
    {
        if (empty($category)) {
            return response()->json(['error' => 'Category parameter is required'], 400);
        }

        $jsons = public_path("icons/jsons/{$category}");

        if (File::exists($jsons)) {
            $jsonsData = file_get_contents($jsons);
            return response()->json(["data" => json_decode($jsonsData, true), "message" => "Get category!"], 200);
        } else {
            return response()->json(['error' => "Icons file for category {$category} not found"], 404);
        }
    }

    /// GET ALL ICON
    public function getAllIcon()
    {
        $categoryJsonDirPath = public_path("icons/jsons");
        if (File::exists($categoryJsonDirPath) && File::isDirectory($categoryJsonDirPath)) {
            $files = File::files($categoryJsonDirPath);
            $icons = [];

            foreach ($files as $file) {
                if ($file->getExtension() == 'json') {
                    $fileContent = File::get($file);
                    $fileData = json_decode($fileContent, true);
                    $icons[] = $fileData[0];
                }
            }
            return response()->json(["data" => $icons, "message" => "Get all categories!"], 200);
        } else {
            return response()->json(['error' => "Get all icons not found"], 404);
        }
    }

    /// GET ICON FILE 
    public function getIconFile($category1, $category2, $filename)
    {
        $file = public_path("icons/{$category1}/$category2/" . $filename);
        if (file_exists($file)) {
            return response()->file($file);
        } else {
            return response()->json(['error' => "Icons file for category {$category2} not found"], 404);
        }
    }
}
