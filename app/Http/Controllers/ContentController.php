<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['items'] = Content::with('category')->orderBy('order', 'asc')->get();

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
    public function upload_file(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->storePublicly('public/content');
            return 'https://mipim-file.s3.amazonaws.com/' . $path;
        } else {
            return 'none';
        }
    }
    public function delete_file(Request $request)
    {
        Storage::disk('s3')->delete($request->get('file'));

        return true;
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
            'category_id' => 'required',
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'details' => 'nullable|string',
            'position' => 'nullable|integer',
            'file' => 'nullable|file', // Ensure the file is actually a file
            'boucher_files' => 'nullable', // Ensure the file is actually a file
            'social_links' => 'required|json',
            'get_in_touch' => 'required|json',

        ];

        // Validate the request
        $validatedData = $request->validate($rules);


        $data = $validatedData;
        $data['category_id'] = $validatedData['category_id'];
        $data['title'] = $validatedData['title'];
        $data['social_links'] = $validatedData['social_links'];
        $data['get_in_touch'] = $validatedData['get_in_touch'];



        // Generate a unique slug
        $slug = Str::slug($data['title']);
        $originalSlug = $slug;
        $counter = 1;

        while (Content::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $data['slug'] = $slug;

        // Handle file upload if it exists
        if ($request->hasFile('file')) {
            $path = $request->file('file')->storePublicly('public/content');
            $data['file'] = 'https://mipim-file.s3.amazonaws.com/' . $path;
        }
        // Handle file upload if it exists
        if ($request->hasFile('boucher_files')) {
            $boucher_files_path = $request->file('boucher_files')->storePublicly('public/content');
            $full_path = 'https://mipim-file.s3.amazonaws.com/' . $boucher_files_path;
            $data['boucher_files'] = json_encode($full_path);
        }

        // Create the content
        $content = Content::create($data);

        //        if ($request->file('boucher_files') != null){
        //            $files = $request->file('boucher_files');
        //            foreach ($files as $file){
        //                $doc = new ExhibitorDocument();
        //                $doc->file = $file['file']->store('exhibitor-brochure-file-'.$event->id, config('infinity.file_system_driver'));
        ////                dd($doc->file);
        //                $doc->event()->associate($event);
        //                $doc->exhibitor()->associate($exhibitor);
        //                $doc->save();
        //                //array_push($docs, $doc);
        //            }
        //        }

        return response()->json([
            'status' => 'success',
            'message' => 'Content has been created',
            'data' => $content
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
