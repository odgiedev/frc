<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\post_reply;
use Illuminate\Http\Request;

class FrcController extends Controller
{
    public function index()
    {
	    return view('index');
    }

    public function show($path)
    {
        $p = $path;

        switch ($p) {
            case "r": 
                $tb = (object) ['path' => 'r', 'board' => 'random'];
                break;
            case "h": 
                $tb = (object) ['path' => 'h', 'board' => 'histories_&_misteries'];
                break;
            case "a": 
                $tb = (object) ['path' => 'a', 'board' => 'anime_&_manga'];
                break;
            
            case "v": 
                $tb = (object) ['path' => 'v', 'board' => 'video_games'];
                break;
            
            case "c": 
                $tb = (object) ['path' => 'c', 'board' => 'comics_&_cartoons'];
                break;
            
            case "t": 
                $tb = (object) ['path' => 't', 'board' => 'technology'];
                break;
            
            case "m": 
                $tb = (object) ['path' => 'm', 'board' => 'movies'];
                break;
            
            case "w": 
                $tb = (object) ['path' => 'w', 'board' => 'weapons'];
                break;
            
            case "ve": 
                $tb = (object) ['path' => 've', 'board' => 'vehicles'];
                break;
            
            case "s": 
                $tb = (object) ['path' => 's', 'board' => 'sports'];
                break;
            
            case "sc": 
                $tb = (object) ['path' => 'sc', 'board' => 'science_&_math'];
                break;
            
            case "n": 
                $tb = (object) ['path' => 'n', 'board' => 'nature'];
                break;
            
            case "to": 
                $tb = (object) ['path' => 'to', 'board' => 'toys'];
                break;
            
            case "f":
                $tb = (object) ['path' => 'f', 'board' => 'food'];
                break;
            
            case "wa": 
                $tb = (object) ['path' => 'wa', 'board' => 'wallpapers'];
                break;
            
            case "mu": 
                $tb = (object) ['path' => 'mu', 'board' => 'music'];
                break;
            
            case "fa": 
                $tb = (object) ['path' => 'fa', 'board' => 'fashion'];
                break;
            
            case "p": 
                $tb = (object) ['path' => 'p', 'board' => 'paranormal'];
                break;
            
            case "o": 
                $tb = (object) ['path' => 'o', 'board' => 'other'];
                break;
            

            default:
                $tb = (object) ['path' => 'an error has ocurred', 'board' => 'an error has ocurred'];
                break;
        }

        $posts = Post::where('path', $path)->orderBy('created_at', 'desc')->paginate(15);
        
        return view('layouts.main', compact('posts', 'tb'));
    }

    public function showPost($id)
    {
        $post = Post::find($id);

        $replies = post_reply::where('post_id', $id)->orderBy('created_at', 'desc')->paginate(10);

        return view('post', compact('post', 'replies'));
    }

    public function store(Request $request, $path, $board)
    {

        $request->validate([
            'description' => 'required|min:4|max:750',
            'image' => 'required|image'
        ]);

        $post = new Post();

        $post->path = $path;

        $post->board = $board;

        $post->description = $request->description;

        if ($request->file('image')->isValid()) {

            $requestImg = $request->file('image');

            $extension = $requestImg->extension();

            $imgName = md5($requestImg->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImg->move(public_path('images'), $imgName);

            $post->img = $imgName;
        }

        $post->save();

        return redirect()->back();
    }

    public function storeReply(Request $request, $post_id)
    {
        $request->validate([
            'description' => 'required|min:4|max:750',
            'img' => 'required|image'
        ]);

        $reply = new post_reply();

        if ($request->file('img')->isValid()) {

            $requestImg = $request->file('img');

            $extension = $requestImg->extension();

            $imgName = md5($requestImg->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImg->move(public_path('images'), $imgName);

            $reply->img = $imgName;
        }

        $reply->description = $request->description;

        $reply->post_id = $post_id;
        
        Post::where('id', $post_id)->increment('hmreply', 1);

        $reply->save();

        return redirect()->back();
    }
}
