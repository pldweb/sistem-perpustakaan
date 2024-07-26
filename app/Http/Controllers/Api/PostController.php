<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return response()->customJson('success', 'Post retrivied successfully', $posts);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'required',
            'content' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        $post = Post::create([
            'image' => $image->hashName(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->customJson('success', 'Post created successfully', $post, 201);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        if (!$post) {
            return response()->json(['success' => false, 'message' => 'Data Post Tidak Ditemukan'], 404);
        }

        return response()->customJson('success', 'Post retrieved successfully', $post);
    }


    public function update(Request $request, $id)
    {
         // Validasi data request
         $validate = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'required',
            'content' => 'required',
        ]);

        // check if validation fails
        if($validate->fails()){
            return response()->json($validate->errors(), 422);
        }

        $post = Post::find($id);

        if($request->hasFile('image')) {
            
            // Upload image
            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());

            // delete old image
            Storage::delete(['public/posts' . basename($post->image)]);

            // Update post with new Image
            $post->update([
                'image' => $image->hashName(),
                'title' => $request->title,
                'content' => $request->content,
            ]);
            
        }  else {

            // Update post without image
            $post->update([
                'title' => $request->title,
                'content' => $request->content,
            ]);

        }

        return response()->customJson('success', 'Post updated successfully', $post);

    }

    public function destroy($post)
    {
         //find post by ID
         $post = Post::findOrFail($post);

         //delete image
         Storage::delete('public/posts/'.basename($post->image));
 
         //delete post
         $post->delete();
 
         //return response
        return response()->customJson('success', 'Post deleted successfully', null, 204);
    }

}

