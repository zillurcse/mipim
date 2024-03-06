<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['items'] = Banner::orderBy('order', 'asc')->get();

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
        $image = $request->file;

// Extract file extension using pathinfo
        $extension = pathinfo($image, PATHINFO_EXTENSION);
        $imageData = substr($image, strpos($image, ',') + 1);
        $imageData = str_replace(' ', '+', $imageData);
// Generate a unique image name
        $imageName = Str::random(40) . '.' . $extension;

// Store the image in the S3 bucket with public visibility
        $res = Storage::disk('s3')->put('public/banner/' . $imageName, base64_decode($imageData), 'public');

        if ($res) {
            // Image successfully uploaded
            $data['title'] = 'Banner';
            $data['banner_image'] = 'https://mipim-file.s3.amazonaws.com/public/banner/' . $imageName;
            $banner = Banner::create($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Banner has been updated',
                'data' => $banner
            ]);
        } else {
            // Error during image upload
            return response()->json([
                'status' => 'error',
                'message' => 'Error storing the banner image'
            ]);
        }

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
        //
    }
    public function update_order(Request $request)
    {
        $banners = $request->get('banners');
        foreach ($banners as $index => $banner) {
            $sp = Banner::find($banner['id']);
            $sp->order = $index;
            $sp->save();
        }

        return response()->json(['status' => 'success', 'message' => 'Banner successfully ordered.']);
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
            $banner = Banner::find($id);

            $banner->delete();

            return response()->json(['message' => 'Banner deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete banner'], 500);
        }
    }

    public function token(Request $request)
    {
        $token = auth()->user();

        return $token;
    }
}
