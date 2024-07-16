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

            $fileName = $request->file('file')->getClientOriginalName();
            $filePath = $request->file('file')->storePublicly('public/content');

            $data['file'] = 'https://mipim-file.s3.amazonaws.com/' . $filePath;
            $data['original_file_name'] = $fileName;
        }
        // Handle file upload if it exists
        if ($request->hasFile('boucher_files')) {
            $fileKeys = ['boucher_files', 'boucher_files1', 'boucher_files2', 'boucher_files3', 'boucher_files4'];
            $boucherFiles = [];

            foreach ($fileKeys as $key) {
                if ($request->hasFile($key)) {
                    $file = $request->file($key);
                    $fileName = $file->getClientOriginalName();
                    $boucherFilesPath = $file->storePublicly('public/content');
                    $fullPath = 'https://mipim-file.s3.amazonaws.com/' . $boucherFilesPath;
                    $boucherFiles[$fileName] = $fullPath;
                }
            }


            // Prepare the data for database insertion
            $data['boucher_files'] = json_encode($boucherFiles, true);
        }

        $data['order'] = Content::max('order') + 1;

        $content = Content::create($data);

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

        // Find the existing content
        $content = Content::findOrFail($id);

        // Update the data array
        $data = $validatedData;
        $data['category_id'] = $validatedData['category_id'];
        $data['title'] = $validatedData['title'];
        $data['social_links'] = $validatedData['social_links'];
        $data['get_in_touch'] = $validatedData['get_in_touch'];

        // Generate a unique slug if the title has changed
        if ($content->title !== $data['title']) {
            $slug = Str::slug($data['title']);
            $originalSlug = $slug;
            $counter = 1;

            while (Content::where('slug', $slug)->exists() && $slug !== $content->slug) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            $data['slug'] = $slug;
        }

        // Handle file upload if it exists
        if ($request->hasFile('file')) {
            $path = $request->file('file')->storePublicly('public/content');
            $data['file'] = 'https://mipim-file.s3.amazonaws.com/' . $path;
        }

        // Handle boucher_files upload if it exists
        $fileKeys = ['boucher_files', 'boucher_files1', 'boucher_files2', 'boucher_files3', 'boucher_files4'];
        $boucherFiles = [];

        foreach ($fileKeys as $key) {
            if ($request->hasFile($key)) {
                $boucherFilesPath = $request->file($key)->storePublicly('public/content');
                $fullPath = 'https://mipim-file.s3.amazonaws.com/' . $boucherFilesPath;
                $boucherFiles[] = $fullPath;
            }
        }

        if (!empty($boucherFiles)) {
            // Prepare the data for database insertion
            $data['boucher_files'] = json_encode($boucherFiles, true);
        }

        // Update the content in the database
        $content->update($data);

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
