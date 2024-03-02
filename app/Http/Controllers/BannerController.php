<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $path = $request->file('file')->storePublicly('public/banner');
        $data['title'] = 'Banner';
        $data['banner_image'] = 'https://mipim-file.s3.amazonaws.com/' . $path;
        $banner = Banner::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Banner has been updated',
            'data' => $banner
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
