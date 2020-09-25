<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post;
use Auth;

class PostController extends Controller
{
    public function __construct()
    { //protect all things of post except show
      $this->middleware('auth', ['except' => ['show','search']]);
    }
    public function index()
    {
      $posts = post::paginate(25);
      return view('posts.index')->withPosts($posts);
    }
    public function search(Request $request)
    { //return "aa";
      if ($request->has('q')) {
        $request->flashOnly('q');
        $results = post::search($request->q)->paginate(15);
      } else {
        $results = [];
      }
      return view('posts.search')->with('results', $results);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('posts.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'title' => 'required|max:255',
        'content' => 'required',
      ]);
      $user = Auth::user();
      $post = $user->posts()->create([
        'title' => $request->title,
        'content' => $request->content,
        'published' => $request->has('published')
      ]);
      return redirect()->route('posts.show', $post->id);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $post = post::findOrFail($id);
      return view('posts.show')->withPost($post);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $post = post::findOrFail($id);
      return view('posts.edit')->withPost($post);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'title' => 'required|max:255',
        'content' => 'required',
      ]);
      $post = post::findOrFail($id);
      $post->title = $request->title;
      $post->content = $request->content;
      $post->published = ($request->has('published') ? true : false);
      $post->save();

      return redirect()->route('posts.show', $post->id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  post::destroy($id);
    }
}
