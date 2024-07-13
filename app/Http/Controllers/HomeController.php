<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\BioContainer;
use App\Models\Content;
use Inertia\Inertia;

class HomeController extends Controller
{

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
        return Inertia::render('About');
    }

    public function contact()
    {
        return Inertia::render('Contact');
    }
    public function categorie()
    {
        return Inertia::render('Categorie-page');
    }
    public function slugByPage($slug)
    {
        $data = Content::where('slug', $slug)->firstOrFail();
        $bannerItems = Banner::orderBy('order', 'asc')->get();

        if (!$data){
            return abort(404);
        }

        return Inertia::render('Project', [
            'content' => $data,
            'bannerItems' => $bannerItems
        ]);
    }
}
