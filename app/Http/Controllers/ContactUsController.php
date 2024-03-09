<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['items'] = ContactUs::orderBy('id', 'asc')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Featch data successfully',
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['first_name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['email'] = $request->email;
        $data['is_reply'] = $request->is_reply;
        $data['phone_code'] = $request->phone_code;
        $data['message'] = $request->message;
        $data['message_reply'] = $request->message_reply;
        $data['status'] = $request->status; //'sent', 'draft', 'reply'

        $contact = ContactUs::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Contact us has been updated',
            'data' => $contact
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ContactUs $contactUs
     * @return \Illuminate\Http\Response
     */
    public function show(ContactUs $contactUs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\ContactUs $contactUs
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactUs $contactUs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ContactUs $contactUs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactUs $contactUs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ContactUs $contactUs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $banner = ContactUs::find($id);

            $banner->delete();

            return response()->json(['message' => 'Contact us deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete banner'], 500);
        }
    }
}
