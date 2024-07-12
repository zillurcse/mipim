<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['items'] = Category::orderBy('order', 'asc')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Category has been updated',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
        ];

        // Validate the request
        $validatedData = $request->validate($rules);

        $data['name'] = $validatedData['name'];

//        $path = $request->file('file')->storePublicly('public/content');
//        $data['file'] = 'https://mipim-file.s3.amazonaws.com/' . $path;
        $category = Category::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Category has been updated',
            'data' => $category
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Find the record you want to update
        $category = Category::findOrFail($id);

        // Update the record with the new data
        $category->name = $request->name;


        // Check if a new file is provided
        if ($request->hasFile('file')) {
            // Delete the old file if it exists
            Storage::delete($category->file);

            // Store the new file
            $path = $request->file('file')->storePublicly('public/content');
            $category->file = 'https://mipim-file.s3.amazonaws.com/' . $path;
        }

        // Save the changes to the database
        $category->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Category has been updated',
            'data' => $category
        ]);
    }

    public function update_order(Request $request)
    {
        $contents = $request->get('categories');

        foreach ($contents as $index => $content) {
            $sp = Category::find($content['id']);
            $sp->order = $index;
            $sp->save();
        }

        return response()->json(['status' => 'success', 'message' => 'Category successfully ordered.']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    {
        try {
            $category = Category::find($id);

            $category->delete();

            return response()->json(['message' => 'Category deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete banner'], 500);
        }
    }
}
