<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Models\ContactUs;
use App\Models\Content;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Illuminate\Support\Str;

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
    public function store(ContactUsRequest $request): JsonResponse
    {
        try {
            // Prepare the data for database insertion
            $data = $request->validated();

            // Create a new contact record
            $contact = ContactUs::create($data);

            // Return a JSON response
            return response()->json([
                'status' => 'success',
                'message' => 'Message has been sent successfully!',
                'data' => $contact
            ], 201);

        } catch (ModelNotFoundException $e) {
            // Handle the case where the model is not found
            return response()->json([
                'status' => 'error',
                'message' => 'Resource not found!',
            ], 404);
        } catch (Exception $e) {
            // Handle general exceptions
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage(),
            ], 500);
        }
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

    public function slugGenerate()
    {
        Content::cursor()->each(function ($content) {
            // Generate slug if not already set
            if (!$content->slug) {
                $content->slug = Str::slug($content->title, '-');
            }

            // Ensure slug is unique
            $originalSlug = $slug = Str::slug($content->slug);
            $counter = 1;

            while (Content::where('slug', $slug)->where('id', '!=', $content->id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            // Update the record with the unique slug
            $content->slug = $slug;
            $content->save();
        });

        return response()->json(['slug' => true]);
    }

}
