<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
     * Store a newly created post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        try{
            $data['user'] = Auth::user();

            $data['page_url'] = 'posts';
            $posts = Post::all();

            // Calculate the time difference for each post
            foreach ($posts as $post) {
                $post->created_ago = $post->created_at->diffForHumans(); // Calculates the time difference in human-readable format
            }
    
            $data['posts'] = $posts;
        return view('posts.index', $data);
        }
        catch(\Exception $e){
            Session::flash('server_error', ('Technical error has occured'));
            return back();
        }
        
    }

    public function create(){
        try{
            return view('posts.add');
        }catch(\Exception $e){
            Session::flash('server_error', ('Technical error has occured'));
            return back();
        }
    }
    public function store(Request $request)
    {
        // Validate the request data including the image
        $request->validate([
            'content' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules for the image
        ]);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            // Store the image file in the storage directory
            $imagePath = $request->file('image')->store('post_images', 'public');

            // Save the image path to the database along with other post data
            $post = new Post();
            $post->user_id = auth()->user()->id;
            $post->title = $request->title;
            $post->content = $request->content;
            $post->image = $imagePath;
            $post->save();
        } else {
            // Create a new post instance without an image
            $post = new Post();
            $post->user_id = auth()->user()->id;
            $post->title = $request->title;
            $post->content = $request->content;
            $post->save();
        }

        // Optionally, you can flash a success message to the session
        // session()->flash('success', 'Post created successfully.');

        // Redirect back to the post listing page
        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
        try {
            // Retrieve the post data from the database
            $post = Post::findOrFail($post->id);

            // Calculate the time difference between post creation time and current time
            if ($post instanceof Post) {
                $post->created_ago = $post->created_at->diffForHumans();
            }

            // Pass the post data to the view
            return view('posts.show', compact('post'));
        } catch (\Exception $e) {
            Session::flash('server_error', 'Technical error has occurred');
            return back();
        }
    }


}
