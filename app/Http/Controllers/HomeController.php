<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\BioContainer;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\Content;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function dashboard()
    {
        $bioItems = BioContainer::first();
        $bannerItems = Banner::orderBy('order', 'asc')->get();
        $contentItems = Content::with('category')->orderBy('order', 'asc')->get();
        $categories = Category::orderBy('order', 'asc')->get();
        $contactUs = ContactUs::orderBy('id', 'asc')->get();

        return Inertia::render('Dashboard', [
            'bioItems' => $bioItems,
            'bannerItems' => $bannerItems,
            'contentItems' => $contentItems,
            'categories' => $categories,
            'contactUs' => $contactUs,
        ]);
    }

    public function index()
    {
        $bioItems = BioContainer::first();
        $contentItems = Content::with('category')->orderBy('order', 'asc')->get();
        foreach ($contentItems as $item) {
            $item->created = $item->created_at->format('d F, Y');
        }
        $bannerItems = Banner::orderBy('order', 'asc')->get();

        return Inertia::render('Welcome', [
            'bioItems' => $bioItems,
            'contentItems' => $contentItems,
            'bannerItems' => $bannerItems,
        ]);
    }

    public function about()
    {
        $contentItems = Content::with('category')->orderBy('order', 'asc')->get();
        return Inertia::render('About', [
            'contentItems' => $contentItems,
        ]);
    }

    public function contact()
    {
        $contentItems = Content::with('category')->orderBy('order', 'asc')->get();
        return Inertia::render('Contact', [
            'contentItems' => $contentItems,
        ]);
    }
    public function categories()
    {
        $data = Category::paginate(10);

        return Inertia::render('Categories', ['categoryItems' => $data]);
    }
    public function slugByPage($slug)
    {
        $data = Content::where('slug', $slug)->firstOrFail();
        $data->get_in_touch = json_decode($data->get_in_touch, true);
        $data->boucher_files = json_decode($data->boucher_files, true);


        $bannerItems = Banner::orderBy('order', 'asc')->get();
        $contentItems = Content::with('category')->orderBy('order', 'asc')->get();

        if (!$data) {
            return abort(404);
        }

        return Inertia::render('Project', [
            'content' => $data,
            'bannerItems' => $bannerItems,
            'contentItems' => $contentItems,
        ]);
    }
}
