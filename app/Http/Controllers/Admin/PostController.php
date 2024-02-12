<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\PaginateController;
use App\Http\Controllers\Base\SortController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostFormRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    protected $paginate;
    protected $sort;

    public function __construct(PaginateController $paginate, SortController $sort)
    {
        $this->paginate = $paginate;
        $this->sort = $sort;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::query();

        $posts = $query
            ->orderBy($this->sort->getSort($request), $this->sort->getOrder($request))
            ->paginate(3, ['*'], 'page', $this->paginate->getPage($request))
            ->withQueryString();

        return view('admin.posts.index', ["posts" => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostFormRequest $request)
    {
        $post = Post::create($request->validated());

        if ($request->hasFile('thumbnail')) {
            $fileName = Str::slug($request->title) . time() . '.' . $request->file('thumbnail')->extension();
            $fileNameWithUpload = 'storage/posts/' . $fileName;
            $request->file('thumbnail')->storeAs('public/posts/', $fileName, 'local');
            $post->thumbnail = $fileNameWithUpload;
            $post->save();
        }

        return redirect(route("admin.posts.index"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view("admin.posts.create", [
            "post" => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostFormRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        $data = $request->validated();

        if ($request->has("thumbnail")) {
            $thumbnail = str_replace("storage/posts/", "", $request->file("thumbnail")->store("public/posts"));
            $data["thumbnail"] = $thumbnail;
        }

        $post->update($data);

        return redirect(route("admin.posts.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect(route("admin.posts.index"));
    }
}
