<?php

namespace App\Http\Controllers;

use App\Http\Requests\JSONAPIRequest;
use App\Post;
use App\Services\JSONAPIService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * PostController constructor.
     */
    private $service;
    public function __construct(JSONAPIService $service)
    {
        $this->service = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->service->getWithPaginate(Post::class, 'post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JSONAPIRequest $request)
    {
        return $this->service->create(Post::class, $request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->service->show(Post::class, $id,'post');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->service->update(Post::class, $request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->service->delete(Post::class, $id);
    }

    public function upload(JSONAPIRequest $request)
    {
        return $this->service->upload($request->image, 'posts');
    }
}
