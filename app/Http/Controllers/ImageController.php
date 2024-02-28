<?php

namespace App\Http\Controllers;

use App\Models\ImageGallery;
use Inertia\Inertia;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Event $event)
    {
        $data['event'] = $event;
        $data['items'] = ImageGallery::all();

        return Inertia::render('ImageGallery/Index', $data);
    }

    public function get_gallery(Request $request)
    {
        $imageGalleries = ImageGallery::all();

        return response()->json(['status'=>'success','data'=>$imageGalleries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Event $event, Request $request)
    {
        $data = $request->all();
        $data['status'] = true;

//        $fileName = CtHelper::imgProcess($request, 'url', '','', 'bcknd/src/assets/img/url', 'store', ImageGallery::class);
//        $data['url'] = $fileName;
        $gallery = ImageGallery::create($data);

        return response()->json([
            'status' => 'success',
            'message' =>'Image Gallery has been created',
            'data' => $gallery
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
    public function update(Request $request, $id, $itemId)
    {
        // return $request->id;
        if ($request->status == 'active') {

            $image = ImageGallery::find($itemId);

            if ($image->status == 0) {

                ImageGallery::find($itemId)->update(['status' => 1]);
                $image = ImageGallery::find($itemId);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Image has been activated',
                    'data' => $image,
                ]);
            } else {

                ImageGallery::find($itemId)->update(['status' => 0]);
                $image = ImageGallery::find($itemId);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Image has been inactive',
                    'data' => $image,
                ]);
            }
        }else{
            $data =  $request->all();

            $gallery = ImageGallery::findOrFail($itemId)->update($data);
            $image = ImageGallery::find($itemId);
            return response()->json([
                'status' => 'success',
                'message' =>'Image has been updated',
                'data' => $image
            ]);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        // return $request->all();
        ImageGallery::where('id', $request->id)->delete();
        return response()->json([
            'status' => 'success',
            'message' =>'Image Gallery has been deleted'
        ]);


    }
}
