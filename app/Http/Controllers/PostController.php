<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Post\EditPostRequest;
use App\Http\Requests\Post\CreatePostRequest;

class PostController extends Controller
{
    public function __construct()
    {
        return $this->middleware('verifyCategoryCount')->only(['create', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $image = $request->image->move('uploads/posts', 'public');

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'published_at' => $request->published_at,
            'category_id' => $request->category_id
        ]);

        session()->flash('success', $request->title . ' post added successfully!' );

        return redirect(route('post.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        
        return view('admin.posts.create', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditPostRequest $request, Post $post)
    {
        $data = $request->all();

        // Check if new image
        if($request->hasFile('image')) {
            //upload it
            $image = $request->image->move('uploads/posts', 'public');

            //delete old image
            Storage::delete($post->image);

            $data['image'] = $image;
        }

        //update post atrributes
        $post->update($data);

        session()->flash('success', $post->title . ' post updated successfully!' );

        return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        if($post->trashed()) {
            Storage::delete($post->image);

            $post->forceDelete();

            session()->flash('success', $post->title . ' post deleted successfully!' );

            return redirect(route('trashed-post'));
        }else{
            $post->delete();
        }

        session()->flash('success', $post->title . ' post deleted successfully!' );

        return redirect(route('post.index'));
    }

    /**
     * View trashed resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trashedPost()
    {
        $trashed = Post::onlyTrashed()->get();

        return view('admin.posts.trashed', compact('trashed'));
    }

    /**
     * View trashed resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restorePost($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        $post->restore();

        session()->flash('success', $post->title . ' post restored successfully!' );

        return redirect(route('post.index'));
    }
}
