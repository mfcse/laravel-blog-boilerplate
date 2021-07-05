<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\FrontController;
use App\Models\Category;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = FrontController::returnData();
        $data['posts'] = Post::with('category', 'user')->select('id', 'title', 'category_id', 'user_id', 'status')->orderBy('created_at', 'DESC')->paginate(20);

        return view('backend.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = FrontController::returnData();

        $data['categories'] = Category::select('id', 'name')->get();
        // dd($data['categories']);
        return view('backend.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        ///validation
        $rules = [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'status' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //insert
        //dd($request);
        // try {
        //     Post::create([
        //         'title' => trim($request->title),
        //         'content' => trim($request->content),
        //         'category_id' => $request->category_id,
        //         'user_id' => auth()->user()->id,
        //         'thumbnail_path' => 'default.png',
        //         'status' => $request->status
        //     ]);
        //     session()->flash('message', 'Post Added');
        //     session()->flash('type', 'success');

        //     //redirect
        //     return redirect()->back();
        // } catch (Exception $e) {
        //     session()->flash('message', $e->getMessage());
        //     session()->flash('type', 'danger');

        //     //redirect
        //     return redirect()->back();
        // }



        Post::create([
            'title' => trim($request->title),
            'content' => trim($request->content),
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id,
            'thumbnail_path' => 'default.png',
            'status' => $request->status
        ]);
        session()->flash('message', 'Post Added');
        session()->flash('type', 'success');

        //redirect
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}