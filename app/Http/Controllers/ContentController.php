<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

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
        $data['title'] = $request->title;
        $data['type'] = $request->type;
        $data['link'] = $request->link;
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
        //
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
