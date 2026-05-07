<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();

        return view('dashboard', compact('blogs'));
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        $imageName = null;

        if ($request->hasFile('image')) {

            $imageName = time().'.'.$request->image->extension();

            $request->image->move(public_path('uploads'), $imageName);
        }

        Blog::create([

            'title' => $request->title,

            'slug' => strtolower(str_replace(' ', '-', $request->title)),

            'category' => $request->category,

            'short_description' => $request->short_description,

            'content' => $request->content,

            'image' => $imageName,

            'publish_date' => $request->publish_date,
        ]);

        return redirect()->route('dashboard');
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->first();

        return view('blogs.show', compact('blog'));
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        return view('blogs.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $imageName = $blog->image;

        if ($request->hasFile('image')) {

            $imageName = time().'.'.$request->image->extension();

            $request->image->move(public_path('uploads'), $imageName);
        }

        $blog->update([

            'title' => $request->title,

            'slug' => strtolower(str_replace(' ', '-', $request->title)),

            'category' => $request->category,

            'short_description' => $request->short_description,

            'content' => $request->content,

            'image' => $imageName,

            'publish_date' => $request->publish_date,
        ]);

        return redirect()->route('dashboard');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        $blog->delete();

        return redirect()->route('dashboard');
    }

    public function filter(Request $request)
    {
        $category = $request->category;

        if ($category == 'All') {

            $blogs = Blog::latest()->get();

        } else {

            $blogs = Blog::where('category', $category)
                         ->latest()
                         ->get();
        }

        return view('blogs.filter', compact('blogs'));
    }
}