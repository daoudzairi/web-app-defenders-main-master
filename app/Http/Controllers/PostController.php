<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$posts = Post::all(); //Gets all posts from DB.
        //dd($posts);
        Log::channel('abuse')->info("Showing the Blog PAGE by user ".auth()->user()->id);
        $url = URL::temporarySignedRoute('posts', now()->addMinutes(30));
        if (! $request->hasValidSignature()) {
            return redirect()->route('index')->with('info', 'Please use the navigation bar to navigate !');
        }
        else{
            return view("blog.index")->with('posts', Post::orderBy('updated_at', 'DESC')->get())->with($url);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Log::channel('abuse')->info("create blog page is called by user ". auth()->user()->id);
        if (! $request->hasValidSignature()) {
            //abort(401);
            return redirect()->route('index')->with('info', 'Please use the navigation bar to navigate !');
        }
        else{
            return view('blog.create')->with('info', 'Please Login first');
        }
    

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        $newImageName = uniqid() . '-' . $request->title . '-' . $request->image->extension();

        $request->image->move(public_path('images'), $newImageName);

        Post::create([
            'title'=> $request->input('title'),
            'slug'=> Str::random(5),
            'description' => $request->input('description'),
            'image_path' => $newImageName,
            'user_id' => auth()->user()->id
        ]);
        Log::channel('abuse')->info("Creating the Post With title ".$request->input('title'). " by user", ['user_id' => $request->user()->id]);
        return redirect('/blog')->with('message', 'Your Post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $post = Post::where('id', $id)->first();
        Log::channel('abuse')->info("SHOWING the Post With ID ".$id. " by user", ['user_id' => auth()->user()->id]);
        if (! $request->hasValidSignature()) {
            //abort(401);
            return redirect()->route('index')->with('info', 'Please use the navigation bar to navigate !');
        }
        else{
            return view('blog.show', compact('post'));
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $post = Post::where('id', $id)->first();
        Log::channel('abuse')->info("EDITING the Post With id ".$id. " by user", ['user_id' => auth()->user()->id]); //Logging
        $url = URL::temporarySignedRoute('posts', now()->addMinutes(30));
        if (! $request->hasValidSignature()) {
            //abort(401);
            return redirect()->route('index')->with('info', 'Please use the navigation bar to navigate !');
        }
        else{
            return view('blog.edit', compact('post'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $UpdatednewImageName = uniqid() . '-' . $request->title . '-' . $request->image->extension();

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        $actualPost = Post::find($request->id);
        $request->image->move(public_path('images'), $UpdatednewImageName);
     
        $actualPost->title = $request->input('title');
        $actualPost->description = $request->input('description');
        //$actualPost->user->id = $request->Auth::user()->id;
        $actualPost->image_path = $UpdatednewImageName;
        $actualPost->update();
        Log::channel('abuse')->info("UPDATING the Post With Title ".$request->input('title'). " by user", ['user_id' => $request->user()->id]);
        return redirect('/blog')->with('message', 'Post has been updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        Log::channel('abuse')->info("DELETING the Post With id ".$id. " by user", ['user_id' => auth()->user()->id]);
        return redirect()->back()->with('status','Post Deleted Successfully');
    }
}
