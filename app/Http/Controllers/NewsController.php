<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{
    /**
     * Display a listing of the news.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data['user'] = Auth::user();
            $data['page_url'] = 'news';
            $news = News::all();

            // Calculate the time difference for each news item
            foreach ($news as $item) {
                $item->created_ago = $item->created_at->diffForHumans();
            }

            $data['news'] = $news;
            
            return view('news.index', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', 'Technical error has occurred');
            return back();
        }
    }

    /**
     * Show the form for creating a new news item.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('news.add');
        } catch (\Exception $e) {
            Session::flash('server_error', 'Technical error has occurred');
            return back();
        }
    }

    /**
     * Store a newly created news item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'headline' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news_images', 'public');

            $news = new News();
            $news->user_id = auth()->user()->id;
            $news->headline = $request->headline;
            $news->content = $request->content;
            $news->image = $imagePath;
            $news->save();
        } else {
            $news = new News();
            $news->user_id = auth()->user()->id;
            $news->headline = $request->headline;
            $news->content = $request->content;
            $news->save();
        }

        return redirect()->route('news.index');
    }

    /**
     * Display the specified news item.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        try {
            $news = News::findOrFail($news->id);

            if ($news instanceof News) {
                $news->created_ago = $news->created_at->diffForHumans();
            }

            return view('news.show', compact('news'));
        } catch (\Exception $e) {
            Session::flash('server_error', 'Technical error has occurred');
            return back();
        }
    }
}
