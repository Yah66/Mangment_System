<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    // public function __constructor()
    // {
    //     return $this->middleware('auth:api');
    // }
    public function index()
    {
        $posts = Post::all();
        return view('pages.posts.post', compact('posts'));
        // $Grades  = Grade::all();
        // return view('pages.grades.grade', ['Grades' => $Grades]);
    }

    public function store(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validated();
            // dd($validated['name_en']);
            // Handle the image upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('grades');
            }


            $grade = new Post();

            // Set the translatable name for 'en' and 'ar'
            $grade->setTranslation('name', 'en', $validated['name_en']);
            $grade->setTranslation('name', 'ar', $validated['name']);

            // Set other non-translatable attributes
            $grade->note = $validated['note'];
            $grade->image = $imagePath; // Assuming you have an 'image_path' column in your database table

            // Save the Grade instance
            $grade->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Grades.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
