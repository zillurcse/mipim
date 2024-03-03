<?php

namespace App\Http\Controllers;

use App\Models\BioContainer;
use Illuminate\Http\Request;

class BioContainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['items'] = BioContainer::first();

        return response()->json([
            'status' => 'success',
            'message' => 'Data fetch',
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
        //        $path = $request->file('file')->storePublicly('public/banner');
        $data['title'] = $request->title;
        $data['description'] = $request->description;
        //        $data['banner_image'] = 'https://mipim-file.s3.amazonaws.com/' . $path;
        $banner = BioContainer::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Data has been updated',
            'data' => $banner
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BioContainer  $bioContainer
     * @return \Illuminate\Http\Response
     */
    public function show(BioContainer $bioContainer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BioContainer  $bioContainer
     * @return \Illuminate\Http\Response
     */
    public function edit(BioContainer $bioContainer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BioContainer  $bioContainer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd($request);
        $bioContainer = BioContainer::find($id);
        $bioContainer = $bioContainer->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Data has been updated',
            'data' => BioContainer::find($id)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BioContainer  $bioContainer
     * @return \Illuminate\Http\Response
     */
    public function destroy(BioContainer $bioContainer)
    {
        //
    }
}
