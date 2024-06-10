<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['items'] = Content::orderBy('order', 'asc')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Banner has been updated',
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
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'details' => 'nullable|string',
            'position' => 'nullable|integer',
        ];

        // Validate the request
        $validatedData = $request->validate($rules);

        $data['title'] = $validatedData['title'];
        $data['details'] = $validatedData['details'];
//        $data['date'] = $validatedData->date;
        $data['type'] = $validatedData['type'];
        $data['position'] = $validatedData['position'];
        $path = $request->file('file')->storePublicly('public/content');
        $data['file'] = 'https://mipim-file.s3.amazonaws.com/' . $path;
        $Content = Content::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Content has been updated',
            'data' => $Content
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
        $content = Content::findOrFail($id);

        // Update the record with the new data
        $content->title = $request->title;
        $content->details = $request->details;
        $content->date = $request->date;
        $content->type = $request->type;
        $content->position = $request->position;

        // Check if a new file is provided
        if ($request->hasFile('file')) {
            // Delete the old file if it exists
            Storage::delete($content->file);

            // Store the new file
            $path = $request->file('file')->storePublicly('public/content');
            $content->file = 'https://mipim-file.s3.amazonaws.com/' . $path;
        }

        // Save the changes to the database
        $content->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Content has been updated',
            'data' => $content
        ]);
    }

    public function update_order(Request $request)
    {
        $contents = $request->get('contents');

        foreach ($contents as $index => $content) {
            $sp = Content::find($content['id']);
            $sp->order = $index;
            $sp->save();
        }

        return response()->json(['status' => 'success', 'message' => 'Content successfully ordered.']);
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
            $content = Content::find($id);

            $content->delete();

            return response()->json(['message' => 'Content deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete banner'], 500);
        }
    }
}
