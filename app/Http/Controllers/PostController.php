<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        // 認証が必要なアクションを指定
        $this->middleware('auth')->only(['new', 'create', 'store', 'edit', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        $user = auth()->user();
    
        // 検索フォームで入力された値を取得する
        $search = $request->input('search');
        // クエリビルダ
        $query = Post::query();
        // もし検索フォームにキーワードが入力されたら
        if ($search) {
            // 全角スペースを半角に変換
            $spaceConversion = mb_convert_kana($search, 's');
    
            // 単語を半角スペースで区切り、配列にする（例："山田 翔" → ["山田", "翔"]）
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
    
            // 単語をループで回し、ユーザーネームと部分一致するものがあれば、$queryとして保持される
            foreach ($wordArraySearched as $value) {
                $query->where('title', 'like', '%' . $value . '%');
            }
    
            // 上記で取得した$queryをページネートにし、変数$postsに代入（変数名を$postから$postsに修正）
            $posts = $query->paginate(20);
        }
    
        return view('post.index', compact('posts', 'user'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs=$request->validate([
            'title'=>'required|max:255',
            'body'=>'required|max:1000',
            'image'=>'image|max:1024'
        ]);
        $post=new Post();
            $post->title=$request->title;
            $post->body=$request->body;
        $post->user_id=auth()->user()->id;

        if (request('image')){
            $original = request()->file('image')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('image')->move('storage/images', $name);
            $post->image = $name;
        }

        $post->save();
        return redirect()->route('post.create')->with('message','投稿を作成しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $inputs=$request->validate([
            'title'=>'required|max:255',
            'body'=>'required|max:1000',
            'image'=>'image|max:1024'
        ]);

        $post->title=$inputs['title'];
        $post->body=$inputs['body'];

        if (request('image')){
            $original = request()->file('image')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            $file=request()->file('image')->move('storage/images', $name);
            $post->image = $name;
        }
        $post->save();
        return redirect()->route('post.show', $post)->with('message','投稿を更新しました');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index')->with('message', '投稿を削除しました');
    }
}
